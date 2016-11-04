<h3>Manage Pages</h3>
<div id="edition_title" class="text-success">
</div>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//var_dump($privileges);
	$asset = new Cms_asset();	
	$asset->add_module_css('styles/imbrex.css','imbrex');
	echo $asset->compile_css()."\n";
	
	$asset->add_module_js('scripts/jquery.fileupload.config.js','imbrex');
	echo $asset->compile_js();
echo $output;
?>
<a class="btn btn-primary" href="{{ site_url }}{{ module_path }}/browse_imbrex_text_body_lg/index">{{ language:Show Front Page }}</a><script type="text/javascript">
    $(document).ajaxComplete(function () {
        //ADD COMPONENTS
        if($('.pDiv2 .delete_all_button').length == 0 && $('#flex1 tbody td .delete-row').length != 0) { //check if element already exists (for ajax refresh purposes)
            $('.pDiv2').prepend('<div class="pGroup"><a class="delete_all_button btn btn-default" href="#"><i class="glyphicon glyphicon-remove"></i> {{ language:Delete Selected }}</a></div>');
        }
        if($('#flex1 thead td .checkall').length == 0 && $('#flex1 tbody td .delete-row').length != 0){
            $('#flex1 thead tr').prepend('<td><input type="checkbox" class="checkall" /></td>');
            $('#flex1 tbody tr').each(function(){
                $(this).prepend('<td><input type="checkbox" value="' + $(this).attr('rowId') + '" /></td>');
            });
        }
    });

    // CHECK ALL
    $('.checkall').live('click', function(){
        $(this).parents('table:eq(0)').find(':checkbox').attr('checked', this.checked);
    });

    // DELETE ALL
    $('.delete_all_button').live('click', function(event){
        event.preventDefault();
        var list = new Array();
        $('input[type=checkbox]').each(function() {
            if (this.checked) {
                //create list of values that will be parsed to controller
                list.push(this.value);
            }
        });
        //send data to delete
        $.post('{{ MODULE_SITE_URL }}Manage_imbrex_text_body_lg/delete_selection', { data: JSON.stringify(list) }, function(data) {
            for(i=0; i<list.length; i++){
                //remove selection rows
                $('#flex1 tr[rowId="' + list[i] + '"]').remove();
            }
            alert('{{ language:Selected row deleted }}');
        });
    });

    $(document).ajaxComplete(function(){
        // TODO: Put your custom code here
    });

    $(document).ready(function(){
        // TODO: Put your custom code here
		var ALLOW_NAVIGATE_BACKEND = <?php echo $privileges['allow_navigate_backend'] ? "true" : "false"; ?>;
		var HAVE_ADD_PRIVILEGE     = <?php echo $privileges['have_add_privilege'] ? "true" : "false"; ?>;
		var HAVE_EDIT_PRIVILEGE     = <?php echo $privileges['have_edit_privilege'] ? "true" : "false"; ?>;
		var HAVE_DELETE_PRIVILEGE     = <?php echo $privileges['have_delete_privilege'] ? "true" : "false"; ?>;


        //Add
        /*$('.gc-file-upload').attr('disabled',true);
		$('#field-xml_id').on('change',(function(){
			if($(this).val().length !=0)
				$('.gc-file-upload').attr('disabled', false);            
			else
				$('.gc-file-upload').attr('disabled',true);
		}))*/
        
        //Edit
        //Maxres for Content box
        $('#Content').parent().removeClass('col-md-12 well');
        $('#__section-content').css('overflow-x','hidden');
        $('#xml_id_field_box').hide();
        //Put image and content side by side
        $('#file_field_box').next().remove();
        $('#file_field_box, #pagecontent_field_box').removeClass('col-md-12').addClass('col-md-6');
        //Remove labels
        $('#file_display_as_box, #pagecontent_display_as_box').hide();
        //Maxres for image and content box
        $('#file_input_box, #pagecontent_input_box').removeClass('col-md-10');//.addClass('col-md-12');
        //Make image responsive
        $('#file_input_box').find('img')
			.removeAttr('height').addClass('img-responsive');//.unwrap();
			//.parent().removeClass('image-thumbnail');
		//Calculate image height
		var imgHeight = $('#file_input_box img').height();
        $('#pagecontent_input_box textarea').css('min-height',imgHeight);
        $(".delete-anchor").addClass('btn btn-lg btn-danger').css('margin','20px');
        
        //Read
        var imgurl = $('.readonly_label a').attr('href');
        $('.readonly_label a').append('<img src="'+imgurl+'" alt="'+imgurl+'" />');
        
        //PRIVILEGES
        //Hide Delete link       
        //$('#file_input_box').on('change',(function(){
		if(ALLOW_NAVIGATE_BACKEND && HAVE_EDIT_PRIVILEGE && HAVE_ADD_PRIVILEGE === false){
			$('#field-xml_id').attr('disabled','disabled');
			$('#field_xml_id_chosen').removeClass('chosen-container-single').find('.chosen-drop').hide();
			$('#field_xml_id_chosen .chosen-single').contents().unwrap();
		}
	
		if(ALLOW_NAVIGATE_BACKEND && HAVE_DELETE_PRIVILEGE === false){
			$('.delete-anchor').hide();
		}
		
		//var field = $('#field-xml_id').val();
		$.ajax({
			url: '{{ module_site_url }}Manage_imbrex_text_body_lg/get_edition_title',
			type: 'POST',
			async:true,
			data:{
				trigger: 'title',
				page: window.location.href
				},
        success: function(data) {
            console.log(data);
            $('#edition_title').append(data);
			}

		})
		//$('edition_title').load('{{ module_site_url }}Manage_imbrex_text_body_lg/get_edition_title');
        
    });
</script>
