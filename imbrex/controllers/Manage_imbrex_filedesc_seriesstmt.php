<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Manage_imbrex_filedesc_seriesstmt
 *
 * @author No-CMS Module Generator
 */
class Manage_imbrex_filedesc_seriesstmt extends CMS_CRUD_Controller {

    protected $URL_MAP = array();
    protected $TABLE_NAME = 'imbrex_filedesc_seriesstmt';
    protected $COLUMN_NAMES = array('public', 'featured', 'idno', 'title', 'description', 'respstmt', 'logo', 'cover', 'labels');
    protected $PRIMARY_KEY = 'series_id';
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
        $crud->set_subject('Series');

        // displayed columns on list, edit, and add, uncomment to use
        $crud->columns('public', 'featured', 'title', 'logo');
        //$crud->edit_fields('public', 'featured', 'idno', 'title', 'description', 'respstmt', 'logo', 'cover', 'labels', '_updated_by', '_updated_at');
        //$crud->add_fields('public', 'featured', 'idno', 'title', 'description', 'respstmt', 'logo', 'cover', 'labels', '_created_by', '_created_at');
        //$crud->set_read_fields('public', 'featured', 'idno', 'title', 'description', 'respstmt', 'logo', 'cover', 'labels');

        // caption of each columns
        $crud->display_as('public','Public');
        $crud->display_as('featured','Featured');
        $crud->display_as('idno','Unique ID');
        $crud->display_as('title','Series Title');
        $crud->display_as('description','Description');
        $crud->display_as('respstmt','Responsibility');
        $crud->display_as('logo','Series Logo');
        $crud->display_as('cover','Series Cover');
        $crud->display_as('labels','Labels');
        
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
        $crud->field_type('public', 'true_false', array('N','Y'));
        $crud->field_type('featured', 'true_false', array('N','Y'));

        $crud->set_field_upload('logo', 'modules/'.$this->cms_module_path().'/assets/images/series');
        $crud->set_field_upload('cover', 'modules/'.$this->cms_module_path().'/assets/images/series');


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
        $this->view($this->cms_module_path().'/Manage_imbrex_filedesc_seriesstmt_view', $output,
            $this->n('manage_imbrex_filedesc_seriesstmt'), $config);
    }


    // returned on insert and edit
    public function _callback_field_idno($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array(
            'type' => array('ISBN','ISSN','DOI','URI'),
        );
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array();
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_filedesc_seriesstmt_idno', // DETAIL TABLE NAME
                'idno_id', // DETAIL PK NAME
                'series_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_seriesstmt_idno',$data, TRUE);
    }

    // returned on view
    public function _callback_column_idno($value, $row){
        return $this->_humanized_record_count(
                'imbrex_filedesc_seriesstmt_idno', // DETAIL TABLE NAME
                'series_id', // DETAIL FK NAME
                $row->series_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Unique Bibliographic ID for this Series',
                    'multiple_caption'  => 'Unique Bibliographic ID for this Seriess',
                    'zero_caption'      => 'No Unique Bibliographic ID for this Series',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_respstmt($value, $primary_key){
        // Options for detail table's column with SET type
        $set_column_option_list = array();
        // Options for detail table's column with ENUM type
        $enum_column_option_list = array(
            'type' => array('pers','org'),
        );
        // Detail table's one-to-many columns configurations
        $lookup_config_list = array();
        // Detail table's many-to-many columns configurations
        $many_to_many_config_list = array();
        // Prepare the data by using defined configurations and options
        $data = $this->_one_to_many_callback_field_data(
                'imbrex_filedesc_seriesstmt_respstmt', // DETAIL TABLE NAME
                'resp_id', // DETAIL PK NAME
                'series_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_seriesstmt_respstmt',$data, TRUE);
    }

    // returned on view
    public function _callback_column_respstmt($value, $row){
        return $this->_humanized_record_count(
                'imbrex_filedesc_seriesstmt_respstmt', // DETAIL TABLE NAME
                'series_id', // DETAIL FK NAME
                $row->series_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Responsibility',
                    'multiple_caption'  => 'Responsibilitys',
                    'zero_caption'      => 'No Responsibility',
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
                'imbrex_text_labels', // DETAIL TABLE NAME
                'label_id', // DETAIL PK NAME
                'series_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_seriesstmt_labels',$data, TRUE);
    }

    // returned on view
    public function _callback_column_labels($value, $row){
        return $this->_humanized_record_count(
                'imbrex_text_labels', // DETAIL TABLE NAME
                'series_id', // DETAIL FK NAME
                $row->series_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Labels',
                    'multiple_caption'  => 'Labelss',
                    'zero_caption'      => 'No Labels',
                )
            );
    }

    public function _after_insert_or_update($post_array, $primary_key){
        // SAVE CHANGES OF imbrex_filedesc_seriesstmt_idno
        $data = json_decode($this->input->post('md_real_field_idno_col'), TRUE);
        $this->_save_one_to_many(
            'idno', // FIELD NAME
            'imbrex_filedesc_seriesstmt_idno', // DETAIL TABLE NAME
            'idno_id', // DETAIL PK NAME
            'series_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('idno_id', 'type', 'idno'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_filedesc_seriesstmt_respstmt
        $data = json_decode($this->input->post('md_real_field_respstmt_col'), TRUE);
        $this->_save_one_to_many(
            'respstmt', // FIELD NAME
            'imbrex_filedesc_seriesstmt_respstmt', // DETAIL TABLE NAME
            'resp_id', // DETAIL PK NAME
            'series_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('resp_id', 'resp', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_text_labels
        $data = json_decode($this->input->post('md_real_field_labels_col'), TRUE);
        $this->_save_one_to_many(
            'labels', // FIELD NAME
            'imbrex_text_labels', // DETAIL TABLE NAME
            'label_id', // DETAIL PK NAME
            'series_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('label_id', 'id', 'name'), // REAL DETAIL COLUMN NAMES
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
        // delete corresponding imbrex_filedesc_seriesstmt_idno
        $this->db->delete($this->t('imbrex_filedesc_seriesstmt_idno'),
              array('series_id'=>$primary_key));
        // delete corresponding imbrex_filedesc_seriesstmt_respstmt
        $this->db->delete($this->t('imbrex_filedesc_seriesstmt_respstmt'),
              array('series_id'=>$primary_key));
        // delete corresponding imbrex_text_labels
        $this->db->delete($this->t('imbrex_text_labels'),
              array('series_id'=>$primary_key));
        return TRUE;
    }

    public function _after_delete($primary_key){
        return TRUE;
    }

}
