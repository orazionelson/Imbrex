<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('labels', 'Page Labels', array('json id', 'Name', 'Selections', 'shapes'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('labels', 'label_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('labels', '{{ module_site_url }}manage_imbrex_text_body_lg/index/insert', '{{ module_site_url }}manage_imbrex_text_body_lg/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">

    // Function to get default value
    function default_row_labels(){
        return {
            id : '',
            name : '',
            selections : '',
            shapes : '',
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
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="id" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "name"
        var input_id    = input_prefix + 'name' + row_index;
        var field_value = get_object_property_as_str(value, 'name');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="name" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "selections"
        var input_id    = input_prefix + 'selections' + row_index;
        var field_value = get_object_property_as_str(value, 'selections');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="selections" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "shapes"
        var input_id    = input_prefix + 'shapes' + row_index;
        var field_value = get_object_property_as_str(value, 'shapes');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="shapes" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
