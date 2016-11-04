<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$asset = new Cms_asset();	
	//$asset->add_module_css('styles/css/floatingDiv.css','imbrex');
	$asset->add_module_css('styles/css/styleView.css','imbrex');
	//$asset->add_module_css('styles/css/dialog.css','imbrex');
	//$asset->add_module_css('styles/css/jquery-ui-1.10.1.custom.min.css','imbrex');
	$asset->add_module_css('styles/css/autorec.css','imbrex');
	//$asset->add_module_css('styles/css/colorpicker.css','imbrex');
	
	echo $asset->compile_css()."\n";
	
	
	$asset->add_module_js('scripts/jquery-ui-1.10.3.custom.min.js','imbrex');
	//$asset->add_module_js('scripts/jquery.xmlns.js','imbrex');
	$asset->add_module_js('scripts/raphael-min.js','imbrex');
	$asset->add_module_js('scripts/rangy/rangy.js','imbrex');
	$asset->add_module_js('scripts/underscore.js','imbrex');
	$asset->add_module_js('scripts/VectorDrawer_1.0/VectorDrawer.js','imbrex');
	$asset->add_module_js('scripts/tileviewer.js','imbrex');
//	$asset->add_module_js('scripts/colorpicker/colorpicker.js','imbrex');
//	$asset->add_module_js('scripts/colorpicker/eye.js','imbrex');
//	$asset->add_module_js('scripts/colorpicker/utils.js','imbrex');
	//$asset->add_module_js('scripts/rangy/getPath.js','imbrex');
	//$asset->add_module_js('scripts/jquery.form.js','imbrex');
echo $asset->compile_js();
//var_dump($result);
?>
	<div id="tiles">
	<div class="row tiler">
		<div class="az leftpanel col-sm-5" style="border-right:1px solid #CCC">
				
				<div id="az_activeBox" class="az activeBox">
					<div class="az inner imageannotation">
						<div class="panel panel-warning"><div id="labelList" class="az panel-body" style="max-height:200px"></div></div>
					</div>
				</div>
				
				<div id="az_log" class="az log">
					<div class="az inner imageannotation panel panel-success">
					</div>
				</div>

				

		</div>
		<div class="pic rightpanel col-sm-7">
			<div id="azcontentarea" class="az content">
				<div class="az inner imageannotation panel panel-info" style="border:none">
					<div class="panel-body"><div id="raphworkspace_" class="workspace"></div></div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script type="text/javascript">
		var engine=null;
		
		// set verbose mode either true (on) or false (off)
		__v=false;
		
		$(function(){
			// Initialize Core Functions and Objects:
			engine=new TILE_ENGINE({});
			//TILE.preLoad = "edit_imbrex_tile/importDataScript?page_id=<?php //echo $page_id;?>";
			
			var mydata=$.ajax({
				url:"browse_imbrex_text_body_lg/importDataScript?page_id=<?php echo $result->page_id;?>",
				dataType:'text',
				type:'GET',
				async:false
			}).responseText;
			//console.log(mydata);
			TILE.preLoad=$.parseJSON(mydata);
			
			//console.log(mydata);
					
			TILE.url="<?php echo base_url()."files/".$result->xml_id."/images/".$result->file;?>";
			//var js = TILE.engine.parseJSON();
			//console.log('load:');
			//console.log(TILE.preLoad);
			// Image Annotation Mode
			engine.insertMode('Image Annotation');
			// Auto Line Recognizer Mode
			//engine.insertMode('Auto Line Recognizer');
			
			// Image Tagger Plugin
			engine.insertModePlugin('Image Annotation','ImageTaggerView');

			// Transcript Lines Plugin
			engine.insertModePlugin('Image Annotation','TranscriptView');
			// Text Selection Plugin
			engine.insertModePlugin('Image Annotation','TextSelectionView');
			// Labels Plugin
			engine.insertModePlugin('Image Annotation','LabelsView');
			// Auto recognizer
			//engine.insertModePlugin('Auto Line Recognizer','AutoLineRecognizer');
			// CoreData plugin

			// CoreData Plugin
			//engine.insertPlugin('CoreData');
			//var js = engine.parseJSON(true);
			//console.log(js);
			//
			// AutoLoad Plugin
			//engine.insertPlugin('AutoLoad');
			

			// Welcome Dialog Plugin (not loaded by default)
			// engine.insertPlugin('WelcomeDialog');
			// Activate Image Annotation Mode By Default
			engine.activate('Image Annotation');
			//console.log(engine);
		});
	</script>
	<script>
		$(document).ready(function(){
			
		var tnh = $('#_top_navigation').height();
			var wh = $(window).height();
			$(".tiler").height(wh-tnh-20);
			var tilerh=$(".tiler").height();
			
			$('.leftpanel,.rightpanel').height(tilerh);
			
			var panelw=$(".leftpanel").width();
			$('#az_log .inner').width(panelw);

			$('#azcontentarea .inner').height(tilerh);

			$('#az_log').height(tilerh-230)
			//Trigger for Zoom Buttons
			$("#zoomIn").click(function(e){
				$("body:first").trigger("zoom",[1]);
			});
			$("#zoomOut").click(function(e){
				$("body:first").trigger("zoom",[-1]);
			});
		});
	//$('#addLabelToolbar').hide();//.appendTo("#view-tile-toolbar");
	</script>
	</div>
