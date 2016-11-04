/**
* Transcript.js
* 
* @copyright MITH 
* @author Grant Dickie
* @author Doug Reside
* 
* Displays transcript lines that are decoded from JSON data
* Functions:
* 
* _drawText : displays the text that is contained in the lineArray variable
* _addLines(data,{optional} url) : takes a JSON-based array (data) and optional parameter url (if this data belongs
* 	to a new image) and changes the text display
* _shapeDrawnHandle : handler for the VectorDrawer shapeDrawn event. adds the drawn shape to the currently selected line
* _deleteItemHandle : handler for the deleteItem event from ActiveBox
* _updateItemHandle : handler for the shapeChanged event from VectorDrawer
* _lineSelected(index) : takes the argument index and sets the current line to the lineArray index matching index
* _lineDeSelected(index) : the opposite of _lineSelected
* exportLines : returns the lineArray
* bundleData(manifest) : takes argument manifest, which is the manifest for TILE_ENGINE, modifies/updates the TILE_ENGINE
* 							manifest data, then sends modified manifest back. 
*/	
(function ($, R, _) {
	var rootNS = this;
	
	rootNS.Transcript = Transcript;
	// Constructor
	// Takes {Object} args
	/*
	 * args:
	 * 	text = newLine delimited text file
	 *  loc = element to receive transcript Editor 
	 */
	function Transcript(args){
	
		var self = this;
		// format for array item: {"text":(args.text||[]),"info":[],"shapes":[]};
		this.lineArray = args.text;
		
		this.loc = $("#"+args.loc);
		this.infoBox = $("#"+args.infoBox);
		this.manifest=[];
	
		this.knownIds=[];
		// parse together all JSON data for the entire session
		// here
		if(this.lineArray){
			for(url in this.lineArray){	
				if(!(/jpg$|JPG$|gif$|GIF$|png$|PNG$/.test(url))) continue;
				if(!self.manifest[url]) self.manifest[url]=[];
				for(var l in this.lineArray[url].lines){
					var line=$.extend(true,{},this.lineArray[url].lines[l]);
					self.manifest[url][l]=line;
					if(!self.manifest[url][l].id){
						
						var id="line_"+Math.floor(Math.random()*560);
						while($.inArray(id,self.knownIds)>=0){
							id="line_"+Math.floor(Math.random()*560);
						}
						self.knownIds.push(id);
						self.manifest[url][l].id=id;
					}
				}
			}
			self.lineArray=self.manifest[$("#srcImageForCanvas").attr('src')];
			
		}
		this.curLine=0;
		this.curUrl=null;
	}
	Transcript.prototype={};
	$.extend(Transcript.prototype, {
		_insertLines:function(data){
			var self=this;
			
			self.lineArray=data;
		},

		// Fills in the Transcript box with transcript lines, 
		// as received from the JSON data put into lineArray
		_drawText: function(){
			var self=this;
			
			for (var i in self.lineArray) {
				if(!this.lineArray[i]) continue;
				var uid=this.lineArray[i].id;
				if(typeof this.lineArray[i].id=='string'){
					uid = this.lineArray[i].id.replace(/\.|\:/g,'');
				}
				if (!(this.lineArray[i].shapes)){
					this.lineArray[i].shapes=[];
				}
				if(!(this.lineArray[i].info)){
					this.lineArray[i].info=[];
				}
				$("<div id='" + uid + "' class='line'>" + this.lineArray[i].text + "</div>").appendTo($("#logbar_list")).mouseover(function(e){
					$(this).addClass("trans_line_hover");
				}).mouseout(function(e){
					$(this).removeClass("trans_line_hover");
				});
				if(this.lineArray[i].shapes.length>0){$('#'+uid).addClass('data_attached')}
				var n=i;
				// attach data for index value 
				$("#"+uid).data("index",n);
			}
			
			$("#logbar_list > .line").bind("click",function(e){
				e.preventDefault();

				$(this).removeClass("trans_line_hover");
				// var index = parseInt($(this).attr("id").substring($(this).attr("id").lastIndexOf("_")+1),10);
				if ($(this).hasClass("line_selected")){
					// de-select the line
					// var id=$(".line_selected").attr('id').replace("TILE_Transcript_","");
					$(".line_selected").removeClass("line_selected");
					$(this).trigger("lineDeselected");
				} else{
					$(".line_selected").removeClass("line_selected");
					// 						var n=$(this).attr('id').indexOf("_");
					// 						
					// 						var index=parseInt($(this).attr('id').substring(0,n),10);
					$(this).addClass("line_selected");
					$(this).trigger("TranscriptLineSelected",[$(this).attr('id')]);
					// self._lineSelected($(this).attr('id'));
				}

			});
			
			// check if the page has no transcript lines associated with it
			if($("#"+self.loc.attr('id')+" > .line").length==0){
				// no lines 
				self.loc.append($("<div class=\"line\">No Transcript Lines Were Found For This Image</div>"));
			}
			
		},
		//called when a line object is selected
		//users can select one or multiple lines
		// id : {String} represents id in lineArray
		_lineSelected:function(id){
			var self=this;
			var index=null;
			for(x in self.lineArray){
				if(id==self.lineArray[x].id){
					index=x;
					break;
				}
			}
			if(self.lineArray[index]) {
				//clear all shapes
				$("body:first").trigger("clearShapes");
				// change curLine
				self.curLine=index;
				//load any shapes from curLine
				if(!self.lineArray[self.curLine].shapes) self.lineArray[self.curLine].shapes=[];
				// if(self.lineArray[self.curLine].shapes.length>0){
					// prepare shapes 
					var shps=[];
				
					for(var s in self.lineArray[self.curLine].shapes){
						if(!self.lineArray[self.curLine].shapes[s]) continue;
						shps.push(self.lineArray[self.curLine].shapes[s]);
					}
				$("body:first").trigger("loadItems",[shps]);
				// }
				$("body:first").trigger("TranscriptLineSelected",[id]);
				// $("body:first").trigger("addLink",[{id:self.lineArray[self.curLine].id,type:"lines"}]);
			} else {
				// hopefully won't reach this
				return;
			}
			
		},
		// called when a line Object is no longer active - resets ActiveBox
		// index : {Integer} represents index in lineArray
		_lineDeSelected:function(index){
			var self=this;
			self.curLine=null;
			$("body:first").trigger("TranscriptLineSelected",[null]);
		},
		
	}
	
	);})(jQuery, Raphael, _);

	/**
	* Plugin Wrapper for the TILE.engine object to activate
	* the plugin
	*
	* start() method is the constructor
	*/ 
	var Trans={
		id:"Transcript1001",
		name:'TranscriptView',
		/**
		* start()
		* @constructor
		* @params mode {Object} - Mode object passed when TILE.engine calls start()
		*/
		start:function(mode){
			var self=this;
			
			
			var clickTrans=function(e){
				e.preventDefault();
				//$(".ui-dialog").hide();
				//$(".shpButtonHolder").remove();
				
				if($(this).hasClass('active')) return;
				
				$("#view-tile-toolbar .menuitem a").removeClass('active');
				$(this).addClass('active');
				self.restart();
			};
			
			// var text=data.lines;
			self.transcript=new Transcript({text:[],loc:'logbar_list'});
			// insert the HTML into the interface
			var html='<div id="logbar_list" class="az panel-body"></div>';
			TILE.engine.insertModeHTML(html,'topleft',mode.name);

			// if no other active buttons, then this one is active
			if(!$("#view-tile-toolbar .menuitem a").hasClass('active')){
				$("#L579").addClass('active');
			}
			
			$("#L579").live('click',clickTrans);
			
			
			// trnsClick handler
			var _trnsClickHandle=function(e,id){
				var obj={id:id,type:'lines',jsonName:TILE.url,display:$("#"+id).text().substring(0,10),obj:{id:id,type:'lines'}};
				TILE.engine.setActiveObj(obj);
			};
			
			
			$("body").on("TranscriptLineSelected",{obj:self},_trnsClickHandle);
			// listens for when a user de-selects a line
			$("body").on("lineDeselected",{obj:self},function(e,obj){
				// send a blank array - thus deleting all items on canvas
				TILE.engine.setActiveObj(null);
				// $("body:first").trigger("loadItems",[[]]);
			});
			
			// bind ENGINE events
			$("body").on("newJSON",{obj:self},self.newJSONHandle);

			$("body").on("newActive",{obj:self},self.newActiveHandle);

			
			// check to see if data already loaded
			var data=TILE.engine.getJSON(true);
			if(data){
				var text=[];
				if(data&&(data.lines)){
					// parse out data
					for(var line in data.lines){
						if((!(data.lines[line]))||(typeof(data.lines[line])=='undefined')) continue;
						text.push(data.lines[line]);
					}
				}
				self.transcript.loc.empty();
				// insert new page into Transcript
				self.transcript._insertLines(text);

				self.transcript._drawText();
			}
		},
		newActiveHandle:function(e,o){
			//alert('azz');
			var self=e.data.obj;
			if(o.type != 'lines'){
				// all lines deactivated
				$(".line_selected").removeClass("line_selected");
			}
		},
		newJSONHandle:function(e){
			
			var self=e.data.obj;
			// get current page
			var data=TILE.engine.getJSON(true);
			
			var text=[];
			if(data&&(data.lines)){
				// parse out data
				for(var line in data.lines){
					
					if((!(data.lines[line]))||(typeof(data.lines[line])=='undefined')) continue;
					text.push(data.lines[line]);
				}
			}
			$("#az_log > div > #logbar_list").empty();
			// insert new page into Transcript
			self.transcript._insertLines(text);
			self.transcript._drawText();
			
			//var tilerh=$(".tiler").height();
			
			//var lblh=$("#labelList").height();
			//console.log('nel plugin');
			//console.log('labels '+lblh);
			
			//$('#az_log').height();
			//$('#logbar_list').height($('#az_log').height());
			$('#logbar_list').css('max-height',$('#az_log').height());

			console.log('nel pluginz');
			//console.log($('#az_log').height());
			//console.log($('#logbar_list').width());
			
			for(var s in self.transcript.lineArray){
				var shapes=self.transcript.lineArray[s].shapes;
					if(shapes.length){
						$('#line'+s).addClass('data_attached');
						}
				}
			//console.log($('#az_log').height());
			//console.log($('#logbar_list').height());
		},
		_trnsClickHandle:function(e,id){
			var self=e.data.obj;
			$("body:first").trigger(self.activeCall,[self.id,{id:id,type:'lines',jsonName:$("#srcImageForCanvas").attr('src'),display:$("#"+id).text().substring(0,10),obj:{id:id,type:'lines'}}]);
			
		},
		restart:function(){
			var self=this;
			$(".line").unbind();
			$("#az_transcript_area > #logbar_list").empty();
			self.transcript._drawText();
			
			/*for(var s in self.transcript.lineArray){
				var shapes=self.transcript.lineArray[s].shapes;
					if(shapes.length){
						$('#line'+s).addClass('data_attached');
						}
				}*/
			
			if(!$("#getTrans").hasClass('active')) $("#getTrans").addClass('active');
		},
	};
	// register the plugin with TILE
	TILE.engine.registerPlugin(Trans);
