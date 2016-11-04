<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Manage_imbrex_text_body_lg
 *
 * @author No-CMS Module Generator
 */
class Manage_imbrex_text_body_lg extends CMS_CRUD_Controller {

    protected $URL_MAP = array();
    protected $TABLE_NAME = 'imbrex_text_body_lg';
    protected $COLUMN_NAMES = array('xml_id', 'file', 'pagenum', 'linebreaks', 'pagecontent', 'closed', 'shapes', 'selections', 'labels', 'text_id');
    protected $PRIMARY_KEY = 'page_id';
    protected $UNSET_JQUERY = TRUE;
    protected $UNSET_READ = TRUE;
    protected $UNSET_ADD = TRUE;
    protected $UNSET_EDIT = FALSE;
    protected $UNSET_DELETE = FALSE;
    protected $UNSET_LIST = FALSE;
    protected $UNSET_BACK_TO_LIST = FALSE;
    protected $UNSET_PRINT = FALSE;
    protected $UNSET_EXPORT = FALSE;

    protected function make_crud(){
        $crud = parent::make_crud();

        ////////////////////////////////////////////////////////////////////////
        // HINT: You can access this variables after calling parent's make_crud method:
        //      $this->CRUD
        //      $this->STATE
        //      $this->STATE_INFO
        //      $this->PK_VALUE
        ////////////////////////////////////////////////////////////////////////

        // set subject
        $crud->set_subject('Page');

        // displayed columns on list, edit, and add, uncomment to use
        $crud->columns('xml_id','file', 'pagenum', 'linebreaks', 'closed');
        $crud->edit_fields('xml_id', 'pagenum', 'linebreaks','closed','file', 'pagecontent', '_updated_by', '_updated_at');
        //$crud->add_fields('xml_id', 'pagenum', 'linebreaks', 'closed','file','pagecontent','_created_by', '_created_at');
        $crud->set_read_fields('xml_id', 'pagenum', 'linebreaks', 'closed','file','pagecontent');

        // caption of each columns
        $crud->display_as('xml_id','xml:Id');
        $crud->display_as('file','file');
        $crud->display_as('pagenum','Page number');
        $crud->display_as('linebreaks','Mantain line breaks');
        $crud->display_as('pagecontent','Content');
        $crud->display_as('closed','Closed');
        $crud->display_as('labels','Labels');        
        $crud->display_as('text_id','Volume id');
        $crud->display_as('shapes','Shapes');
        $crud->display_as('selections','Selections');

		$crud->unset_texteditor('pagecontent');
        ////////////////////////////////////////////////////////////////////////
        // This function will automatically detect every methods in this controller and link it to corresponding column
        // if the name is match by convention. In other word, you don't need to manually define callback.
        // Here is the convention (replace COLUMN_NAME with your column's name)
        //
        // * callback column (called when viewing the data as list):
        //      public function _callback_column_COLUMN_NAME($value, $row){}
        //
        // * callback field (called when show add and edit form):
        //      public function _callback_field_COLUMN_NAME($value, $primary_key){}
        //
        // * validation rule callback (field validation when adding/editing data)
        //      public function COLUMN_NAME_validation($value){}
        ////////////////////////////////////////////////////////////////////////
        $this->build_default_callback();

        ////////////////////////////////////////////////////////////////////////
        // HINT: Put required field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/required_fields)
        // eg:
        //      $crud->required_fields( $field1, $field2, $field3, ... );
        ////////////////////////////////////////////////////////////////////////
        $crud->required_fields('xml_id');

        ////////////////////////////////////////////////////////////////////////
        // HINT: Put required field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/unique_fields)
        // eg:
        //      $crud->unique_fields( $field1, $field2, $field3, ... );
        ////////////////////////////////////////////////////////////////////////
        

        ////////////////////////////////////////////////////////////////////////
        // HINT: Put field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_rules)
        // eg:
        //      $crud->set_rules( $field_name , $caption, $filter );
        ////////////////////////////////////////////////////////////////////////


        ////////////////////////////////////////////////////////////////////////
        // HINT: Put set relation (lookup) codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation)
        // eg:
        //      $crud->set_relation( $field_name , $related_table, $related_title_field , $where , $order_by );
        ////////////////////////////////////////////////////////////////////////
        $crud->set_relation('xml_id', $this->t('imbrex_filedesc'), 'xml_id');

        ////////////////////////////////////////////////////////////////////////
        // HINT: Put set relation_n_n (detail many to many) codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation_n_n)
        // eg:
        //      $crud->set_relation_n_n( $field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table,
        //          $primary_key_alias_to_selection_table , $title_field_selection_table, $priority_field_relation );
        ////////////////////////////////////////////////////////////////////////


        ////////////////////////////////////////////////////////////////////////
        // HINT: Put custom field type here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/field_type)
        // eg:
        //      $crud->field_type( $field_name , $field_type, $value  );
        ////////////////////////////////////////////////////////////////////////
        $crud->field_type('linebreaks', 'true_false', array('N','Y'));
        $crud->field_type('closed', 'true_false', array('N', 'Y'));
        //$crud->field_type('xml_id', 'readonly');

        $state = $this->STATE;
		$state_info = $crud->getStateInfo();
			
		if($state == 'add' OR $state=='upload_file')
		{
			$upload_path='modules/'.$this->cms_module_path().'/assets/uploads';
			
		}
		elseif($state=='edit' OR $state=='read') 
		{
			$query=$this->get_row();
			$srow = $query->row_array(); 
			$upload_path='files/'.$srow['xml_id'].'/images';	
		}
		elseif($state=='delete_file')
		{
			$page_url=$this->agent->referrer();
			$keys = parse_url($page_url); // parse the url
			$path = explode("/", $keys['path']); // splitting the path
			$last = end($path);
			if(is_numeric($last)){
				$query=$this->get_row($this->t($this->TABLE_NAME), $last);
				$sel_row = $query->row_array(); 
				$upload_path='files/'.$sel_row['xml_id'].'/images';
			}
			else $upload_path='modules/'.$this->cms_module_path().'/assets/uploads';
		
		}
		elseif($state=='list' OR $state=='ajax_list')
		{	
			$upload_path='';
			$crud->callback_column('file',array($this,'list_set_file_path'));
			
			
			$text_id=end($this->uri->segments);
			
			if(is_numeric($text_id)){
				$query=$this->db->get_where($this->t('imbrex_text'), array('text_id' => $text_id));
				$sel_row = $query->row_array(); 
				$crud->where($this->t($this->TABLE_NAME).'.`xml_id` =', $sel_row['xml_id']);
			}
		}
		elseif($state=='success')
		{	
			$upload_path='';
			$crud->callback_column('file',array($this,'list_set_file_path'));
			
			$page_id=end($this->uri->segments);
			if(is_numeric($page_id)){
				$query=$this->get_row();//$this->t($this->TABLE_NAME), $page_id);
				$sel_row = $query->row_array(); 
				$crud->where($this->t($this->TABLE_NAME).'.`xml_id` =', $sel_row['xml_id']);
			}	
		}		

			
		$crud->set_field_upload('file',$upload_path);
		
        ////////////////////////////////////////////////////////////////////////
        // HINT: Put Tabs (if needed)
        // usage:
        //     $crud->set_outside_tab($how_many_field_outside_tab);
        //     $crud->set_tabs(array(
        //        'First Tab Caption'  => $how_many_field_on_first_tab,
        //        'Second Tab Caption' => $how_many_field_on_second_tab,
        //     ));
        ////////////////////////////////////////////////////////////////////////
		$crud->set_outside_tab(4);
             $crud->set_tabs(array(
                'Content'  => 2,
             ));
        ////////////////////////////////////////////////////////////////////////
        // HINT: Create custom search form (if needed)
        // usage:
        //     $crud->unset_default_search();
        //     // Your custom form
        //     $html =  '<div class="row container col-md-12" style="margin-bottom:10px;">';
        //     $html .= '</div>';
        //     $html .= '<input name="keyword" placeholder="Keyword" value="'.$keyword.'" /> &nbsp;';
        //     $html .= '<input type="button" value="Search" class="crud_search btn btn-primary form-control" id="crud_search" />';
        //     $crud->set_search_form_components($html);
        ////////////////////////////////////////////////////////////////////////



        ////////////////////////////////////////////////////////////////////////
        // HINT: Put callback here
        // (documentation: httm://www.grocerycrud.com/documentation/options_functions)
        ////////////////////////////////////////////////////////////////////////
		//$crud->callback_field('file',array($this,'field_callback_file'));
        ////////////////////////////////////////////////////////////////////////
        // HINT: Put custom error message here
        // (documentation: httm://www.grocerycrud.com/documentation/set_lang_string)
        ////////////////////////////////////////////////////////////////////////
        // $crud->set_lang_string('delete_error_message', 'Cannot delete the record');
        // $crud->set_lang_string('update_error',         'Cannot edit the record'  );
        // $crud->set_lang_string('insert_error',         'Cannot add the record'   );
		$crud->where('closed =', 0);

		
        $this->CRUD = $crud;
        return $crud;
    }

