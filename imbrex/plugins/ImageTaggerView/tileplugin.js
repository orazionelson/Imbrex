/**
*  Image Tagger : A plugin tool for TILE
*  @author Grant Dickie
*  Takes a JSON object representing the pages in a particular session, puts each
*  url in a SVG Canvas and applies the VectorDrawer program to that image

*  Objects:
*  ITag (Main engine)
*  ImageList
*  TILEShapeToolBar
*  RaphaelImage
*  Shape
*  AutoRecLine

*  NOTE: Shapes are loaded into RaphaelCanvas by use of the loadItems Custom Event
*  Example: $("body:first").trigger("loadItems",[{Object} arrayOfShapesOrItems]);
*/

//Shape Constants
var SHAPE_ATTRS = {"stroke-width": "1px", "stroke": "#a12fae"};

(function ($) {
	
	var ITag = this;
	ITag.done = false;
	
	/**
	* _Itag 
	* 
	* @constructor 
	*/
	var _Itag = function (args) { 
		this.loc=args.loc;
		// this._base=args.base;
		this.schemaFile = null;
		var self = this;
		
		self.curURL = null;
		//pre-load the initial html content into loc area - needs .az.inner
		//to be visible
		//self.htmlContent = "<div class=\"panel-body\"><div id=\"raphworkspace_\" class=\"workspace\"></div></div>";
			
		//$("body").bind("imageTaggerCanvasDone",{obj:this},this.createShapeToolBar);
	
	};
	_Itag.prototype = {
		// Sets up the HTML for this object. Creates RaphaelImage
		// html : {Object} - JSON object derived from imagetagger.json
		setHTML:function () {
			//html is JSON data
			var self=this;
			//setup the raphael div - give it a unique ID so that RaphaelImage can find it using Jquery
			
			//create raphael - Raphael Canvas that is used for drawing
			//this object initiates VectorDrawer
			self.raphael = new RaphaelImage({
				loc:"raphworkspace_",
				maxZoom:5,
				minZoom:1,
				url:[],
				canvasAreaId:"raphael"
			});
			
			
		},

		
		// called once the plugin has been constructed by TILE_ENGINE,
		// then is being called again (re-attaches listeners and 
		// re-attaches DOM objects)
		// json : {Object} - JSON data with new shape information
		_restart:function(json){
			var self=this;
			
			self.curURL=TILE.url;
			
			// send off parsed array to the drawing canvas
			if(self.raphael) {
				self.raphael._restart(json,self.curURL);
			}
		},

	};
	ITag._Itag=_Itag;

	
	/**
	* RaphaelImage
	* @constructor 
	*
	* Creates canvas for drawing shapes.
	* Using RaphaelJS library for creating a Raphael canvas 
	* 
	* Usage:
	* new RaphaelImage({loc:{String}})
	* 
	* @params loc: {String} - Id for parent DOM
	**/

	var RaphaelImage=function(args){
		var self=this;
		//create UID
		var d=new Date();
		this.uid="image_"+d.getTime("hours");

		//url is actually an array of image values
		this.url=(typeof args.url=="object")?args.url:[args.url];
		
		if(args.loc){
			this.loc=args.loc;
			//set to specified width and height
			if(args.width) this.DOM.width(args.width);
			if(args.height) this.DOM.height(args.height);			
		}
		
		this.loc=$("#"+args.loc);
		
		this.loc.append($("<div id=\"raphael\"><img id=\"srcImageForCanvas\" src=\"\"/></div>"));
		this.DOM=$("#raphael").css({'z-index':'1000'});
		//this.DOM.width(this.DOM.parent().width()).height(this.DOM.parent().height());
		this.srcImage=$("#srcImageForCanvas");
		this.canvasAreaId=args.canvasAreaId;
		
		// zoom decrease factor
		this.zoomDF=0.9;
		// zoom increase factor
		this.zoomIF=1.1;
		
		//this.defaultImg='skins/default/images/tile.gif';
		
		//master array
		this.manifest=[];
		this.curUrl=null;
		this._imgScale=1;
		//array holding shapes, their data, and what tag they relate to
		this.tagData=[];
		this.curTag=null;
		// keep track of how many zooms have been done
		this.zoomTimes=0;
		//type of shape to draw (changes through setShapetype call)
		this.shapeType='rect';
		//raphael canvas holder
		this.canvasObj=null;
		this.image=null;
		this.drawMode=false;
		this.currShape=0;
		this.currShapeColor=args.shapeColor?args.shapeColor:"#FF0000";
		this.pageNum=0;
		//for creating random values for shapes
		this.dateRand=new Date();
		this.startShapes=null;
		this.shapeIds=[];

		//$("body").bind("imageAdded",{obj:this},this.showCurrentImage);
		
		self.containerSize={'x':0,'y':0};
		// self.containerOffset={'x':0,'y':0};
		// global bind to window to make sure that canvas area is correctly synched w/ 
		// window size
		$(window).resize(function(e){
			if($("#raphworkspace_").length){
				// adjust width
				
				$("#raphworkspace_").width($("#azcontentarea > .az.inner").innerWidth());
				diff=$("#azcontentarea > .az.inner > .toolbar").innerHeight();
				$("#raphworkspace_").height($("#azcontentarea > .az.inner").innerHeight()-diff);
			}
		});
	
			
	};
	RaphaelImage.prototype={
		//gets a new manifest and uses this as the new manifest
		// manifest : {Object}
		setNewManifest:function(manifest){
			var self=this;
			self.manifest=manifest;
			self.url=[];
			for(key in self.manifest){
				self.url.push(self.manifest[key]);
				 
			}
			self.addUrl(manifest);
		},
		// @url can be a single string or an array of string values
		//url is {array} with each element being in this format:
		//{uri:{String}}
		addUrl:function(url){
			// if(url.shapes) this.startShapes=url.shapes;
			// 			if(url.images) url=url.images;
			if((url!=null)){
				//is an array - process array
			
				for(u in url){
					//if not already present in array, add image to url list
					//and to the master array
					if(!url[u].url) continue;
					var cu=(url[u].uri||url[u].url);
					var lines=(url[u].lines)?url[u].lines:[];
					if((cu.length>1)&&(!(/php$|PHP$|js$|JS$/.test(cu)))&&(url[u].url)){
						//var cleanurl=url[u].uri.replace(/^[A-Za-z0-9]+|[\t\r]+/,"");
						
						this.url.push(url[u]);
						//Master Array ---
						//formatted to be output as a JSON
						this.manifest[url[u].url]=url[u];
					} else if(this.manifest[url[u].url]){
						//duplicate already exists; add info and lines to this image
						$.each(this.manifest[url[u].url].info,function(i,o){
							if(i in url[u].info){
								if($.isArray(o)){
									o.push(url[u].info[i]);
								} else {
									//make this item into an array
									var pre=o;
									o=[pre];
									o.push(url[u].info[i]);
								}
							}
						});
						//merge lines together
						$.merge(this.manifest[url[u].url].lines,url[u].lines);
					}
					this.pageNum=0;
				}
			}
		},

		// finds the real width and height of the given URL and
		// sets the canvas area and other surrounding divs to this
		// proportion
		// url : {String}
		// 
		setUpCanvas:function(){
			
			var self=this;
			
			
			// remove CSS from zoom
			$("#srcImageForCanvas").css("width","");
			
			// make sure to get rid of all shpButtonHolders
			$(".shpButtonHolder").remove();
			
			if(self.drawTool) self.drawTool.clearShapes();
			if(/\.js|\.html|\.JSP|\.jsp|\.JS|\.PHP|\.php|\.HTML|\.HTM|\.htm/.test(TILE.url)) return;
			// get image element
			var img=$("#srcImageForCanvas")[0];
			
			// attach load event
			$(img).load(function(e){
				
				$(img).unbind();
				if(!self.drawTool){
					//set up drawing canvas
					self.setUpDrawTool();
				
				} else {
					//clear all shapes from the previous image
					self.drawTool.clearShapes();
				}
				// determine scale
				var ow=(TILE.scale!=self._imgScale)?(this.width*TILE.scale):this.width;
				var oh=(TILE.scale!=self._imgScale)?(this.height*TILE.scale):this.height;
	
	//console.log(TILE.scale+"-"+self._imgScale+'-'+this.height+'-'+oh);
	
				var contw=0;
				var conth=0;
				
				contw=parseInt($("#raphworkspace_").css("width"),10);
				conth=parseInt($("#raphworkspace_").css("height"),10);
			
				
				if((contw<ow)||(conth<oh)){
					while((contw<ow)||(conth<oh)){
						ow*=self.zoomDF;
						oh*=self.zoomDF;
						TILE.scale*=self.zoomDF;
					}
				
				//console.log(TILE.scale+"-"+self._imgScale+'-'+this.height+'-'+oh+'-'+conth);	
				
					self._imgScale = TILE.scale;
					for(var x=0;x<self.manifest.length;x++){
						var shape=self.manifest[x];
						if(shape._scale!=TILE.scale){
							for(var u in shape.posInfo){
								var dx=(shape.posInfo[u]*TILE.scale)/shape._scale;
								shape.posInfo[u]=dx;
							}
							shape._scale=TILE.scale;
						}
					}
				}
				self.drawTool.setScale(TILE.scale);
				$("#srcImageForCanvas").width(ow);
			
				$(".vd-container").css('width',ow+'px');
				$(".vd-container").css('height',oh+'px');
				//alert($('.leftpanel').height());
				//$(".rightpanel").css('height',$('.leftpanel').height());
				//$("#raphworkspace_.workspace").css('height',$('.leftpanel').height());
				
				if($(".shpButtonHolder").length){
					// also change positon of .shpButtonHolder
					$(".shpButtonHolder").css('left',($(".shpButtonHolder").position().left*TILE.scale)+'px');
					$(".shpButtonHolder").css('top',($(".shpButtonHolder").position().top*TILE.scale)+'px');
				}
				if(self.curUrl!=TILE.url) self.curUrl=TILE.url;
				
				$("body").trigger('imageTaggerCanvasDone');
			}).attr("src",TILE.url);	
		},
		// only load shapes - does not change the URL or sets up a new canvas
		loadShapes:function(shapes){
			var self=this;
			if(!self.drawTool) return;
			// clear canvas
			self.drawTool.clearShapes();
			
			// clear buttons
			$(".shpButtonHolder").remove();
			
			if(!shapes.length) return;
			var vd=[];
			// collate shapes array with 
			// internal shape stack
			for(var prop in shapes){
				if(!shapes[prop]){
					continue;
				}
				
				var shape=shapes[prop];
				if(shape.obj) {
					shape = shape.obj;
				} else if(!shape.posInfo){
					// just an id, need to find object
					shape=self.findShapeFromId(shape);
					if(!shape) return;
				}
				
				if($.inArray(shape.id,self.shapeIds)<0){
					self.manifest.push(shape);
					self.shapeIds.push(shape.id);
					vd.push(shape);
				} else {
					// find in manifest
					for(var sh in self.manifest){
						if(self.manifest[sh].id==shape.id){
							self.manifest[sh]=shape;
						}
					}
					vd.push(shape);
				}
				
			
				
			}
			var activeShape = null;
			// convert the scale to updated version
			for(var prop in vd){
				if(!activeShape){
					// make this the active shape
					activeShape = vd[prop]; 
				}
				for(var item in vd[prop].posInfo){
					var dx=(vd[prop].posInfo[item]*self._imgScale) / vd[prop]._scale;
					vd[prop].posInfo[item]=dx;
				}
				vd[prop]._scale=self._imgScale;
			}
			self.drawTool.importShapes(vd);
			self.setActiveShape(activeShape);
		},
		findShapeFromId:function(id){
			var self=this;
			var sh=null;
			// step through manifest
			for(var s in self.manifest){
				if(self.manifest[s].id==id){
					sh=self.manifest[s];
					break;
				}
			}
			return sh;
		},
		//creates the VectorDrawer tool and sets up necessary 
		// listeners
		// NOTE: if a shape object has an ID containing D_ at the beginning,
		// that shape will be treated as a temporary shape/autoLine
		setUpDrawTool:function(){
			var self=this;
			//creates the VectorDrawer canvas and all associated triggers for using
			//said VectorDrawer canvas.  
	
			// RaphaelImage acts as a wrapper for the VectorDrawer class; no functions inside of VectorDrawer
			// are invoked directly outside of RaphaelImage
			self.drawTool=new VectorDrawer({"overElm":$("#raphworkspace_ > #raphael"),"initScale":self._imgScale}); 
			// for when all temp lines have been approved
			self.approved=false;
			//set up triggers
			$("body").bind("zoom",{obj:self},self.zoomHandle);
			$("body").bind("_showShape",{obj:self},function(e,id){
				var self=e.data.obj;
				self.drawTool.hideShapes();
				self.drawTool.showShape(id);
			});
			$("body").bind("clearShapes",{obj:this},function(e){
				self.drawTool.clearShapes();
				
			});
			$("body").live("noShapesSelected",function(e){
				$(".shpButtonHolder").remove();
				$(".ui-dialog").hide();
			});
			// global bind for when [Transcript.js] is sending shape ids to imageTagger
			$("body").bind("loadItems",{obj:this},this._loadShapesHandle);

			// adjust width
			$("#raphworkspace_").width($("#azcontentarea > .az.inner").innerWidth());
			diff=$(".rightpanel .panel-heading").height()-30;
			//$("#raphworkspace_").height($("#azcontentarea > .az.inner").innerHeight()-diff);
			$("#raphworkspace_").height(($(".tiler").innerHeight()-diff)-30);
			
			//console.log($(".rightpanel .panel-heading").height());
			
			self.containerSize.x=$("#raphworkspace_").width();
			self.containerSize.y=$("#raphworkspace_").height();
		},
		// when the user opens up something that overlaps
		// the canvas, this has to be called
		// e : {Event}
		// s : {Boolean} true - set the z-index to 0 ; false - set z-index back up to 1032
		closeSVGHandle:function(e,s){
			var self=e.data.obj;
			if(s){
				$(".vd-container").css("z-index","0");
			} else if(!s) {
				$(".vd-container").css("z-index","1032");
			}
		},
		// called by Imagetagger
		setActiveShape:function(shpObj){
			var self=this;
			self.drawTool.selectShape(shpObj.id);		
		},

		copyShape:function(obj) {
			var self=this;
			
			function copyArray(args) {
				var argscopy = {};
				$.each(args, function(x, y) {
					
					argscopy[x] = y;
				});
				return argscopy;
			}
			var copy={};
			$.each(obj, function(i, o) {
				if(obj[i] && ($.isArray(obj[i]) || (typeof obj[i] == 'object'))){
					
					copy[i] = copyArray(obj[i]);
				} else {
					copy[i] = o;
				}
			});
			return copy;
			
		},
		// uses a VectorDrawer function for loading shapes
		// from a JSON string
		// Called by loadShapes event
		// e : {Event}
		// json : {Object} JSON object with shape data
		_loadShapesHandle:function(e,json){
			var self=e.data.obj;
			// JSON data is full of ids - must match these up with ids
			// in manifest
			var vd=[];
			var url=$("#srcImageForCanvas").attr('src');
			// clear the canvas
			self.drawTool.clearShapes();
			// also remove shpButtonHolder
			$(".shpButtonHolder").remove();
			for(j in json){
				var shid=(json[j].id)?json[j].id:json[j];
				for(sh in self.manifest[url]){
					if(self.manifest[sh]&&(self.manifest[sh].id==shid)){
						vd.push(self.manifest[sh]);
						break;
					} 
				}
			}
			self.drawTool.importShapes(JSON.stringify(vd));
		},
		// handles {Event} 'zoom'
		// also handles VectorDrawer canvas shapes - need to be cleared and re-sent
		// to transcript line
		// e : {Event}
		// n : {Integer} either -1 (zoom out) or 1 (zoom in)
		zoomHandle:function(e,n){
			var self=e.data.obj;
			$(".shpButtonHolder").hide();
		
			if(self.drawTool&&($("#srcImageForCanvas").width()!=0)){
				//svg scale() function has to be called after 
				//RaphaelImage is done resizing container elements
				
				var vd=self.drawTool.exportShapes();
				self.drawTool.clearShapes();
				// true width
				var h=$("#srcImageForCanvas")[0].width;
				// true height
				var w=$("#srcImageForCanvas")[0].height;
				
				if(n>0){
					// test to see if reached maximum
					
					$("#srcImageForCanvas").css("width",(self.zoomIF*parseFloat($("#srcImageForCanvas").width()))+'px');
					//$("#srcImageForCanvas").height(1.25*parseFloat($("#srcImageForCanvas").height()));
					$(".vd-container").width(self.zoomIF*parseFloat($(".vd-container").width()));
					$(".vd-container").height(self.zoomIF*parseFloat($(".vd-container").height()));
					
					// set scales
					self._imgScale*=self.zoomIF;
					TILE.scale*=self.zoomIF;
					//zooming in
					self.drawTool.setScale(self._imgScale);
					for(var x=0;x<self.manifest.length;x++){
						var shape=self.manifest[x];
						if(shape._scale!=self._imgScale){
							for(var u in shape.posInfo){
								var dx=(shape.posInfo[u]*self._imgScale)/shape._scale;
								shape.posInfo[u]=dx;
							}
							shape._scale = self._imgScale;
							// $("body:first").trigger('imageShapeUpdate',[shape]);
						}
						
						for(var d in vd){
							if(vd[d].id==shape.id){
								vd[d]=shape;
							}
						}
						
					}
				} else if(n<0){
					$("#srcImageForCanvas").css("width",(self.zoomDF*parseFloat($("#srcImageForCanvas").width()))+'px');
					//$("#srcImageForCanvas").height(0.75*parseFloat($("#srcImageForCanvas").height()));
					$(".vd-container").width(self.zoomDF*parseFloat($(".vd-container").width()));
					$(".vd-container").height(self.zoomDF*parseFloat($(".vd-container").height()));

					// set scales
					self._imgScale*=self.zoomDF;
					TILE.scale*=self.zoomDF;
					//zooming out
					self.drawTool.setScale(self._imgScale);
					for(var x=0;x<self.manifest.length;x++){
						var shape=self.manifest[x];
						if(shape._scale!=TILE.scale){
							for(var u in shape.posInfo){
								var dx=(shape.posInfo[u]*self._imgScale)/shape._scale;
								shape.posInfo[u]=dx;
							}
							shape._scale=self._imgScale;
							// $("body:first").trigger('imageShapeUpdate',[shape]);
						}
						
						for(var d in vd){
							if(vd[d].id==shape.id){
								vd[d]=shape;
							}
						}
					}	
				}
				
				self.drawTool.importShapes(vd);
			} else {
				$("body").unbind("zoom",self.zoomHandle);
			}
		},

		// called to reset the canvas
		_restart:function(json,url){
			var self=this;
			// dump autoLines
			self.autoLines=[];
			if((!url)) return;
			$("body").bind("zoom",{obj:self},self.zoomHandle);
			// wipe out other shapes
			TILE.scale=1;
			self._imgScale=1;
			if(self.drawTool) self.drawTool.setScale(1);
			
			$("body").bind('imageTaggerCanvasDone', function (e) {
				$("body").unbind("imageTaggerCanvasDone");
				if(self.drawTool){
					// erase current canvas
					self.drawTool.clearShapes();
					
					
					var vd=[];
					// check to see if shapes in passed data array
					// match up with any in the manifest
					for(var j in json){
						if($.inArray(json[j].id,self.shapeIds)<0){
							var shape=json[j];
							// adjust scale
							for(var el in shape.posInfo){
								var dx=(self._imgScale*shape.posInfo[el])/shape._scale;
								shape.posInfo[el]=dx;
							}
							shape._scale=self._imgScale;
							// add to manifest and array of ids
							self.shapeIds.push(shape.id);
							self.manifest.push(shape);
							vd.push(json[j]);
						} else {

							for(var p in self.manifest){
								if(!json[j]) continue;
								if(json[j].id==self.manifest[p].id){
									// update item
									self.manifest[p]=json[j];
									vd.push(self.manifest[p]);
								}
							}
						}
					}
				} else {
					self.setUpCanvas(url);
				}
			});
			
			self.setUpCanvas();
		},

	};//END RaphaelImage
	
	ITag.RaphaelImage=RaphaelImage;

	//ITag.TILEShapeToolBar=TILEShapeToolBar;

})(jQuery);

