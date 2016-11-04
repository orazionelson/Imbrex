<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('shapes', 'Shapes', array('json id', 'Type', 'Scale', 'Color', 'pos x', 'pos y', 'width/rx', 'height/ry', 'labels', 'lines'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('shapes', 'shape_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('shapes', '{{ module_site_url }}manage_imbrex_text_body_lg/index/insert', '{{ module_site_url }}manage_imbrex_text_body_lg/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">

    // Function to get default value
    function default_row_shapes(){
        return {
            id : '',
            type : '',
            _scale : '',
            color : '',
            posinfo_x_cx : '',
            posinfo_y_cy : '',
            posinfo_width_rx : '',
            posinfo_height_ry : '',
            labels : '',
            lines : '',
        };
    }

    // Function to add row
    function add_table_row_shapes(value){

        // Prepare some variables
        var input_prefix = 'md_field_shapes_col';
        var row_index    = RECORD_INDEX_shapes;
        var inputs       = new Array();
        
        // FIELD "id"
        var input_id    = input_prefix + 'id' + row_index;
        var field_value = get_object_property_as_str(value, 'id');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="id" type="text" value="'+field_value+'"/>';
        inputs.push(html);        

        // FIELD "type"
        var input_id    = input_prefix + 'type' + row_index;
        var field_value = get_object_property_as_str(value, 'type');
        var html = '<select id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' chzn-select" column_name="type" >';
        html += build_single_select_option(field_value, OPTIONS_shapes.type);
        html += '</select>';
        inputs.push(html);

        // FIELD "_scale"
        var input_id    = input_prefix + '_scale' + row_index;
        var field_value = get_object_property_as_str(value, '_scale');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="_scale" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "color"
        var input_id    = input_prefix + 'color' + row_index;
        var field_value = get_object_property_as_str(value, 'color');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="color" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "posinfo_x_cx"
        var input_id    = input_prefix + 'posinfo_x_cx' + row_index;
        var field_value = get_object_property_as_str(value, 'posinfo_x_cx');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="posinfo_x_cx" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "posinfo_y_cy"
        var input_id    = input_prefix + 'posinfo_y_cy' + row_index;
        var field_value = get_object_property_as_str(value, 'posinfo_y_cy');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="posinfo_y_cy" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "posinfo_width_rx"
        var input_id    = input_prefix + 'posinfo_width_rx' + row_index;
        var field_value = get_object_property_as_str(value, 'posinfo_width_rx');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="posinfo_width_rx" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "posinfo_height_ry"
        var input_id    = input_prefix + 'posinfo_height_ry' + row_index;
        var field_value = get_object_property_as_str(value, 'posinfo_height_ry');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="posinfo_height_ry" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "labels"
        var input_id    = input_prefix + 'labels' + row_index;
        var field_value = get_object_property_as_str(value, 'labels');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="labels" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "lines"
        var input_id    = input_prefix + 'lines' + row_index;
        var field_value = get_object_property_as_str(value, 'lines');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="lines" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
