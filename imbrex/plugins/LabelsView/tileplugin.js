/**
* Labels
* Manages metadata in Label window - hides and shows
* Labels that are present on the page
* 
* 
*/

/**
* @constructor
* @params args {Object}
*/
var Label=function(args){
	var self=this;
	
	self.DOM=$("#az_LabelBox");
	self.clearTextArea=$("#clearTextArea");
	self.addLabelText=$("#filterLabelText");
	self.labelList=$("#az_activeBox > div > div > div#labelList");
	self.manifest=[];
	self.checkIds=[];
	self.clearTextArea.click(function(e){
		self.addLabelText.val("");		
		self._textTypeHandle();
	
	});

	//Filter labels
	$('body').on('keyup',"#filterLabelText",(function(e){
		// wait a second and see what we're typing
		setTimeout(function(){
			self._textTypeHandle();
		},650)
				
	}));
	//console.log(self.DOM);
	
	// global listener for all labelitems in .az .labelList
	$('body').on("click", "#labelList > .labelItem", function(e){
		
		e.preventDefault();
		
		$("#labelList > .labelItem").removeClass("active");
		$(this).addClass("active");
		// get id for label
		var id=$(this).attr('id').replace("lbl_","");
		//console.log(id);
		//console.log({name:$(this).text(),id:id});
		// $("body:first").trigger("labelSelected",[{type:"labels",id:id}]);
		$("body:first").trigger("labelSelected",[{name:$(this).text(),id:id}]);
	});
		
	
};
Label.prototype={
	// Loads labels from JSON data
	// New labels are added in bundleData() and sortOutput()
	loadLabels:function(data){
		//console.log(data);
		var self=this;
		$("#labelList").empty();
		// each label receives an li tag that has a click
		// event attached
		for(d in data){
			if(!data[d]) continue;
			// get rid of duplicates
			if($("#labelList > #"+data[d].id).length==0){
				var lbl=data[d].obj;
				$("<div id=\""+lbl.id+"\" class=\"labelItem\">"+lbl.name+"</div>").appendTo("#labelList");
			}
			self.manifest.push(data[d]);
			self.checkIds.push(data[d].id);
		}
	
	},
	lblSelected:function(e,data){

		var self=e.data.obj;
		// deactivate other labels and activate this label
		// $(".labelItem").removeClass("active");
		self.addLabelText.val($("#lbl_"+data.id).text());
		// var url=$("#srcImageForCanvas").attr('src');
		// $("#lbl_"+data.id).addClass("active");
		
		self.curId=data.id;
		
		// show all references associated with this object
		for(x in self.manifest){
			
			if(self.manifest[x].id==self.curId){
				if(!self.manifest[x].refs) self.manifest[x].refs=[];
				$("body:first").trigger("labelSelected",[self.manifest[x]]);
				break;
			}
		}
	},
	_textTypeHandle:function(){
		var self=this;
		var txt=self.addLabelText.val();
		if(txt.length>0){
		var regex=new RegExp("^"+txt);
		self.labelList.children("div").each(function(i,o){
			if(!regex.test($(o).text())){
				$(o).hide();
			} else {
				$(o).show();
			}
		});
		} else {
			self.labelList.children('div').each(function(i,o){
				$(o).show();
			});
		}
	},
	sortOutputData:function(){
		var self=this;
		// get rid of null pointers
		var cleanManifest=[];
		for(var l in self.manifest){
			if(self.manifest[l]) cleanManifest.push(self.manifest[l]);
		}
		self.manifest=cleanManifest;
		return cleanManifest;
	}
	
};

