<h2>Manage Editions</h2>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//First: check if root directory is writable


if ( !is_writable(FCPATH) AND !is_dir(FCPATH."/files")) {
	echo "<div class=\"alert alert-danger\">
		<strong>".FCPATH." is not writable.</strong> It must be writable in order to create the files/ directory.<br>
		Change the permissions and reload this page.
		</div>";
    return false;    
} 
elseif ( is_writable(FCPATH) AND !is_dir(FCPATH."/files"))
{
	echo "<div class=\"alert alert-info\">
		<strong>".FCPATH."files doesn't exist</strong>. I'm going to create it.
		</div>";
		mkdir(FCPATH."/files");			
}
elseif ( is_writable(FCPATH) AND !is_writable(FCPATH."/files")) {
			echo "<div class=\"alert alert-danger\">
				<strong>".FCPATH."/files</strong> <em>is not writable</em>. It must be writable in order to manage your editions.<br>
				Change the permissions and reload this page.
				</div>";
				return false;    
}


echo $output;
?>
<div class="form-button-box" id="div-button-save-next-step">
<input id="form-button-save-next-step" value="Update and go to the next step" class="btn btn-default btn-large">
</div>
<a class="btn btn-primary" href="{{ site_url }}{{ module_path }}/browse_imbrex_filedesc/index">{{ language:Show Front Page }}</a><script type="text/javascript">
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
        $.post('{{ MODULE_SITE_URL }}Manage_imbrex_filedesc/delete_selection', { data: JSON.stringify(list) }, function(data) {
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
		$('a.edit_button')
			.addClass('btn-warning')
			.find('span')
			.each(function(){
				$(this)
					.text(' Edit Step 1')
					.prepend('<i class="glyphicon glyphicon-pencil"></i>');
				});
			
		$('a.edit_step2').each(function(){
			if($(this).attr('href')=='false'){
				$(this).hide();
				}
			else{
				var next = $(this).next('a.edit_button');
				$(this).before(next).before('&nbsp;');				
				}
			});
			
		$('a.delete-row').addClass('btn-danger');	
		//var box=$('#save-and-go-back-button');
		//console.log(box);
		if (!document.getElementById('save-and-go-back-button')) {
			$('#div-button-save-next-step').hide();
		} 
        // TODO: Put your custom code here
        $('#save-and-go-back-button').closest('.form-button-box').after($('#div-button-save-next-step'));
        
        $("#form-button-save-next-step").on('click', function(event){
			save_and_newstep = true;
			$('#crudForm').trigger('submit',[save_and_newstep]);			
		});
		
		$('#crudForm').submit(function(e,save_and_newstep){
			console.log(save_and_newstep);
			$('#form-button-save-next-step').prop('disabled', true);
			//console.log(save_and_newstep);
			if(save_and_newstep){
				var thisurl = window.location.href;
				var ed_id = thisurl.substring(thisurl.lastIndexOf('/') + 1);
				//var xml_id_value=$('#field-xml_id').val();
				
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
					
					var newdata = jQuery.parseJSON( data );
					if(newdata.success){
						var step2url = '{{ module_site_url }}Manage_imbrex_filedesc/go_to_step2';
						var REQUEST = $.ajax({
								'url'  : step2url,
								'type' : 'GET',
								'async': true,
					            'data' : {
					                'xml_id' : ed_id,
					                //'xml_id_value' : xml_id_value
									},
					
							success  : function(result){
								//console.log(result);
								window.location = '{{ module_site_url }}manage_imbrex_text/index/'+result;
		                		return true;
		               
								},
								
							});
						}
						
					},
					error: function(){
						form_error_message( message_update_error );
					}
	             });
			 }
            e.preventDefault();
			return false;
			});
    });
</script>
