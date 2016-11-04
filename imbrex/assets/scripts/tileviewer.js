/*
 * IMBREXViewer 1.0
 * Copyright 2016 Alfredo Cosco
 * 
 * A short, just-view version of tile.js
 * 
 * Copyright 2009-2011 MITH (http://mith.umd.edu) and authors:
 * dougreside, jdickie, tdbowman, jgsmith, davelester
 * Licensed under the MIT license
 * 
 * http://mith.umd.edu/tile/
 */

/**
* GLOBAL VARIABLES
* Keep track of Image scale
* Large, global variable that 
* stores data for other plugins 
*/
var TILE=[];
//TILE.experimental=false;
TILE.activeItems=[];
TILE.url='';
// ENGINE allows access to global API
TILE.engine={};
TILE.formats='';
TILE.preLoad=null;
TILE.scale=1;

(function($){
	var tile=this;

	/** Private variables used within TILE_ENGINE
	* that can be accessed only in the TILE() 
	* local level
	*/
	var pluginControl=null; // instance of plugincontroller
	var json=null; // Global JSON session
	var _tileBar=null;
	// Error box
	var errorbox=null;
	
	// used to import data into TILE
	var importDialog=null;
	var curPage=null;

	// stores layouts of different modes
	var pluginModes=[];
	// array of all plugins
	var plugins=[];
	
	
	// private methods go here
	var deepcopy=function(oldObject){
		var tempClone = {};
		if((oldObject==null)||(oldObject=='undefined')) return tempClone;
        if(typeof(oldObject) == 'object'){
           for (var prop in oldObject){
               // for array use private method getCloneOfArray
               if((typeof(oldObject[prop]) == 'object') && ($.isArray(oldObject[prop]))){
                   tempClone[prop] = cloneArray(oldObject[prop]);
				}
               // for object make recursive call to getCloneOfObject
               else if (typeof(oldObject[prop]) == 'object'){
                   tempClone[prop] = deepcopy(oldObject[prop]);
			}
               // normal (non-object type) members
               else {
                   tempClone[prop] = oldObject[prop];
				}
			}
		}
       return tempClone;
	};
	
	var cloneArray=function(oldArray){
		var tempClone = [];
		
        for (var arrIndex = 0; arrIndex <= oldArray.length; arrIndex++){
            if (typeof(oldArray[arrIndex]) == 'object'){
                tempClone.push(deepcopy(oldArray[arrIndex]));
			} else if((oldArray[arrIndex]!=null)&&(oldArray[arrIndex]!='undefined')){
                tempClone.push(oldArray[arrIndex]);
			}
		}
        return tempClone;
	};
	/**
	* Called to see if there is a JSON object stored in the PHP session() 
	* OR: in a GET request 
	*/
	var	checkJSON=function(){
		
		
		var self=this;
		
			if(typeof(TILE.preLoad) == 'object'){
				json=TILE.preLoad;
				//console.log(json);
				TILE.engine.parseJSON(json);
				//setUp();
				return;
			} 
		
	};
		
	/*
	 * IMBREX/TILE Engine
	 * 
	 */	
	var TILE_ENGINE=function(args){
		// set local ENGINE variable so that PluginController + other local
		// methods can access this
		TILE.engine=this;
		
		//get HTML from PHP script and attach to passed container
		//this.loc=(args.attach)?args.attach:$("body");
		var self=this;

		// plugins array
		self.plugins=[];
		// array of plugins with key being
		// plugin name, value mode its in
		self.modeplugins=[];
		
		json=null;
		self.manifest=null;
		self.curUrl=null;
		
		pluginControl=new PluginController();

	};
	TILE_ENGINE.prototype={
		/**
		* activates the engine - called after loading all 
		* plugins into the array through insertPlugin
		* or insertModePlugin
		* @params mode {Object}
		*/
		activate:function(mode){
			var self=this;

			// go through plugins array and attach the 
			// src elements
			setTimeout(function(self){
				var count=0;
			 	var recLoad=function(){
					count++;
					if(count==self.plugins.length){
						// check if there is json data 
						checkJSON();
						
						// see if user defined a mode
						if(mode){
							// find matching mode and
							// open that mode up
							for(var y in pluginModes){
								if(pluginModes[y].name == mode){
									pluginModes[y].setActive();
									break;
								}
							}
							//removeLoad();
						} else {
							pluginModes[0].setActive();
						}
					} else {
						$.getScript(self.plugins[count],recLoad);
					}
				};
				$.getScript(self.plugins[count],recLoad);
				
				
			},1,self);
		},
		/**
		* adds a plugin to the main set 
		* of plugins in TILE
		* @params name {String}
		*/
		/*insertPlugin:function(name){
			
			var loc = window.location.pathname;;
			var self=this;
			// obj is plugin wrapper		
			// figure out src path
			var src='/No-CMS/modules/imbrex/plugins/'+name+'/tileplugin.js';
			self.plugins.push(src);
		},*/
		/**
		* takes a description for a mode
		* and creates a new mode object
		* @params name {String}
		*/ 
		insertMode:function(name){
			var self=this;
			
			// search for name in array of modes
			for(var prop in pluginModes){
				if(pluginModes[prop].name == name){
					return;
				}
			}
			// no plugin mode already set - create new
			var mode=new Mode(name);
			pluginModes.push(mode);
			return mode;
		},
		/**
		* add a plugin to a specific mode - 
		* waits until the mode is called to run
		* start() on plugin
		* @params
		* mode {String}, plugin {String}
		*/
		insertModePlugin:function(mode,plugin){
			var self=this;
			var obj=null;
			   
			// find mode in current modes
			for(var prop in pluginModes){
				if(pluginModes[prop].name == mode){
					obj = pluginModes[prop];
					break;
				}
			}
			if(!obj){
				// create and insert into array
				obj= new Mode(mode);
				pluginModes.push(obj);
			} 
			
			// figure out src path
			var src='/No-CMS/modules/imbrex/plugins/'+plugin+'/tileplugin.js';
			self.plugins.push(src);
			self.modeplugins[plugin]=obj.name;
			
		},
		/**
		* either appends html to Mode object of name or 
		* creates a new mode and inserts html in that mode
		* @params 
		* html {String}, section {String}, name {String}
		*/
		insertModeHTML:function(html,section,name){
			
			var self=this;
			var mode=null;
			// search for name in array of modes
			for(var prop in pluginModes){
				if(pluginModes[prop].name == name){
					mode = pluginModes[prop];
					break;
				}
			}
			// if no mode found, create new
			if(!mode){ 
				mode = new Mode(name);
				pluginModes.push(mode);
			}
			
			mode.appendPluginHTML(html,section);
			
		},
		/**
		* adds the plugin wrapper to the 
		* internal array 
		* @params
		* pw {Object} 
		*/
		registerPlugin:function(pw){
			var self=this;
			// if part of a mode, add to 
			// that mode 
			// If not, activate the plugin immediately
			if(self.modeplugins[pw.name]){
				// has stored mode name
				// in array - find matching
				// mode with that name
				for(var x in pluginModes){
					if(pluginModes[x].name == self.modeplugins[pw.name]){
						// will start when mode is active
						pluginModes[x].appendPlugin(pw);
						break;
					}
				}
			} else {
				// no mode - just start the plugin
				pw.start();
			}
		},
		/**Get Schema
		* taken from setMultiFileImport Custom Event call from ImportDialog
		* users supply a filename in ImportDialog that is then used here 
		* If file is given, then TILE makes an AJAX call to that file. Otherwise,
		* it parses the current json
		* @params file : {String}
		**/
		parseJSON:function(file){
			var self=this;
			//console.log(file);
			pluginControl._reset();
			if(file['tile']){
				// Coming from CoreData.php
				// Object has content and tile parameters
				json=deepcopy(file['tile']);
				
				// use the content in global variable 
				TILE.content=file['content'];
				// $("body:first").trigger("contentCreated",[file['content']]);
				
			}
			
			
			if(!json) return;
			
			// set initial global variables
			setTimeout(function(){
				for(var key in json.pages){
					var url=json.pages[key].url;
					if(!TILE.url){ 
						// set local and global variables
						curPage=url;
						TILE.url=curPage;
						break;
					}
				}
				// notify plugins that there is a JSON
				// loaded
				$("body:first").trigger("newJSON");
				//removeLoad();
			},3);
		},
		/**
		* sets a particular object as an active object.
		* All future data sent to insertData gets inserted
		* in this object's jsonName array
		* @params obj {Object}
		*/
		setActiveObj:function(obj){
			pluginControl._setActiveObj(obj);
		},
		/**
		* public function that handles output of JSON
		* @params opt {Boolean}
		*
		*/
		getJSON:function(opt){
			// generate a copy of the JSON variable and output it
			var self=this;
			if(!json) return false;
			// var jsoncopy=deepcopy(json);
			var jsoncopy=false;
			if(opt){
				for(var x in json.pages){
					if(json.pages[x].url==TILE.url){
						// copy only the current page
						jsoncopy=deepcopy(json.pages[x]);
					}
				}
			} else {
				// copy the full json view
				jsoncopy=deepcopy(json);
			}
			return jsoncopy;
		},
	};
	// TILE ENGINE IS MADE A PUBLIC API TOOL - CAN 
	// BE ACCESSED OUTSIDE OF LOCAL SCOPE
	tile.TILE_ENGINE=TILE_ENGINE;

	/**
	* Mode
	*
	* @constructor
	*
	* A set of plugin content items that are turned on/off at the same time
	* and has a mode button to represent that feature
	* Names can NOT have URIs or periods
	*/
	var Mode=function(name,active,unactive){
		var self=this;
		if(/http\:\/\/|\./.test(name)){
			return;
		}
		self.name=name;
		self.content=[];
		// array of plugins
		self.parr=[];
		// trigger for constructed/not
		//self.setup=false;
		// attach button to global html
		self.button=null;
	};
	Mode.prototype={
		/**
		* appends all types of HTML to the main interface
		* @params
		* html {String}, section {String} - 'righarea', 'topleft', 'bottomleft',
		* area {String} - 'toolbar', ''
		*/
		appendHTML:function(html,section,area){
			var self=this;
			console.log(self);
			// change name to fit style
			var styleName=self.name.toLowerCase().replace(/ /g,'');
			// area defines if its a toolbar addon or 
			//  a content area add-on
			
			// section defines where on the screen
			// html goes
			switch(section){
				case 'rightarea':
					$("#azcontentarea > .az.inner."+styleName).append(html);
					break;
				case 'topleft':
					$("#az_log > .az.inner."+styleName).append(html);
					break;
				case 'bottomleft':
					$("#az_activeBox > .az.inner."+styleName).append(html);
					break;
				default:
				// do nothing
				break;
			}			
		},
		/**
		* Attach a plugin wrapper to this Mode
		* @params plugin {Object}
		*/
		appendPlugin:function(plugin){
			var self=this;
			self.parr.push(plugin);
		},
		/**
		* Attach html to section of screen
		* @params html {String}, section {String}
		*/
		appendPluginHTML:function(html,section){
			var self=this;
			if(!html) return;
			self.appendHTML(html,section,'body');
		},
		/**
		* shows html for all 
		* plugins in set
		*/
		setActive:function(){
			var self=this;
			$.each(self.parr, function (i, o) {				
				self.parr[i].start(self);
			});
		},
	};
	
	/*
	 * Plugin Controller
	 * 
	 * @constructor
	 *
	 * Internal Object that controls plugins
	 *
	 * @params args {Object}
	 */
	
	var PluginController=function(args){
		
		var self=this;

		// array for holding tool objects
		self.toolSet=[];
	
		// manifest for holding objects created in session and previous sessions
		self.manifest={};
		// array for holding reference data
		self.linkArray=[];
		// lookup array for refs
		self.refArray=[];
		
		// array for holding tool JSON data
		self.toolJSON=[];
		
		self.activeTool=null;
		
		
		// set up the floating box
		//self.floatDiv=new FloatingDiv();
		// get initial metadata
		var metaData=[];
		

	}; 
	PluginController.prototype={
		/**
		* Adds source code and files 
		* for plugins 
		*
		*/
		setUpToolData:function(){
			var self=this;
			var toolIds=[];
			for(s in self.toolSet){
				// initialize the manifest for this id
				self.manifest[s]=[];
				toolIds.push(s);
			}
			
			// now go through array of files and download all data into toolJSON{}
			function recLoad(i){
				if(i>=toolIds.length) {
					// now set up dialogs
					//get dialog JSON data
					$("body:first").trigger("toolSetUpDone");
				
					return;
				}
				// attach possible event calls from plugin
				if(self.toolSet[toolIds[i]].output){
					$("body").bind(self.toolSet[toolIds[i]].output,{obj:self},self._toolOutputHandle);
				}
				
				// go through each tool and check if it has a JSON
				// file parameter, if so, save data 
				
				if(self.toolSet[toolIds[i]].json&&(self.toolSet[toolIds[i]].json.length)){
					if(!(/json$|JSON$/.test(self.toolSet[toolIds[i]].json))){
						i++;
						recLoad(i);
					} else {
						$.ajax({
							url:"lib/JSONHTML/"+self.toolSet[toolIds[i]].json,
							dataType:"json",
							success:function(d){
								self.toolJSON[self.toolSet[toolIds[i]].name]=d;
								i++;
								recLoad(i);
							}
						});
					}
				} else {
					// no file given - continue
					i++;
					recLoad(i);
				}
			}
			
			recLoad(0);
		},
		/**
		* Sets the activeobj value back to null
		*/
		_reset:function(){
			var self=this;
			self.activeObj=null;
		},
		/**
		* Sets the active object
		* @params _newActiveObj {Object} TILE Object
		*/
		_setActiveObj:function(_newActiveObj){
			var self=this;
			//$(".ui-dialog").hide();
			$(".shpButtonHolder").remove();
			
			if(!_newActiveObj){
				self.activeObj=null;
				// set blank object as active (reset)
				$("body:first").trigger('newActive',[{id:'none',type:'none'}]);
				return;
			}
			var refs=[];
			if(self.activeObj&&(self.activeObj.id==_newActiveObj.id)) return;
			
			self.activeObj=null;
			// reset activeItems
			TILE.activeItems=[];
			// find object in JSON
			// assign that object to activeObj
			if(_newActiveObj.type!=_newActiveObj.jsonName){
				for(var prop in json.pages){
					if(json.pages[prop].url==_newActiveObj.jsonName){
						// found page
						var page=json.pages[prop];
						if(!page[_newActiveObj.type]){
							// array doesn't exist yet - insert data 
							// and use the object as activeObj
							page[_newActiveObj.type]=[_newActiveObj.obj];
							self.activeObj=_newActiveObj;
							TILE.activeItems.push(self.activeObj.obj);
						} else {
							// already an array in session - check to see
							// if there is a matching ID
							for(var item in page[_newActiveObj.type]){
								if(_newActiveObj.id==page[_newActiveObj.type][item].id){
									// copy into object
									_newActiveObj.obj=deepcopy(page[_newActiveObj.type][item]);
									
									self.activeObj=_newActiveObj;
									TILE.activeItems.push(self.activeObj.obj);
									break;
								}
							}
							if(!self.activeObj){
								// insert into array
								page[_newActiveObj.type].push(_newActiveObj.obj);
								self.activeObj=_newActiveObj;
								TILE.activeItems.push(self.activeObj.obj);
							} 
						}
					}
					
				}
			} else {
				// on global level
				if(!json[_newActiveObj.jsonName]){
					json[_newActiveObj.jsonName]=[_newActiveObj.obj];
					self.activeObj=_newActiveObj;
					TILE.activeItems.push(self.activeObj.obj);
				} else {
					// found array - check for the matching ID
					for(var item in json[_newActiveObj.jsonName]){
						if(json[_newActiveObj.jsonName][item].id==_newActiveObj.id){
							_newActiveObj.obj=deepcopy(json[_newActiveObj.jsonName][item]);
							self.activeObj=_newActiveObj;
							TILE.activeItems.push(self.activeObj.obj);
							break;
						}
					}
					if(!self.activeObj){
						json[_newActiveObj.jsonName].push(_newActiveObj.obj);
						self.activeObj=_newActiveObj;
						TILE.activeItems.push(self.activeObj.obj);
					}
				
					
				}
				
			}
			if(!self.activeObj) return;
			
			// set activeItems
			for(var prop in self.activeObj.obj){
				if($.isArray(self.activeObj.obj[prop])){
					// load items as refs
					for(var id in self.activeObj.obj[prop]){
						
						var n=self.findObj(self.activeObj.obj[prop][id],prop);
						// insert into activeItems
						if(n&&(n!='undefined')) {TILE.activeItems.push(n);}
						
					}
				}
			}
			// notify plugins of new active object
			$("body:first").trigger("newActive",[self.findTileObj(self.activeObj.id,self.activeObj.type)]);
		},
		/**
		* searches json for matching id
		* @params
		* id {String}, type {String}, jsonName {String}
		*/
		findObj:function(id,type,jsonName){
			var self=this;
			var obj=null;
			if(!json[type]){
				// URL - find in current page
				var page=null;
				for(var p in json.pages){
					if(json.pages[p].url==TILE.url){
						// found page
						page=json.pages[p];
						break;
					}
				}
				if((!page)||(!page[type])) return obj;
				for(var item in page[type]){
					if(id==page[type][item].id){
						obj=deepcopy(page[type][item]);
					}
				}
			} else {
				if(!json[type]) return obj;
				for(var item in json[type]){
					if(id==json[type][item].id){
						obj=deepcopy(json[type][item]);
						break;
					}
				}
				
			}
			return obj;
		},
		/**
		* returns object in TILE format
		* @params 
		* id {String}, type {String}
		*/
		findTileObj:function(id,type){
			var self=this;
			var obj=null;
			
			if(!json[type]){
				// URL - find in current page
				var page=null;
				for(var p in json.pages){
					if(json.pages[p].url==TILE.url){
						// found page
						page=json.pages[p];
						break;
					}
				}
				if((!page)||(!page[type])) return null;
				for(var item in page[type]){
					if(id==page[type][item].id){
						var o=deepcopy(page[type][item]);
						obj={id:id,type:type,jsonName:page.url,obj:o};
						break;
					}
				}
			} else {
				if(!json[type]) return null;
				for(var item in json[type]){
					if(id==json[type][item].id){
						var o=deepcopy(json[type][item]);
						obj={id:id,type:type,jsonName:type,obj:o};
						break;
					}
				}
				
			}
			return obj;
		},

	};
})(jQuery);