    public function index(){
		
		$module_path = $this->cms_module_path();
        $privileges = array(
            'allow_navigate_backend'    => $this->cms_allow_navigate($this->n('manage_imbrex_text_body_lg')),
            'have_add_privilege'        => $this->cms_have_privilege($this->n('add_imbrex_text_body_lg')),
            'have_edit_privilege'       => $this->cms_have_privilege($this->n('edit_imbrex_text_body_lg')),
            'have_delete_privilege'     => $this->cms_have_privilege($this->n('delete_imbrex_text_body_lg')),
            //'backend_url'               => site_url($module_path.'/manage_imbrex_text_body_lg/index'),
            'module_path'               => $module_path,
            //'first_data'                => Modules::run($module_path.'/browse_imbrex_text_body_lg/get_data', 0, '')
        );
        
        // create crud
        $crud = $this->make_crud();
		
        // render
        $render = $this->render_crud($crud);
        $output = $render['output'];
        $config = $render['config'];
        $output->privileges=$privileges;
        
        // show the view
        $this->view($this->cms_module_path().'/Manage_imbrex_text_body_lg_view', $output,
            $this->n('manage_imbrex_text_body_lg'), $config);
    }
    
    function field_callback_file($value = '', $primary_key = null)
	{
	//echo '<script>$("body").removeClass("image-thumbnail");</script>';
	}
		