/**
* Wrapper for the TILE.engine object to load the plugin
* start() method is constructor
*
* 
*/
var IT = {
	id:"IT1001",
	// name: {string} used as unique identifier
	name:'ImageTaggerView',
	/* 
	* start()
	* @constructor
	* @params mode {Object} - Mode object passed to method
	*/
	start:function(mode){
		var self=this;
		self.activeShape=null;
		
		var json=TILE.engine.getJSON();
		if(!self.itagger){
			// var id="azcontentarea"; //defaults to TILE page
			this.itagger=new _Itag({loc:"azcontentarea",json:null});
			this.linkManifest=[];
			
			// attach HTML and
			// create new engine mode
			TILE.engine.insertModeHTML(this.itagger.htmlContent,'rightarea','Image Annotation');
			
			$("#azcontentarea > .imageannotator > .toolbar").attr('id','_raphshapebar');
			this.itagger.setHTML();
			
			$("body").live("shapeIsActive",function(e,shape){
				
				if(!shape) return;
				// feed PC a wrapper for the shape
				var data={
					id:shape.id,
					type:'shapes',
					jsonName:TILE.url,
					obj:shape
				};
				// make active obj
				//TILE.engine.attachMetadataDialog(data,"#selBB");
			});
			
			// bind ENGINE events
			$("body").live("newActive",{obj:self},self.newActiveHandle);
			
			// check to see if data has been loaded
			var j=TILE.engine.getJSON(true);
			if(j){
				// data loaded - start up image tagger
				self.itagger.curUrl=TILE.url;
				var shapes = self.findShapesInJSON();
				self.itagger._restart(shapes);
			}			
		} 
	},
	newActiveHandle:function(e,obj){
		var self=e.data.obj;
		if(obj.type=='none'){
			// reset
			self.itagger.raphael.drawTool.clearShapes();
			return;
		}
		// update URL
		self.itagger.curURL=TILE.url;
		if(obj.obj.posInfo){
			// is a shape - handle differently
			self.itagger.raphael.setActiveShape(obj.obj);
		} else {
			var item=obj.obj;
			var vd=[];
			for(var prop in item){
				if(prop.toLowerCase()=='shapes'){
					// add to vd
					for(var shape in item[prop]){
						var sh=self.findShapeInJSON(item[prop][shape]);
						if(sh){
							vd.push(sh);
						}
					}
				}
			}	
			
			// add new shapes
			self.itagger.raphael.loadShapes(vd);
		}
	},	
	// find a shape within the TILE JSON based on an ID
	findShapeInJSON:function(id){
		var self=this;
		
		var json=TILE.engine.getJSON(true);
		var shape=null;
		if(json['shapes']){
			for(var sh in json['shapes']){
				if(json['shapes'][sh].id==id){
					shape=(json['shapes'][sh].obj)?json['shapes'][sh].obj:json['shapes'][sh];
				}
			}
			return shape;
		} else {
			return null;
		}
		
	},
	findShapesInJSON:function(){
		var self=this;
		
		var json = TILE.engine.getJSON();
		if(!json.pages) return null;
		
		var arr=[];
		for(var p in json.pages){
			if(json.pages[p].shapes&&($.isArray(json.pages[p].shapes))){
				for(var sh in json.pages[p].shapes){
					var shape=json.pages[p].shapes[sh];
					if((!shape)||(!shape.id)){
						continue;
					} else {
						TILE.scale=1;
						// correctify the posInfo
						if(shape._scale!=TILE.scale){
							for(var prop in shape.posInfo){
								if(/(c)(r)x|(c)(r)y|width|height/.test(prop)){
									var diff=(TILE.scale*shape.posInfo[prop])/shape._scale;
									shape.posInfo[prop]=diff;
								}
							}
							shape._scale=TILE.scale;
						}
						
						arr.push(shape);
					}
				}
				
			}
		}
		return arr;
	},
	// string that represents the trigger event that is called
	// once close is complete
	done:"closeOutITag",
	_close:"closeITAG"
};

// register the plugin with TILE
TILE.engine.registerPlugin(IT);
