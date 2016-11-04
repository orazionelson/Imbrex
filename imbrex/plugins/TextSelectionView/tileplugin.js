/**
* TextSelection 
* @author Grant Dickie
* 
*  Provides functionality to highlight areas of text
* in the Transcript window
*/

(function($,rangy){
	rootNS = this;
	/**
	* TextSelector Object
	* Main object that handles selection objects
	*
	* @constructor
	*/
	TextSelector = function(){
		var self = this;
		this._color = "#FDFF00";
		this._selections = [];
	};
	TextSelector.constructor = TextSelector;
	TextSelector.prototype = {};
	$.extend(TextSelector.prototype, {
		
		
		_showSelectionObject: function(){
			var self = this;
			return this._selections;
		},	
		
		_checkForID: function(objID){
			for (var i=0;i<this._selections.length;i++){
				if (this._selections[i].id==objID){
					return false;
				}
			}
			return true;
		},			
		importSelections: function(selObj){
			/* assigns a JSON object of selections (like that 
			   returned by exportSelections) to this._selections
			   Then add colors to each */
			selObj.reverse();
			for (var i in selObj) {
				this.addHighlightMarkers(selObj[i]);
			}			
		   
		},
		removeHighlightMarkers: function(){

			$('span[class^="anno_"]').each(function() {
				var parentNode = $(this).parent();
			
				$(this).before($(this).html()).remove();
				
				parentNode[0].normalize(); // we have to normalize because the <span> highlights separate the text node!
			});
			 return true;
			 
			 
		},
		addHighlightMarkers: function(JSONobj){
			/*
			 * adds highlight markers for new selections
			 */
			
			if(!JSONobj){
				if(TILE.experimental){
					TILE.engine.displayError("Error reading selection object.");
				}
				
				return;
			} 
			var self, win, addTo, start, end, range, startSide, endSide, ancestor, flag, done, node, tmp;
							
			self = this;
			win = window;
			
			const record = {offsetY:Number.NaN, firstNode:null, lastNode:null};  // record object
			
			// create span wrapper
			const wrap = window.document.createElement("SPAN");
			wrap.style.backgroundColor = JSONobj.color;	
			wrap.className = JSONobj.id;	
			wrap.title = 'highlighter';	
						
			const _createWrapper = function(n) {   // wrapper
				var e = wrap.cloneNode(false);
			
				if(!record.firstNode) { record.firstNode = e; }
				if(record.lastNode) { record.lastNode.nextHighlight = e; }
				record.lastNode = e;
				
				var offset = $(n.parentNode).offset();
				var posTop = offset.top;
				var pageTop = parseInt(win.pageYOffset,10);
				if(!posTop || posTop < pageTop) {
					record.offsetY = pageTop;
				} else {
					if(!(posTop > record.offsetY))record.offsetY = posTop;
				}
				
				return e;
			};				
			
		
			// get jQuery object using CSS path
			start = $(JSONobj.StartParent);
			end = $(JSONobj.EndParent);		
			
			//console.log(start);
			//console.log(end);
					
			/* set range for obj */
			range = document.createRange();

			if(!start[0].childNodes.item(JSONobj.StartChild)) return;
			if(!end[0].childNodes.item(JSONobj.EndChild)) return;
			var sNode = start[0].childNodes.item(JSONobj.StartChild);
			range.setStart(sNode, JSONobj.StartOffset);
				
			var eNode = end[0].childNodes.item(JSONobj.EndChild);
			range.setEnd(eNode, JSONobj.EndOffset);
			
			startSide = range.startContainer;
			endSide = range.endContainer;				
			ancestor = range.commonAncestorContainer;
			flag = true;				

			
			if(range.endOffset == 0) {  //text | element
				while(!endSide.previousSibling && endSide.parentNode != ancestor) {
					endSide = endSide.parentNode;
				}
				endSide = endSide.previousSibling;
			} else if(endSide.nodeType == Node.TEXT_NODE) {
				if(range.endOffset < endSide.nodeValue.length) {
					endSide.splitText(range.endOffset);
				}
			} else if(range.endOffset > 0) { // element
				endSide = endSide.childNodes.item(range.endOffset - 1);
			}				
			
			
			if(startSide.nodeType == Node.TEXT_NODE) {
				if(range.startOffset == startSide.nodeValue.length) {
					flag = false;
				} else if(range.startOffset > 0) {
					startSide = startSide.splitText(range.startOffset);
					if(endSide == startSide.previousSibling) { endSide = startSide; }
				}
			} else if(range.startOffset < startSide.childNodes.length) {
				startSide = startSide.childNodes.item(range.startOffset);
			} else {
				flag = false;
			}				
			
			
			range.setStart(range.startContainer, 0);
			range.setEnd(range.startContainer, 0);
			
			done = false;
			node = startSide;
			
			do {
				if(flag && node.nodeType == Node.TEXT_NODE && !((tmp = node.parentNode) instanceof HTMLTableElement || tmp instanceof HTMLTableRowElement || tmp instanceof HTMLTableColElement ||	tmp instanceof HTMLTableSectionElement)) {
					var myWrap = node.previousSibling;
					if(!myWrap || myWrap != record.lastNode) {
						myWrap = _createWrapper(node);
						node.parentNode.insertBefore(myWrap, node);
					}
					
					myWrap.appendChild(node);
					node = myWrap.lastChild;
					flag = false;
				}
			
				if(node == endSide && (!endSide.hasChildNodes() || !flag)) {
					done = true;
				}
			
				if(node instanceof HTMLScriptElement || node instanceof HTMLStyleElement ||	node instanceof HTMLSelectElement) {  //never parse their children
					flag = false;
				}
			
			
				if(flag && node.hasChildNodes()) {
					node = node.firstChild;  //dump("-> firstchild ");
				
				} else if(node.nextSibling != null) {
					node = node.nextSibling;  //dump("-> nextSibling ");
					flag = true;
				
				} else if(node.nextSibling == null) {
					node = node.parentNode;  //dump("-> parent ");
					flag = false;
				}
				//if(node == ancestor.parentNode)dump("\nHALT shouldn't face ancestor");
			} while(!done);	
			
			range.detach(); // detach range			 
			 
		}
	});
	rootNS.TextSelector = TextSelector;
})(jQuery,rangy);