/**
* Plugin Wrapper that TILE.engine uses to load in plugin
* start() method is constructor
*
*/
var LB={
	name:"LabelsView",
	/**
	* start()
	* @constructor
	* @params mode {Object} - Mode object passed when TILE.engine calls start()
	*/
	start:function(mode){
				
		
		var self=this;
		self.lbls=[];
		// manipulate DOM space
		//var html='<div class="toolbar" id="addLabelToolbar"><div class="menuitem pluginTitle">Labels</div><div class="menuitem"><ul><li><input id="filterLabelText" class="" type="text" value="" /></li></ul></div></div><div id="labelList" class="az"></div>';
		
		//var html='<div class="panel panel-warning"><div id="labelList" class="az panel-body" style="max-height:200px"></div></div>';
		
		// add HTML content to interface
		//TILE.engine.insertModeHTML(html,'bottomleft',mode.name);
		
		// create new label instance
		self.LBL=new Label({data:[]});
		
		$("body").bind("labelSelected",function(e,obj){
			// send obj to the engine
			var lbl={id:obj.id,type:'labels',jsonName:'labels'};
			
			TILE.engine.setActiveObj(lbl);
		});
		
		
		if(self.lbls.length) {
			//TILE.engine.insertTags(self.lbls);
			self.LBL.loadLabels(self.lbls);
		}
		
		// insert title into plugin area
		$("#addLabelToolbar > .pluginTitle").text("Labels");
		
		// attach global listeners
		$("body").live("newJSON newPage",{obj:self},self.newJSONHandle);

		// check to see if json data is already loaded
		var data=TILE.engine.getJSON(true);
		if(data){
			// data loaded - start labels
			if(!data.labels) return;
			var vd=[];
			var newLbls=[];
			// parse labels
			for(var d in data.labels){
				if(!self.lbls[data.labels[d].id]){
					self.lbls[data.labels[d].id]={id:data.labels[d].id,type:'labels',jsonName:'labels',obj:data.labels[d]};
					newLbls.push({id:data.labels[d].id,type:'labels',jsonName:'labels',obj:data.labels[d]});
				}

			}
			vd=self.findLabelsOnPage(data);

			// for(var d in self.lbls){
			// 		vd.push(self.lbls[d]);
			// 	}
			self.LBL.loadLabels(vd);
			if(newLbls.length){
				//TILE.engine.insertTags(newLbls);
			}

		}
	},
	newJSONHandle:function(e){
		var self=e.data.obj;
		//console.log('newjson');
		//console.log(self);
		if(e.type=='newPage'){
			// clear the label area
			$("#labelList").empty();
		}
		$(".labelItem").removeClass('active');
		var data=TILE.engine.getJSON();

		if(!data.labels) return;
		var vd=[];
		var newLbls=[];
		// parse labels
		for(var d in data.labels){
			if(!self.lbls[data.labels[d].id]){
				self.lbls[data.labels[d].id]={id:data.labels[d].id,type:'labels',jsonName:'labels',obj:data.labels[d]};
				newLbls.push({id:data.labels[d].id,type:'labels',jsonName:'labels',obj:data.labels[d]});
			}
			
		}
		vd=self.findLabelsOnPage(data);
		
		self.LBL.loadLabels(vd);
		if(newLbls.length){
			//TILE.engine.insertTags(newLbls);
		}
	},
	// finds labels referenced in engine JSON
	// returns array of active labels
	findLabelsOnPage:function(data){
		//console.log('data');		
		//console.log(data);
		var self=this;
		var vd=[];
		// find the labels referenced on this page
		for(var p in data.pages){
			if(data.pages[p].url==TILE.url){
				// current page - find label refs
				var page=data.pages[p];
				for(var prop in page){
					// if prop is a list of items, go through them
					if((!(/url|lines|info/i.test(prop)))&&($.isArray(page[prop]))){
						for(var item in page[prop]){
							if((page[prop][item]['labels'])&&($.isArray(page[prop][item]['labels']))){
								for(var lbl in page[prop][item]['labels']){
									
									if(self.lbls[page[prop][item]['labels'][lbl]]){
										vd.push(self.lbls[page[prop][item]['labels'][lbl]]);
									}
								}
							}
						}
					}
				}
				break;
			}
		}
		//console.log('vd');
		//console.log(vd);
		return vd;
	},
	// develop a wordle to be put into the Dashboard plugin
	createWordle:function(data){
		var self=this;
		
		var idCount=[];
		for(var x in self.lbls){
			idCount[x]=1;
		}
		// data is either a page or entire JSON coredata
		if(data.pages){
			// entire session
			for(var p in data.pages){
				var page=data.pages[p];
				for(var prop in page){
					// if prop is a list of items, go through them
					if((!(/url|lines|info/i.test(prop)))&&($.isArray(page[prop]))){
						for(var item in page[prop]){
							if((page[prop][item]['labels'])&&($.isArray(page[prop][item]['labels']))){
								for(var lbl in page[prop][item]['labels']){
									// if an id of a label is referenced, put a tic into that
									// label's id count
									if(self.lbls[page[prop][item]['labels'][lbl]]){
										if(!idCount[page[prop][item]['labels'][lbl]]){
											idCount[page[prop][item]['labels'][lbl]]=1;
										}
										idCount[page[prop][item]['labels'][lbl]]++;
									}
								}
							}
						}
					}
				}
			}
		}
		// create HTML for wordle
		var html='<div class="label Wordle"><h3>TILE LABELS</h3><br/><p>';
		for(var id in idCount){
			// calculate the height for the label name
			var h=10*parseInt(idCount[id],10);
			html+='<span class="labelName" style="font-size:'+h+'px;">'+self.lbls[id].obj.name+'</span><br/>';
		}
		html+='</p></div>';
				
	},
	_lblClickHandle:function(e,refs){
		var self=e.data.obj;
				
		$(".line_selected").removeClass("line_selected");
		$("body:first").trigger("loadItems",[refs]);
		
	}
};
// register the plugin with TILE
TILE.engine.registerPlugin(LB);
