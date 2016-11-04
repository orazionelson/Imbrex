<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	$asset = new Cms_asset();	
	$asset->add_module_css('styles/css/floatingDiv.css','imbrex');
	$asset->add_module_css('styles/css/style.css','imbrex');
	$asset->add_module_css('styles/css/dialog.css','imbrex');
	$asset->add_module_css('styles/css/jquery-ui-1.10.1.custom.min.css','imbrex');
	$asset->add_module_css('styles/css/autorec.css','imbrex');
	$asset->add_module_css('styles/css/colorpicker.css','imbrex');
	
	echo $asset->compile_css()."\n";
	
	
	$asset->add_module_js('scripts/jquery-ui-1.10.3.custom.min.js','imbrex');
	//$asset->add_module_js('scripts/jquery.xmlns.js','imbrex');
	$asset->add_module_js('scripts/raphael-min.js','imbrex');
	$asset->add_module_js('scripts/rangy/rangy.js','imbrex');
	$asset->add_module_js('scripts/underscore.js','imbrex');
	$asset->add_module_js('scripts/VectorDrawer_1.0/VectorDrawer.js','imbrex');
	$asset->add_module_js('scripts/tile.js','imbrex');
	$asset->add_module_js('scripts/colorpicker/colorpicker.js','imbrex');
	$asset->add_module_js('scripts/colorpicker/eye.js','imbrex');
	$asset->add_module_js('scripts/colorpicker/utils.js','imbrex');
	$asset->add_module_js('scripts/rangy/getPath.js','imbrex');
	$asset->add_module_js('scripts/jquery.form.js','imbrex');
echo $asset->compile_js();
?>
<style type="text/css">
    #record_content{
        margin-top: 0;
        margin-bottom: 10px;
    }
    .record_container{
        margin:10px;
    }
    .edit_delete_record_container{
        margin-top: 10px;
    }
    
    .panel{
		border:none;
		}
    .panel-heading{
		padding-top:1px;
		padding-bottom:1px
		}
	.panel-body{
		padding:5px;
		}
