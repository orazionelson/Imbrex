<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('selections', 'Selections', array('json_id', 'StartParent', 'StartOffset', 'StartChild', 'EndParent', 'EndOffset', 'EndChild', 'Color'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('selections', 'selection_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('selections', '{{ module_site_url }}manage_imbrex_text_body_lg/index/insert', '{{ module_site_url }}manage_imbrex_text_body_lg/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">

    // Function to get default value
    function default_row_selections(){
        return {
            id : '',
            startparent : '',
            startoffset : '',
            startchild : '',
            endparent : '',
            endoffset : '',
            endchild : '',
            color : '',
        };
    }

    // Function to add row
    function add_table_row_selections(value){

        // Prepare some variables
        var input_prefix = 'md_field_selections_col';
        var row_index    = RECORD_INDEX_selections;
        var inputs       = new Array();
        
        // FIELD "id"
        var input_id    = input_prefix + 'id' + row_index;
        var field_value = get_object_property_as_str(value, 'id');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="id" type="text" value="'+field_value+'"/>';
        inputs.push(html);
        
        // FIELD "startparent"
        var input_id    = input_prefix + 'startparent' + row_index;
        var field_value = get_object_property_as_str(value, 'startparent');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="startparent" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "startoffset"
        var input_id    = input_prefix + 'startoffset' + row_index;
        var field_value = get_object_property_as_str(value, 'startoffset');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="startoffset" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "startchild"
        var input_id    = input_prefix + 'startchild' + row_index;
        var field_value = get_object_property_as_str(value, 'startchild');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="startchild" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "endparent"
        var input_id    = input_prefix + 'endparent' + row_index;
        var field_value = get_object_property_as_str(value, 'endparent');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="endparent" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "endoffset"
        var input_id    = input_prefix + 'endoffset' + row_index;
        var field_value = get_object_property_as_str(value, 'endoffset');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="endoffset" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "endchild"
        var input_id    = input_prefix + 'endchild' + row_index;
        var field_value = get_object_property_as_str(value, 'endchild');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="endchild" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "color"
        var input_id    = input_prefix + 'color' + row_index;
        var field_value = get_object_property_as_str(value, 'color');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="color" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
