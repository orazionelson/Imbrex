<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Manage_imbrex_text
 *
 * @author No-CMS Module Generator
 */
class Manage_imbrex_text extends CMS_CRUD_Controller {

    protected $URL_MAP = array();
    protected $TABLE_NAME = 'imbrex_text';
    protected $COLUMN_NAMES = array('xml_id', 'text_type', 'text_lang', 'body_note', 'linebreak', 'page_id');
    protected $PRIMARY_KEY = 'text_id';
    protected $UNSET_JQUERY = TRUE;
    protected $UNSET_READ = TRUE;
    protected $UNSET_ADD = FALSE;
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
        $crud->set_subject('Text');

        // displayed columns on list, edit, and add, uncomment to use
		$crud->columns('xml_id', 'text_type', 'text_lang', 'linebreak', 'page_id');
        //$crud->edit_fields('xml_id','text_type', 'text_lang', 'body_note', 'linebreak', 'page_id', '_updated_by', '_updated_at');
        //$crud->add_fields('xml_id', 'text_type', 'text_lang', 'body_note', 'linebreak', 'page_id', '_created_by', '_created_at');
        //$crud->set_read_fields('xml_id', 'text_type', 'text_lang', 'body_note', 'linebreak', 'page_id');
        
        // caption of each columns
        $crud->display_as('xml_id','Edition XML Id');
        $crud->display_as('text_type','Text type Attrib');
        $crud->display_as('text_lang','Language ');
        $crud->display_as('body_note','Text Notes');
        $crud->display_as('linebreak','Mantain line breaks');
		$crud->display_as('page_id','Pages');
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
        $crud->set_relation('text_lang', $this->t('imbrex_languages'), 'language');

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
        $crud->field_type('linebreak', 'true_false', array('N','Y'));

		
        ////////////////////////////////////////////////////////////////////////
        // HINT: Put Tabs (if needed)
        // usage:
        //     $crud->set_outside_tab($how_many_field_outside_tab);
        //     $crud->set_tabs(array(
        //        'First Tab Caption'  => $how_many_field_on_first_tab,
        //        'Second Tab Caption' => $how_many_field_on_second_tab,
        //     ));
        ////////////////////////////////////////////////////////////////////////

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


        ////////////////////////////////////////////////////////////////////////
        // HINT: Put custom error message here
        // (documentation: httm://www.grocerycrud.com/documentation/set_lang_string)
        ////////////////////////////////////////////////////////////////////////
        // $crud->set_lang_string('delete_error_message', 'Cannot delete the record');
        // $crud->set_lang_string('update_error',         'Cannot edit the record'  );
        // $crud->set_lang_string('insert_error',         'Cannot add the record'   );

        $this->CRUD = $crud;
        return $crud;
    }

    public function index(){
        // create crud
        $crud = $this->make_crud();

        // render
        $render = $this->render_crud($crud);
        $output = $render['output'];
        $config = $render['config'];

        // show the view
        $this->view($this->cms_module_path().'/Manage_imbrex_text_view', $output,
            $this->n('manage_imbrex_text'), $config);
    }
	
	//public function _callback_field_xml_id($value, $primary_key){}

// returned on insert and edit
    public function _callback_field_page_id($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array();
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array(
            'xml_id' => array(
                'selection_table'         => 'imbrex_filedesc',
                'selection_pk_column'     => 'ed_id',
                'selection_lookup_column' => 'xml_id',
            ),
        );
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_text_body_lg', // DETAIL TABLE NAME
                'page_id', // DETAIL PK NAME
                'text_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        $data['primary_key'] = $primary_key;
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_text_page_id',$data, TRUE);
    }

    // returned on view
    public function _callback_column_page_id($value, $row){
        return $this->_humanized_record_count(
                'imbrex_text_body_lg', // DETAIL TABLE NAME
                'text_id', // DETAIL FK NAME
                $row->text_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Page',
                    'multiple_caption'  => 'Pages',
                    'zero_caption'      => 'No Page',
                )
            );
    }


    public function _after_insert_or_update($post_array, $primary_key){
        // SAVE CHANGES OF imbrex_text_body_lg
		$values = $this->input->post('md_real_field_page_id_col');
		
        $data = json_decode($values, TRUE);
        
        $this->_save_one_to_many(
            'page_id', // FIELD NAME
            'imbrex_text_body_lg', // DETAIL TABLE NAME
            'page_id', // DETAIL PK NAME
            'text_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('page_id', 'xml_id', 'pagenum', 'linebreaks', 'closed'), //'file', REAL DETAIL COLUMN NAMES
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
        return TRUE;
    }

    public function _before_update($post_array, $primary_key){
        return $post_array;
    }

    public function _after_update($post_array, $primary_key){
        return TRUE;
    }

   public function _before_delete($primary_key){
			$this->db->select('page_id');
			$query = $this->db->get_where($this->t('imbrex_text_body_lg'), array('text_id' => $primary_key));
			$res = $query->result_array();
			foreach($res as $k=>$v){
				// delete corresponding imbrex_text_shapes
				$this->db->delete($this->t('imbrex_text_shapes'),
				array('page_id'=>$v['page_id']));
				// delete corresponding imbrex_text_selections
				$this->db->delete($this->t('imbrex_text_selections'),
				array('page_id'=>$v['page_id']));
				// delete corresponding imbrex_page_labels
				$this->db->delete($this->t('imbrex_page_labels'),
				array('page_id'=>$v['page_id']));
				}
        // delete corresponding imbrex_text_body_lg
        $this->db->delete($this->t('imbrex_text_body_lg'),
              array('text_id'=>$primary_key));
        return TRUE;
    }

    public function _after_delete($primary_key){
        return TRUE;
    }
   
   public function get_last_ed_id(){
			
	   		$this->db->select_max('ed_id');
			$query = $this->db->get($this->t('imbrex_filedesc'));
			$res = $query->result();
			//var_dump($res);
			echo $res[0]->ed_id;
	   } 
	   
		public function get_edition_title(){
				$xml_id=$this->input->get('xml_id');
				$module_path = $this->cms_module_path();
				$this->load->model($module_path.'/imbrex_filedesc_model');
				$titles = $this->imbrex_filedesc_model->get_titles($xml_id);
				
				//var_dump($titles);
				if($titles){
				echo $titles[0]->titlestmt_title;
				}
				else echo '';
			}
	

}
