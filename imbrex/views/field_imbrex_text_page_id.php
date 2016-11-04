<style type="text/css">
    #md_table_page_id th:last-child, #md_table_page_id td:last-child{
        text-align:right;
        width:150px!important;
    }
</style>
<?php
    // Generate HTML. Parameters: column_name, caption, array_of_field_captions

	//Get the status (col 'closed') score
	//to enable or disable "Manage Pages/Tiles" 
	//buttons at the end of page partial
	foreach($result as $k=>$v){
	$status[]=$v['closed'];
	}
	
	//var_dump($status);
	if(isset($status)){
	$status_max_score=count($status);
	$status_score=array_sum($status);
	$tile_disabled='';
	$page_disabled='';
	
	if($status_score==0){
		$tile_disabled="disabled";
		}
	elseif($status_score==$status_max_score){
		$page_disabled="disabled";
		}
	}
	else $tile_disabled=$page_disabled="disabled";
	
	//Set up the "Manage Pages/Tiles" Buttons
    $manage_table_link = '<a class="btn btn-primary '.$page_disabled.' save-on-click" href="{{ module_site_url }}manage_imbrex_text_body_lg/index/'.$primary_key.'"><i class="glyphicon glyphicon-list"></i> Manage Pages Table</a>&nbsp;';

	$manage_table_link .= '<a class="btn btn-success '.$tile_disabled.' save-on-click" href="{{ module_site_url }}manage_imbrex_tiles/index/'.$primary_key.'"><i class="glyphicon glyphicon-list"></i> Manage Tiled Pages Table</a>&nbsp;';

    $HTML = build_md_html_table('page_id', 'Page', array('xml:id', 'Page number', 'Mantain line breaks', 'Closed'), TRUE, TRUE, $manage_table_link);//'file', 'Shapes', 'Selections'));
    // Generate global variable and event-binding
    $JS   = build_md_global_variable_script('page_id', 'page_id', $date_format, $result, $options);
    $JS  .= build_md_event_script('page_id', '{{ module_site_url }}manage_imbrex_text/index/insert', '{{ module_site_url }}manage_imbrex_text/index/update');
    // Show HTML
    echo $HTML;
    // Show JS
    echo '<script type="text/javascript">'.$JS.'</script>';
?>

