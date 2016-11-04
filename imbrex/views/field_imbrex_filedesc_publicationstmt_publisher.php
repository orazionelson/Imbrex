<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions
    $HTML = build_md_html_table('publicationstmt_publisher', 'Publisher', array('Publisher', 'Address', 'Target'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('publicationstmt_publisher', 'publisher_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('publicationstmt_publisher', '{{ module_site_url }}manage_imbrex_filedesc/index/insert', '{{ module_site_url }}manage_imbrex_filedesc/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>
<script type="text/javascript">

    // Function to get default value
    function default_row_publicationstmt_publisher(){
        return {
            publisher : '',
            address : '',
            target : '',
        };
    }

    // Function to add row
    function add_table_row_publicationstmt_publisher(value){

        // Prepare some variables
        var input_prefix = 'md_field_publicationstmt_publisher_col';
        var row_index    = RECORD_INDEX_publicationstmt_publisher;
        var inputs       = new Array();
        
        // FIELD "publisher"
        var input_id    = input_prefix + 'publisher' + row_index;
        var field_value = get_object_property_as_str(value, 'publisher');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="publisher" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "address"
        var input_id    = input_prefix + 'address' + row_index;
        var field_value = get_object_property_as_str(value, 'address');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="address" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "target"
        var input_id    = input_prefix + 'target' + row_index;
        var field_value = get_object_property_as_str(value, 'target');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="target" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // Return inputs
        return inputs;
    }

</script>
