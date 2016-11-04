<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$pagetitle = $titles[0]->titlestmt_title." in ".$titles[0]->imbrex_filedesc_seriesstmt_title;
?>
<style type="text/css">
    #record_content{
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .record_container{
        margin:10px;
    }
    .edit_delete_record_container{
        margin-top: 10px;
    }
    
    #imbrex-toolbar{
		padding-top:10px;
		}
    
    #pages_panel{
		position: absolute;
		right: 0;
		width: 100px;
		top: 100;
		z-index:400000;
		background-color:#CCC;
		box-shadow: 0px 0px 15px black;
		outline: 0;
		padding:4px;
	}
</style>
<!--div class="form form-inline">
    <div class="form-group">
        <input type="text" name="search" value="" id="input_search" class="input-medium search-query form-control" placeholder="keyword" />&nbsp;
    </div>
    <button name="submit" id="btn_search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Search</button>&nbsp;
    <?php
    
        /*if($allow_navigate_backend && $have_add_privilege){
            echo '<a href="'.$backend_url.'/add/" class="btn btn-default add_record"><i class="glyphicon glyphicon-plus"></i> Add</a>'.PHP_EOL;
        }*/
    ?>
</div-->
<div class="row" id="imbrex-toolbar">
	<div class="col-xs-8" id="view-tile-toolbar">
		<div class="input-group input-group-sm">			
			<span class="input-group-addon">Filter Labels</span>
			<input id="filterLabelText" class="form-control" type="text" placeholder="filter the labels" value="" />
			<span class="input-group-btn">
				<button id="labels_toggle" class="btn btn-primary" type="button">Hide Labels</button>
			</span>
			<span class="input-group-btn">
			<a href="#pages_panel" id="pages_toggle" class="btn btn-primary btn-sm pages_close">Hide pages list</a>			
			</span>	
			<span class="menuitem input-group-btn">
				<a id="L579" class="getTrans btn btn-warning btn-sm" title="Lines Mode">
					Lines <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
				</a>
				<a id="getHLite" class="getHLite btn btn-warning btn-sm" title="Box Mode">
					Box <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
				</a>
				<a href="#" id="zoomIn" class="btn btn-warning btn-sm" title="Zoom In">Zoom-in <span class="glyphicon glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a>
				<a href="#" id="zoomOut" class="btn btn-warning btn-sm" title="Zoom Out">Zoom-out <span class="glyphicon glyphicon glyphicon-zoom-out" aria-hidden="true"></span></a>
			</span>			
		</div>
	</div>	
</div>
<div>
	<div id="pages_panel">
		<div>
			<?php
			//var_dump($result);
			foreach($result as $record){
				
				echo "<figure><img class=\"edition_first_page img-responsive img-rounded\" src=\"".base_url()."files/".$record->xml_id."/images/".$record->file."\" alt=\"Page ".$record->pagenum."\">";
				echo "<figcaption class=\"text-center\"><a href=\"#\" class=\"load_page\" data-text_id=\"".$record->text_id."\" data-page_id=\"".$record->page_id."\">".$record->pagenum."</a></figcaption>";
				echo "</figure>";
				}
			?>
		</div>
	</div>
	<div id="document_panel">
	<?php 
	//var_dump($first_page_data); style="border:1px solid red"
	?>
	</div>
</div>


<!--div id="record_content"><?php //echo $first_data ?></div-->
<!--div class="row" style="padding-bottom:20px">
    <a id="btn_load_more" class="btn btn-default col-xs-12" style="display:none;">{{ language:Load More }}</a>