</style>
<div id="record_content">
	<!--This code triggers the TILE plugin-->
	<div id="azglobalmenu" class="az globalmenu">
		<div class="globalbuttons">
			<div class="modeitems" style="display:none"></div>
		</div>
	</div>
	<!--end of trigger-->
	<div class="row tiler">
		<div class="az leftpanel col-sm-5" style="border-right:1px solid #CCC">

				<div id="az_log" class="az log">
					<div class="az inner imageannotation panel panel-success">
					</div>
				</div>

				<div id="az_activeBox" class="az activeBox"></div>

		</div>
		<div class="pic rightpanel col-sm-7">
			<div id="azcontentarea" class="az content">
				<div class="az inner imageannotation panel panel-info" style="border:none">
				</div>
			</div>
		</div>
	</div>
	<span id="save_button" class="pull-right">
	<div class="menuitem"><a id="save_data" href="" class="button btn btn-success btn-sm" title="Save the current session" title="Save"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</a><a id="back_to_list" href="manage_imbrex_tiles/index/<?php echo $text_id; ?>" class="button btn btn-primary btn-sm" title="Go back to list" title="Go back"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Go back to list</a></div>
	</span>
	<script type="text/javascript">
		var engine=null;
		
		// set verbose mode either true (on) or false (off)
		__v=false;
		
		$(function(){
			// Initialize Core Functions and Objects:
			engine=new TILE_ENGINE({});
			//TILE.preLoad = "edit_imbrex_tile/importDataScript?page_id=<?php echo $page_id;?>";
			
			var mydata=$.ajax({
				url:"edit_imbrex_tile/importDataScript?page_id=<?php echo $page_id;?>",
				dataType:'text',
				type:'GET',
				async:false
			}).responseText;
			
			TILE.preLoad=$.parseJSON(mydata);
			
			//console.log(mydata);
					
			TILE.url="<?php echo base_url()."files/".$xml_id."/images/".$file;?>";
			//var js = TILE.engine.parseJSON();
			//console.log('load:');
			//console.log(TILE.preLoad);
			// Image Annotation Mode
			engine.insertMode('Image Annotation');
			// Auto Line Recognizer Mode
			//engine.insertMode('Auto Line Recognizer');
			
			// Image Tagger Plugin
			engine.insertModePlugin('Image Annotation','ImageTagger');

			// Transcript Lines Plugin
			engine.insertModePlugin('Image Annotation','Transcript');
			// Text Selection Plugin
			engine.insertModePlugin('Image Annotation','TextSelection');
			// Labels Plugin
			engine.insertModePlugin('Image Annotation','Labels');
			// Auto recognizer
			//engine.insertModePlugin('Auto Line Recognizer','AutoLineRecognizer');
			// CoreData plugin

			// CoreData Plugin
			engine.insertPlugin('CoreData');
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

	
</div>
<!--div class="row" style="padding-bottom:20px">
    <a id="btn_load_more" class="btn btn-default col-xs-12" style="display:none;">{{ language:Load More }}</a>
</div>
<div id="record_content_bottom" class="alert alert-success">End of Page</div-->
<script type="text/javascript">
	$(document).ready(function(){
			
			var tnh = $('#_top_navigation').height();
			var wh = $(window).height();
			$(".tiler").height(wh-tnh-20);
			var tilerh=$(".tiler").height();
			$('.leftpanel,.rightpanel, .imageannotation.panel').height(tilerh);
			var lph=$('.leftpanel').height();

			var azlogh=(lph/100)*60;
			$('#az_log').height(azlogh);
			
			$('#az_transcript_area').height(azlogh);
			var aztrh = $('#az_transcript_area').height();
			
			var azactivebox = (lph/100)*39;
			$('#az_activeBox').height(azactivebox);
			
			
			
			//var azlogh=$('#az_log').height();//(tilerh/100)*80;
			
			//var leftpanelph=leftpanel
			//console.log(tilerh);
			//console.log(lph);
			//console.log(azlogh);
			//console.log(aztrh);
			
			$('.container').css({
				'width':'96%',
				'padding-right':'3px',
				'padding-left':'3px',
				'margin-left':'15px'
				});
			
			$('.panel').css('marginBottom','0');
			
			$('.leftpanel').css({
				'padding-left':'0',
				'padding-right':'0',
				});
			$('.rightpanel').css({
				'padding-left':'0',
				'padding-right':'0',
				
				});
		});
	/*
    var PAGE                   = 1;
    var URL                    = '<?php echo site_url($module_path."/browse_imbrex_tile/get_data"); ?>';
    var ALLOW_NAVIGATE_BACKEND = <?php echo $allow_navigate_backend ? "true" : "false"; ?>;
    var HAVE_ADD_PRIVILEGE     = <?php echo $have_add_privilege ? "true" : "false"; ?>;
    var BACKEND_URL            = '<?php echo $backend_url; ?>';
    var LOADING                = false;
    var RUNNING_REQUEST        = false;
    var STOP_REQUEST           = false;
    var REQUEST;


    function adjust_load_more_button(){
        if(screen.width >= 1024){
            $('#btn_load_more').hide();
            $('#record_content_bottom').show();
        }else{
            $('#btn_load_more').show();
            $('#record_content_bottom').hide();
        }
    }

    function fetch_more_data(async){
        if(typeof(async) == 'undefined'){
            async = true;
        }
        $('#record_content_bottom').html('Load more Page &nbsp;<img src="{{ BASE_URL }}assets/nocms/images/ajax-loader.gif" />');
        var keyword = $('#input_search').val();
        // Don't send another request before the first one completed
        if(RUNNING_REQUEST){
            return 0;
        }
        RUNNING_REQUEST = true;
        REQUEST = $.ajax({
            'url'  : URL,
            'type' : 'POST',
            'async': async,
            'data' : {
                'keyword' : keyword,
                'page' : PAGE,
            },
            'success'  : function(response){
                // show contents
                $('#record_content').append(response);
                // stop request if response is empty
                if(response.trim() == ''){
                    STOP_REQUEST = true;
                }

                // show bottom contents
                var bottom_content = 'No more Page to show.';
                if(ALLOW_NAVIGATE_BACKEND && HAVE_ADD_PRIVILEGE){
                    bottom_content += '&nbsp; <a href="<?php echo $backend_url; ?>/add/" class="add_record">Add new</a>';
                }
                $('#record_content_bottom').html(bottom_content);
                RUNNING_REQUEST = false;
                PAGE ++;
            },
            'complete' : function(response){
                RUNNING_REQUEST = false;
            }
        });

    }

    function reset_content(){
        $('#record_content').html('');
        PAGE = 0;
        fetch_more_data();
        adjust_load_more_button();
    }

    // main program
    $(document).ready(function(){
        fetch_more_data();
        adjust_load_more_button();

        // delete click
        $('.delete_record').live('click',function(){
            var url = $(this).attr('href');
            var primary_key = $(this).attr('primary_key');
            if (confirm("Do you really want to delete?")) {
                $.ajax({
                    url : url,
                    dataType : 'json',
                    success : function(response){
                        if(response.success){
                            $('div#record_'+primary_key).remove();
                        }
                    }
                });
            }
            return false;
        });

        // input keyup
        $('#input_search').keyup(function(){
            reset_content();
        });

        // button search click
        $('#btn_search').click(function(){
            reset_content();
        });

        // scroll
        $(window).scroll(function(){
            if(screen.width >= 1024 && !STOP_REQUEST && !LOADING){
                if($('#record_content_bottom').position().top <= $(window).scrollTop() + $(window).height() ){
                    LOADING = true;
                    fetch_more_data(false);
                    LOADING = false;
                }
            }
        });

        // load more click
        $('#btn_load_more').click(function(event){
            if(!LOADING){
                LOADING = true;
                fetch_more_data(true);
                LOADING = false;
            }
            $(this).hide();
            event.preventDefault();
        });

    });*/

</script>
