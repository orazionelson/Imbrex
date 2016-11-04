<h3>Manage Text Step 2</h3>
<h2 id="edition_title" class="text-success"></h2>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//$xml_id_value=$this->input->get('xml_id_value');

	$asset = new Cms_asset();	
	$asset->add_module_css('styles/imbrex.css','imbrex');
	echo $asset->compile_css()."\n";
	
	//if($xml_id_value){ echo "<br><div class=\"alert alert-info\">The <strong>Edition XML Id</strong> to select is <strong>".$xml_id_value."</strong></div>";}
	
	echo $output;
?>
<div class="form-button-box" id="div-button-save-back-to-step1">
<button id="form-button-save-back-to-step1" class="btn btn-primary btn-large">Save and back to the main list</button>
</div>
<a class="btn btn-primary" href="{{ site_url }}{{ module_path }}/browse_imbrex_text/index">{{ language:Show Front Page }}</a>
<script>

</script>
<script type="text/javascript">

	function GetQueryStringParams(sParam) {
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
		
		for (var i = 0; i < sURLVariables.length; i++)
	    {
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
	        {	
	            return sParameterName[1];
	        }			
		}
	}
	
    /*$(document).ajaxComplete(function () {
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
    });*/

    // CHECK ALL
    /*$('.checkall').live('click', function(){
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
        $.post('{{ MODULE_SITE_URL }}Manage_imbrex_text/delete_selection', { data: JSON.stringify(list) }, function(data) {
            for(i=0; i<list.length; i++){
                //remove selection rows
                $('#flex1 tr[rowId="' + list[i] + '"]').remove();
            }
            alert('{{ language:Selected row deleted }}');
        });
    });*/

    $(document).ajaxComplete(function(){
        // TODO: Put your custom code here
        $('#report-success a').attr('href','{{ module_site_url }}manage_imbrex_filedesc');
    });

    $(document).ready(function(){
				
        // TODO: Put your custom code here
        $('#md_real_field_page_id_col').show();
		$('.add_button').hide();
		$('.delete-row').hide();
		
		var xml_id = GetQueryStringParams('xml_id');


		if (!document.getElementById('save-and-go-back-button')) {
			$('#div-button-save-back-to-step1').hide();
		} 
        
        
        
        if(xml_id)
        {
			if($.isNumeric(xml_id)){
				$('#field-xml_id').show().val(xml_id).prop('disabled',true);
				var val = $('#field-xml_id option:selected').text();
				$('#field_xml_id_chosen a span').empty().append(val);
				$('#field_xml_id_chosen').hide();
			}
			else {
				
				var url = '{{ module_site_url }}Manage_imbrex_text/get_last_ed_id';
				$.ajax({
						'url'  : url,
						success  : function(result){
						//console.log(result);
						$('#field-xml_id').show().val(result).prop('disabled',true);
						var val = $('#field-xml_id option:selected').text();
						$('#field_xml_id_chosen a span').empty().append(val);
						$('#field_xml_id_chosen').hide();
                		return true;
               
						},
					})
				}
		}
		else {
			$('#field-xml_id').show().prop('disabled',true);
			$('#field_xml_id_chosen').hide();
		}
		
		$('#save-and-go-back-button').hide();
		$('#form-button-save').closest('.form-button-box').after($('#div-button-save-back-to-step1'));
		
		 $("#form-button-save-back-to-step1").on('click', function(event){
			//save_and_step1 = true;
			
			//$('#crudForm').trigger('submit');		
			$('#crudForm').on('submit', function(e) {
				$('#form-button-save-back-to-step1').addClass('disabled');
				$('#field-xml_id').prop('disabled', false);
			
				//if(save_and_step1){
					var my_crud_form = $(this);
					$(this).ajaxSubmit({
						url: validation_url,
						dataType: 'text',
						cache: 'false',
						beforeSend: function(){
							$("#FormLoading").show();
						},
						success: function(data){
							$("#FormLoading").hide();
							window.location = '{{ module_site_url }}manage_imbrex_filedesc';
						},
						error: function(){
							form_error_message( message_update_error );
						}
					});
				//}
			e.preventDefault();
			return false;	
			});
	
		});
			
		$('#crudForm').on('submit', function() {
			$('#form-button-save-back-to-step1').prop('disabled', true);
			$('#field-xml_id').prop('disabled', false);
		});
		
		$('#edition_title').text('yyy');
		//alert($('#field-xml_id').val());
		var field = $('#field-xml_id').val();
		$.ajax({
			url: '{{ module_site_url }}Manage_imbrex_text/get_edition_title',
			type: 'GET',
			async:false,
			data: {
				xml_id : field
				},
        success: function(data) {
            //console.log(data);
            $('#edition_title').text(data);
			}

		})
		//$('#edition_title')
		
		
    });
</script>