</div-->
<!--div id="record_content_bottom" class="alert alert-success">End of Page</div-->
<script type="text/javascript">
    //var PAGE                   = 1;
    var URL                    = '<?php echo site_url($module_path."/browse_imbrex_text_body_lg/get_page"); ?>';
    //var ALLOW_NAVIGATE_BACKEND = <?php //echo $allow_navigate_backend ? "true" : "false"; ?>;
    //var HAVE_ADD_PRIVILEGE     = <?php //echo $have_add_privilege ? "true" : "false"; ?>;
    //var BACKEND_URL            = '<?php //echo $backend_url; ?>';
    //var LOADING                = false;
    //var RUNNING_REQUEST        = false;
    //var STOP_REQUEST           = false;
    var REQUEST;
	var text_id 				= <?php echo $text_id;?>;
	var first_page_id			= <?php echo $page_id;?>;

    /*function adjust_load_more_button(){
        if(screen.width >= 1024){
            $('#btn_load_more').hide();
            $('#record_content_bottom').show();
        }else{
            $('#btn_load_more').show();
            $('#record_content_bottom').hide();
        }
    }*/

    /*function fetch_more_data(async){
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

    }*/

    /*function reset_content(){
        $('#record_content').html('');
        PAGE = 0;
        fetch_more_data();
        adjust_load_more_button();
    }*/

	function get_page(t,p){
		var URL = '<?php echo site_url($module_path."/browse_imbrex_text_body_lg/get_page"); ?>';
			
			
			//alert(text_id+"--"+page_id);
			var REQUEST = $.ajax({
            'url'  : URL,
            'type' : 'GET',
            //'dataType':'json',
            'async': true,
            'data' : {
                'text_id' : t,
                'page_id' : p,
				},
            'success'  : function(result){
                // show contents
                //console.log(result);
                $('#document_panel').empty().append(result);
                // stop request if response is empty
                
                }
                
            //},
            /*'complete' : function(response){
                RUNNING_REQUEST = false;
            }*/
        });
		
		}

    // main program
   
    $(document).ready(function(){
		
		document.title = '<?php echo $pagetitle; ?>';
		
		get_page(text_id,first_page_id);
        
		$('body').on('click','.load_page', function(e){
			var text_id = $( this ).data( "text_id" );
			var page_id = $( this ).data( "page_id" );	
			get_page(text_id,page_id);		
			e.preventDefault();
		});
        // delete click
        /*$('.delete_record').live('click',function(){
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
        });*/

        // input keyup
        /*$('#input_search').keyup(function(){
            reset_content();
        });

        // button search click
        $('#btn_search').click(function(){
            reset_content();
        });*/

        // scroll
        /*$(window).scroll(function(){
            if(screen.width >= 1024 && !STOP_REQUEST && !LOADING){
                if($('#record_content_bottom').position().top <= $(window).scrollTop() + $(window).height() ){
                    LOADING = true;
                    fetch_more_data(false);
                    LOADING = false;
                }
            }
        });*/

        // load more click
        /*$('#btn_load_more').click(function(event){
            if(!LOADING){
                LOADING = true;
                fetch_more_data(true);
                LOADING = false;
            }
            $(this).hide();
            event.preventDefault();
        });*/
        
        var windowWidth = $(window).width();
        $(".container").css('width',windowWidth).removeClass('container');//addClass('container-flow')
		$(".row").css('margin',0);
		$(".unpadded").css('padding',0);
		$('#pages_toggle').on('click',function(e){
			e.preventDefault();						
			var $this = $(this);
			$this.toggleClass('pages_close');
			if($this.hasClass('pages_close')){
				$this.text('Hide pages list'); 
				//$('#document_panel').attr('class','').addClass('col-xs-11');        
			} else {
				$this.text('Show pages list');
				//$('#document_panel').attr('class','').addClass('col-xs-12');
			}
			
			$("#pages_panel").toggle();
			
		
			
		});
		
		$('#labels_toggle').on('click',function(){
									
			var $this = $(this);
			$this.toggleClass('labels_close');
			if($this.hasClass('labels_close')){
				$this.text('Show lables'); 
				//$('#az_activeBox').attr('class','').addClass('col-xs-11');        
			} else {
				$this.text('Hide labels');
				//$('#document_panel').attr('class','').addClass('col-xs-12');
			}
			
			$("#az_activeBox").toggle();
			
		
			
		});


		
    });
</script>