    // returned on insert and edit
    public function _callback_field_shapes($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array(
            'type' => array('rect','ellipse'),
        );
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array();
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_text_shapes', // DETAIL TABLE NAME
                'shape_id', // DETAIL PK NAME
                'page_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_text_body_lg_shapes',$data, TRUE);
    }

    // returned on view
    public function _callback_column_shapes($value, $row){
        return $this->_humanized_record_count(
                'imbrex_text_shapes', // DETAIL TABLE NAME
                'page_id', // DETAIL FK NAME
                $row->page_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Shapes',
                    'multiple_caption'  => 'Shapess',
                    'zero_caption'      => 'No Shapes',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_selections($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array();
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array();
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_text_selections', // DETAIL TABLE NAME
                'selection_id', // DETAIL PK NAME
                'page_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_text_body_lg_selections',$data, TRUE);
    }

    // returned on view
    public function _callback_column_selections($value, $row){
        return $this->_humanized_record_count(
                'imbrex_text_selections', // DETAIL TABLE NAME
                'page_id', // DETAIL FK NAME
                $row->page_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Selections',
                    'multiple_caption'  => 'Selectionss',
                    'zero_caption'      => 'No Selections',
                )
            );
    }

    // returned on insert and edit
    public function _callback_field_labels($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array();
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array();
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_page_labels', // DETAIL TABLE NAME
                'label_id', // DETAIL PK NAME
                'page_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_text_body_lg_labels',$data, TRUE);
    }

    // returned on view
    public function _callback_column_labels($value, $row){
        return $this->_humanized_record_count(
                'imbrex_page_labels', // DETAIL TABLE NAME
                'page_id', // DETAIL FK NAME
                $row->page_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Page Labels',
                    'multiple_caption'  => 'Page Labelss',
                    'zero_caption'      => 'No Page Labels',
                )
            );
    }

    public function _after_insert_or_update($post_array, $primary_key){
        // SAVE CHANGES OF imbrex_text_shapes
        $data = json_decode($this->input->post('md_real_field_shapes_col'), TRUE);
        $this->_save_one_to_many(
            'shapes', // FIELD NAME
            'imbrex_text_shapes', // DETAIL TABLE NAME
            'shape_id', // DETAIL PK NAME
            'page_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('shape_id', 'id', 'type', '_scale', 'color', 'posinfo_x_cx', 'posinfo_y_cy', 'posinfo_width_rx', 'posinfo_height_ry', 'labels', 'lines'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_text_selections
        $data = json_decode($this->input->post('md_real_field_selections_col'), TRUE);
        $this->_save_one_to_many(
            'selections', // FIELD NAME
            'imbrex_text_selections', // DETAIL TABLE NAME
            'selection_id', // DETAIL PK NAME
            'page_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('selection_id', 'id', 'startparent', 'startoffset', 'startchild', 'endparent', 'endoffset', 'endchild', 'color', 'labels'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_page_labels
        $data = json_decode($this->input->post('md_real_field_labels_col'), TRUE);
        $this->_save_one_to_many(
            'labels', // FIELD NAME
            'imbrex_page_labels', // DETAIL TABLE NAME
            'label_id', // DETAIL PK NAME
            'page_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('label_id', 'id', 'name', 'selections', 'shapes'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );
        
        return TRUE;
    }

    public function _before_insert_or_update($post_array, $primary_key=NULL){
		return $post_array;
    }

    public function _show_edit($primary_key){
		
        return TRUE;
    }

    public function _show_delete($primary_key){
        return TRUE;
    }

    public function _allow_edit($primary_key){
        return TRUE;
    }

    public function _allow_delete($primary_key){
        return TRUE;
    }

    public function _before_insert($post_array){
        return $post_array;
    }

	public function _after_insert($post_array, $primary_key){		
		$upload_path='modules/'.$this->cms_module_path().'/assets/uploads/'.$post_array['file']; 		
		$repo_path="files/".$post_array['xml_id']."/images/".$post_array['file'];
		
		if (!copy($upload_path, $repo_path)) {
			return false;
		}
		else {
			unlink($upload_path);
			return true;
			}    
	}

    public function _before_update($post_array, $primary_key){
		return $post_array;
    }

    public function _after_update($post_array, $primary_key){
		//var_dump($post_array);
		$upload_path='modules/'.$this->cms_module_path().'/assets/uploads/'.$post_array['file']; 		
		$repo_path="files/".$post_array['xml_id']."/images/".$post_array['file'];
		if(is_file($upload_path)){
			if (!copy($upload_path, $repo_path)) {
				return false;
			}
			else {
				unlink($upload_path);
				return true;
			}
		}
        return TRUE;
    }

    public function _before_delete($primary_key){
        // delete corresponding imbrex_text_shapes
        $this->db->delete($this->t('imbrex_text_shapes'),
              array('page_id'=>$primary_key));
        // delete corresponding imbrex_text_selections
        $this->db->delete($this->t('imbrex_text_selections'),
              array('page_id'=>$primary_key));
        // delete corresponding imbrex_page_labels
        $this->db->delete($this->t('imbrex_page_labels'),
              array('page_id'=>$primary_key));
        return TRUE;
    }

    public function _after_delete($primary_key){
        return TRUE;
    }

	public function edit_file_path($value,$row){
		if($value){
		$value='<a href="'.site_url('files/'.$row->xml_id.'/images').'/'.$value.'"><img src="'.site_url('files/'.$row->xml_id.'/images').'/'.$value.'" alt="image_tmb"></a>';
		}
		return ''; 
		}

	public function list_set_file_path($value,$row){
		if($value){
		$value='<a class="image-thumbnail" href="'.site_url('files/'.$row->xml_id.'/images').'/'.$value.'"><img src="'.site_url('files/'.$row->xml_id.'/images').'/'.$value.'" alt="image_tmb" style="width:50px"></a>';
		}
		return $value; 
		}
	
	
	
	public function get_row($table_name = null,$primary_key = null)
    {
    	$table_name = $table_name === null ? $this->t($this->TABLE_NAME) : $table_name;
    	$primary_key = $primary_key === null ? $this->PK_VALUE : $primary_key;

    	return $this->db->get_where($table_name, array('page_id' => $primary_key));
    }
    
	public function get_table($table_name = null)
    {
    	$table_name = $table_name === null ? $this->t($this->TABLE_NAME) : $table_name;
    	//$primary_key = $primary_key === null ? $this->PK_VALUE : $primary_key;

    	return $this->db->get($table_name);
    }
    
    public function delete_selection(){
        $crud = $this->make_crud();
        if(!$crud->unset_delete){
            $id_list = json_decode($this->input->post('data'));
  		
  		foreach($id_list as $page_id){
			$this->db->select('xml_id, file');
			$this->db->where('page_id', $page_id); 
			$query=$this->db->get($crud->basic_db_table);
			foreach ($query->result_array() as $row)
				{
				if($row['file']){
				$upload_path='modules/'.$this->cms_module_path().'/assets/uploads/deleted/'.$row['file']; 		
				$repo_path="files/".$row['xml_id']."/images/".$row['file'];
		
					if (is_file($repo_path)){
						if(!copy($repo_path, $upload_path)){
						return false;
						}
						else {
						unlink($repo_path);	
						//return true;
						}	
					//$rows[]=$row;
					}
				}
			}
		}         
            foreach($id_list as $id){
                if($this->_internal_before_delete($id)){
                    $this->db->delete($crud->basic_db_table,
                        array($this->PRIMARY_KEY=>$id));
                    $this->_internal_after_delete($id);
                }
            }
        }
    }
    
	public function get_edition_title(){
		//var_dump($_REQUEST);
		//var_dump($this->PRIMARY_KEY);
		$trigger=$this->input->post('trigger');
		$page=$this->input->post('page');
		if(strstr($page,"/success")){
			$page= strstr($page,"/success",TRUE);
		}
		//var_dump(strstr($page,"/success",TRUE));
		if($trigger=='title'){
			$pa=explode('/',parse_url($page, PHP_URL_PATH));
			$text_id=end($pa);//$this->uri->segment(3);
			if(is_numeric($text_id)){
				$query=$this->db->get_where($this->t('imbrex_text'), array('text_id' => $text_id));
				$sel_row = $query->row_array();
				$xml_id=$sel_row['xml_id'];
				$module_path = $this->cms_module_path();
				$this->load->model($module_path.'/imbrex_filedesc_model');
				$titles = $this->imbrex_filedesc_model->get_titles($xml_id);
				//var_dump($titles);
				if($titles){
					if(count($titles>0)){
						echo "<a class=\"btn btn-default\" href=\"".base_url().$module_path."/manage_imbrex_filedesc/index/edit/".$xml_id."\">Go back to this edition Step 1</a>&nbsp;&nbsp;";
						echo "<a class=\"btn btn-default\" href=\"".base_url().$module_path."/manage_imbrex_text/index/edit/".$text_id."\">Go back to this edition Step 2</a>";
						echo "<h2>".$titles[0]->titlestmt_title."</h2>";
						}
					}
				// 
				}
			
			}
	}


}
