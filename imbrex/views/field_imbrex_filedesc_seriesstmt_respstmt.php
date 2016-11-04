<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('respstmt', 'Responsibility', array('Resposibility', 'Type', 'Name', 'Key'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('respstmt', 'resp_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('respstmt', '{{ module_site_url }}manage_imbrex_filedesc_seriesstmt/index/insert', '{{ module_site_url }}manage_imbrex_filedesc_seriesstmt/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">

    // Function to get default value
    function default_row_respstmt(){
        return {
            resp : '',
            type : '',
            name : '',
            key : '',
        };
    }

    // Function to add row
    function add_table_row_respstmt(value){

        // Prepare some variables
        var input_prefix = 'md_field_respstmt_col';
        var row_index    = RECORD_INDEX_respstmt;
        var inputs       = new Array();
        
        // FIELD "resp"
        var input_id    = input_prefix + 'resp' + row_index;
        var field_value = get_object_property_as_str(value, 'resp');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="resp" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "type"
        var input_id    = input_prefix + 'type' + row_index;
        var field_value = get_object_property_as_str(value, 'type');
        var html = '<select id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' chzn-select" column_name="type" >';
        html += build_single_select_option(field_value, OPTIONS_respstmt.type);
        html += '</select>';
        inputs.push(html);

        // FIELD "name"
        var input_id    = input_prefix + 'name' + row_index;
        var field_value = get_object_property_as_str(value, 'name');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="name" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "key"
        var input_id    = input_prefix + 'key' + row_index;
        var field_value = get_object_property_as_str(value, 'key');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="key" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