<script type="text/javascript">
		$("#field-xml_id").on('change',(function(){
			var xmlid = $(this).val();
			$('input[column_name=xml_id]').val(xmlid);
		}))

    // Function to get default value
    function default_row_page_id(){
		var xmlid = $("#field-xml_id").val();		
        return {
			
            xml_id : xmlid,
            file : '',
            pagenum : '',
            linebreaks : '',
            pagecontent : '',
            closed : '',
            shapes : '',
            selections : '',
            labels : '',
        };
    }

    // Function to add row
    function add_table_row_page_id(value){

        // Prepare some variables
        var input_prefix = 'md_field_page_id_col';
        var row_index    = RECORD_INDEX_page_id;
        var inputs       = new Array();
        
        // FIELD "xml_id"
        var input_id    = input_prefix + 'xml_id' + row_index;
        var field_value = get_object_property_as_str(value, 'xml_id');
        //var html = '<select id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' numeric chzn-select" column_name="xml_id" >';
        //html += build_single_select_option(field_value, OPTIONS_page_id.xml_id);
        //html += '</select>';
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="xml_id" type="text" readonly value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "file"
        // Doesn't work Multiple File upload seems impossible
        /*var input_id    = input_prefix + 'file' + row_index;
        var field_value = get_object_property_as_str(value, 'file');
        
        if(!field_value){
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="file" type="file" />';
        }
        else { var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="file" type="text" readonly value="'+field_value+'"/>';
		}
		
        inputs.push(html);*/

        // FIELD "pagenum"
        var input_id    = input_prefix + 'pagenum' + row_index;
        var field_value = get_object_property_as_str(value, 'pagenum');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' numeric" column_name="pagenum" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "linebreaks"
        
        var input_id    = input_prefix + 'linebreaks' + row_index;
        var field_value = get_object_property_as_str(value, 'linebreaks');
        
        //This code sets up the input as radiobuttons: doesn't work
        /*var checked='checked="checked"';
        var checkedt='';
        var checkedf=''; 
        
        if(field_value==1) {
			checkedt=checked;
		}
        else if(field_value==0) {
			checkedf=checked;
		}
        

       var html = '<div class="subpage-field-radio"><label class="radio-inline"><input id="'+input_id+'_true" class="'+input_prefix+' radio-uniform form-control" type="radio" column_name="linebreaks" name="'+input_id+'" value="1" '+checkedt+'></span>Y</label></div><div class="subpage-field-radio"><label class="radio-inline"><input id="'+input_id+'_false" class="'+input_prefix+' radio-uniform form-control" type="radio" colum_name="linebreaks" name="'+input_id+'" value="0" '+checkedf+'> N</label></div>';
		inputs.push(html);*/
        
        //this code sets the input as a select
        var selected='selected="selected"';
        var selectedt='';
        var selectedf=''; 
        
        if(field_value==1) {
			selectedt=selected;
		}
        else if(field_value==0) {
			selectedf=selected;
		}
        
        
        var html = '<select id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' numeric" column_name="linebreaks" >';
        html +='<option value="1" '+selectedt+'>Yes</option>';
        html +='<option value="0" '+selectedf+'>No</option>';
        html += '</select>';

        inputs.push(html);
        
        // FIELD "pagecontent"
        /*var input_id    = input_prefix + 'pagecontent' + row_index;
        var field_value = get_object_property_as_str(value, 'pagecontent');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="pagecontent" type="text" value="'+field_value+'"/>';
        inputs.push(html);*/

        // FIELD "closed"
        var input_id    = input_prefix + 'closed' + row_index;
        var field_value = get_object_property_as_str(value, 'closed');
		
		//This code sets up the input as radiobuttons: doesn't work
        /*var checked='checked="checked"';
        var checkedclass='class="checked"';
        var checkedt='';
        var checkedf=''; 
        
        if(field_value==1) {
			checkedt=checked;
			//checkedtclass=checkedclass;
		}
        else if(field_value==0) {
			checkedf=checked;
			//checkedfclass=checkedclass;
		}
        
        var html = '<div class="subpage-field-radio"><label class="radio-inline"><input id="'+input_id+'_true" class="'+input_prefix+' radio-uniform form-control" type="radio" column_name="closed" name="'+input_id+'" value="1" '+checkedt+'></span>Y</label></div><div class="subpage-field-radio"><label class="radio-inline"><input id="'+input_id+'_false" class="'+input_prefix+' radio-uniform form-control" type="radio" column_name="closed" name="'+input_id+'" value="0" '+checkedf+'> N</label></div>';*/
        
        //this code sets the input as a select
        var selected='selected="selected"';
        var selectedt='';
        var selectedf=''; 
        
        if(field_value==1) {
			selectedt=selected;
		}
        else if(field_value==0) {
			selectedf=selected;
		}
        
        
        var html = '<select id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+' numeric" column_name="closed" >';
        html +='<option value="1" '+selectedt+'>Yes</option>';
        html +='<option value="0" '+selectedf+'>No</option>';
        html += '</select>';
        
		inputs.push(html);

/*
        // FIELD "shapes"
        var input_id    = input_prefix + 'shapes' + row_index;
        var field_value = get_object_property_as_str(value, 'shapes');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="shapes" type="text" value="'+field_value+'"/>';
        inputs.push(html);

        // FIELD "selections"
        var input_id    = input_prefix + 'selections' + row_index;
        var field_value = get_object_property_as_str(value, 'selections');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="selections" type="text" value="'+field_value+'"/>';
        inputs.push(html);
        
        // FIELD "labels"
        var input_id    = input_prefix + 'labels' + row_index;
        var field_value = get_object_property_as_str(value, 'labels');
        var html = '<input id="'+input_id+'" record_index="'+row_index+'" class="'+input_prefix+'" column_name="labels" type="text" value="'+field_value+'"/>';
        inputs.push(html);
*/
//.replace("C:\\fakepath\\", "");
        // Return inputs
        return inputs;
    }

    function add_table_row_page_id_action(value){
        actions = []
        for(var i=0; i<DATA_page_id.update.length; i++){
            row = DATA_page_id.update[i];
           
            if(row.data == value){
				if(row.data.closed==0){
					actions.push('<a class="btn btn-primary save-on-click" href="{{ module_site_url }}manage_imbrex_text_body_lg/index/<?php echo $primary_key; ?>/edit/' + row.primary_key + '"><i class="glyphicon glyphicon-pencil"></i> Edit Text</a>');
				}
				else if(row.data.closed==1){
					actions.push('<a class="btn btn-success save-on-click" href="{{ module_site_url }}edit_imbrex_tile?page_id=' + row.primary_key +'"><i class="glyphicon glyphicon-pencil"></i> Edit Tile</a>');
					}
                break;
            }
        }
        return actions;
    }

    $(".save-on-click").live('click', function(event){
        $("#form-button-save").trigger('click');
    });
        
    $(document).ready(function(){
        // TODO: Put your custom code here
        //$('#md_real_field_page_id_col').show();//.on('change',(function(){
		
    });		
</script>