/**
* Wrapper for the TILE.engine to load in plugin
*
* start() is the constructor
*/
var TS={
	id:"TS1001",
	name:'TextSelectionView',
	/**
	* start()
	* @constructor
	* @params mode {Object} - Mode object passed when TILE.engine calls start()
	*/
	start:function(mode){
		var self=this;
		self.textsel=new TextSelector();
		
		// if no other active buttons, then this one is active
		if(!$("#view-tile-toolbar .menuitem a").hasClass('active')){
			$("#getHLite").addClass('active');
		}
		//$('#tile_toolbar').append($('#save_button'));

		self.manifest=[];
		self.activeSel="";
		self.curLink=null;
		var json=TILE.engine.getJSON();
		if(json){
			for(j in json){
				
				if(!(/jpg$|JPG$|PNG$|png$|gif$|GIF$/.test(j))) continue;
				if(!self.manifest[j]) self.manifest[j]=[];
				if(json[j].selections) self.manifest[j]=json[j].selections;
			}
		}
		
		// getText button
		var getHLite=function(e){
			e.preventDefault();
			//$(".ui-dialog").hide();
			//$(".shpButtonHolder").remove();
			// TILE.engine.setActiveObj(null);
			$(".line_selected").removeClass("line_selected");
			$("#view-tile-toolbar .menuitem a").removeClass('active');
			$(this).addClass("active");
			// make active and stop all listeners of other objects
			$("#logbar_list > .line").unbind();
			//$(".line").bind('mouseup',{obj:self},lineClickHandle);
		};
		
		// attach button listener
		$("#getHLite").live('click',getHLite);
		
		// listener for when PluginController sends data 
		// to change in current selection
		// $("body").live("ObjectChange",{obj:self},self._objChangeHandle);
		// listener for clicking on a highlight
		$("span[class^='anno']").live('mouseup',function(e){
			e.stopPropagation();
			// is user just turning this one off?
			if($(this).hasClass('selected')){
				return;
			}

			$("span[class^='anno']").removeClass("selected");
			var id=$(this).attr('class');
			$(this).addClass("selected");
						
		});

		var loadItemsHandle=function(e,o){
			var self=e.data.obj;
			$("span[class^='anno']").each(function(e){
				$(this).children(".button").remove();
				$(this).children("div").remove();
			});
			self.textsel.removeHighlightMarkers();

			if(!data||(data.length==0)) return;

			var url=TILE.url;
			var vd=[];
			for(x in self.manifest[url]){
				if($.inArray(self.manifest[url][x].id,data)>=0){
					vd.push(self.manifest[url][x]);
				}
			}
			if(vd.length==0) return;
			if(!$("#getHLite").hasClass("active")){
				$(".menuitem > a").removeClass('active');
				$("#getHLite").addClass('active');
				$("body:first").trigger(self.activeCall,[self.id]);
			}
			self.textsel.importSelections(vd);
		};	
		
		// bind ENGINE events
		$("body").live("newActive",{obj:self},self.newActiveHandle);
		$("body").live("newJSON",{obj:self},self.newJSONHandle);
	},
	newJSONHandle:function(e,o){
		var self=e.data.obj;
		self.manifest=[];
		var json=TILE.engine.getJSON();
		if(json){
			for(j in json.pages){
				if(json.pages[j].selections){
					for(var sel in json.pages[j].selections){
						self.manifest.push(json.pages[j].selections[sel]);
					}
				}
			}
		}
	},

	newActiveHandle:function(e,o){
		var self=e.data.obj;
		/*if(o.type=='selections'){
			// load the passed selection object
			self._loadItemsHandle([o.obj]);
			
		} else {*/
			// erase markers
			$("span[class^='anno']").each(function(e){
				$(this).children(".button").remove();
				$(this).children("div").remove();
			});
			self.textsel.removeHighlightMarkers();
			var data=[];
			// check for selections within object
			for(var prop in o.obj){
				if(($.isArray(o.obj[prop]))&&(prop=='selections')){
					
					for(var id in o.obj[prop]){
						for(var item in self.manifest){
							if(self.manifest[item].id==o.obj[prop][id]){
								var sel=(self.manifest[item].obj)?self.manifest[item].obj:self.manifest[item];
								data.push(sel);
							}
						}
					}
					
				}
			}
			if(data.length) {
				$("#getHLite").trigger("click");
				self._loadItemsHandle(data);
			}
		//}
	},
	
	_loadItemsHandle:function(data){
		var self=this;
		$("span[class^='anno']").each(function(e){
			//$("#logbar_list > .line > .button").remove();
			$("#logbar_list > .line > div").remove();
		});
		//self.textsel.removeHighlightMarkers();
		if(!data||(data.length==0)) return;
		
		self.textsel.importSelections(data);
		
	},

};
// register the plugin with TILE
TILE.engine.registerPlugin(TS);
