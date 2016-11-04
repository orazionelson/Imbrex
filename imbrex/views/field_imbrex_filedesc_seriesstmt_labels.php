<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('labels', 'Labels', array('json id', 'name'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('labels', 'label_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('labels', '{{ module_site_url }}manage_imbrex_filedesc_seriesstmt/index/insert', '{{ module_site_url }}manage_imbrex_filedesc_seriesstmt/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">
	
		
	function get_unique_series_label_json_id(){
		var ids = [];
		$('#md_table_labels tbody tr').each(function(){
			ids.push($(this).find("td:first input").val()); //put elements into array
		});		
		var id="l_"+(Math.floor(Math.random()*560));
		
		var a = $.inArray(id, ids);
		
		if(a!=-1){
			get_unique_series_label_json_id();
			}
		else{
			return id;
			}
		}
	
    // Function to get default value
    function default_row_labels(){
		//var ids = $('#md_table_labels').find('td:first input').val();	
		//console.log(ids);
		var id=get_unique_series_label_json_id();
		
        return {
            id : id,
            name : '',
        };
    }

    // Function to add row
    function add_table_row_labels(value){

        // Prepare some variables
        var input_prefix = 'md_field_labels_col';
        var row_index    = RECORD_INDEX_labels;
        var inputs       = new Array();
        
        // FIELD "id"
        var input_id    = input_prefix + 'id' + row_index;
        var field_value = get_object_property_as_str(value, 'id');
        
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="id" type="text" readonly value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "name"
        var input_id    = input_prefix + 'name' + row_index;
        var field_value = get_object_property_as_str(value, 'name');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="name" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
