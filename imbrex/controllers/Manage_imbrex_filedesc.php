<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Manage_imbrex_filedesc
 *
 * @author No-CMS Module Generator
 */
class Manage_imbrex_filedesc extends CMS_CRUD_Controller {

    protected $URL_MAP = array();
    protected $TABLE_NAME = 'imbrex_filedesc';
    protected $COLUMN_NAMES = array('xml_id', 'public', 'featured', 'seriesstmt', 'titlestmt_title', 'titlestmt_author', 'titlestmt_editor', 'titlestmt_respstmt', 'publicationstmt_publisher', 'publicationstmt_pubplace', 'publicationstmt_date', 'publicationstmt_authority', 'publicationstmt_availability', 'sourcedesc_biblstruct_analytic_title', 'sourcedesc_biblstruct_analytic_author', 'sourcedesc_biblstruct_analytic_editor', 'sourcedesc_biblstruct_monogr_title', 'sourcedesc_biblstruct_monogr_imprint_pubplace', 'sourcedesc_biblstruct_monogr_imprint_publisher', 'sourcedesc_biblstruct_monogr_imprint_date', 'sourcedesc_biblstruct_monogr_imprint_biblscope_vol', 'sourcedesc_biblstruct_monogr_imprint_biblscope_pp', 'sourcedesc_biblstruct_monogr_extent', 'sourcedesc_biblstruct_idno');
    protected $PRIMARY_KEY = 'ed_id';
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
        $crud->set_subject('Edition');

        // displayed columns on list, edit, and add, uncomment to use
        $crud->columns('xml_id', 'public', 'featured', 'titlestmt_title');//,'seriesstmt',  'titlestmt_author', 'titlestmt_editor', 'titlestmt_respstmt', 'publicationstmt_publisher', 'publicationstmt_pubplace', 'publicationstmt_date', 'publicationstmt_authority', 'publicationstmt_availability', 'sourcedesc_biblstruct_analytic_title', 'sourcedesc_biblstruct_analytic_author', 'sourcedesc_biblstruct_analytic_editor', 'sourcedesc_biblstruct_monogr_title', 'sourcedesc_biblstruct_monogr_imprint_pubplace', 'sourcedesc_biblstruct_monogr_imprint_publisher', 'sourcedesc_biblstruct_monogr_imprint_date', 'sourcedesc_biblstruct_monogr_imprint_biblscope_vol', 'sourcedesc_biblstruct_monogr_imprint_biblscope_pp', 'sourcedesc_biblstruct_monogr_extent', 'sourcedesc_biblstruct_idno');
        //$crud->edit_fields('xml_id', 'public', 'featured', 'seriesstmt', 'titlestmt_title', 'titlestmt_author', 'titlestmt_editor', 'titlestmt_respstmt', 'publicationstmt_publisher', 'publicationstmt_pubplace', 'publicationstmt_date', 'publicationstmt_authority', 'publicationstmt_availability', 'sourcedesc_biblstruct_analytic_title', 'sourcedesc_biblstruct_analytic_author', 'sourcedesc_biblstruct_analytic_editor', 'sourcedesc_biblstruct_monogr_title', 'sourcedesc_biblstruct_monogr_imprint_pubplace', 'sourcedesc_biblstruct_monogr_imprint_publisher', 'sourcedesc_biblstruct_monogr_imprint_date', 'sourcedesc_biblstruct_monogr_imprint_biblscope_vol', 'sourcedesc_biblstruct_monogr_imprint_biblscope_pp', 'sourcedesc_biblstruct_monogr_extent', 'sourcedesc_biblstruct_idno', '_updated_by', '_updated_at');
        //$crud->add_fields('xml_id', 'public', 'featured', 'seriesstmt', 'titlestmt_title', 'titlestmt_author', 'titlestmt_editor', 'titlestmt_respstmt', 'publicationstmt_publisher', 'publicationstmt_pubplace', 'publicationstmt_date', 'publicationstmt_authority', 'publicationstmt_availability', 'sourcedesc_biblstruct_analytic_title', 'sourcedesc_biblstruct_analytic_author', 'sourcedesc_biblstruct_analytic_editor', 'sourcedesc_biblstruct_monogr_title', 'sourcedesc_biblstruct_monogr_imprint_pubplace', 'sourcedesc_biblstruct_monogr_imprint_publisher', 'sourcedesc_biblstruct_monogr_imprint_date', 'sourcedesc_biblstruct_monogr_imprint_biblscope_vol', 'sourcedesc_biblstruct_monogr_imprint_biblscope_pp', 'sourcedesc_biblstruct_monogr_extent', 'sourcedesc_biblstruct_idno', '_created_by', '_created_at');
        //$crud->set_read_fields('xml_id', 'public', 'featured', 'seriesstmt', 'titlestmt_title', 'titlestmt_author', 'titlestmt_editor', 'titlestmt_respstmt', 'publicationstmt_publisher', 'publicationstmt_pubplace', 'publicationstmt_date', 'publicationstmt_authority', 'publicationstmt_availability', 'sourcedesc_biblstruct_analytic_title', 'sourcedesc_biblstruct_analytic_author', 'sourcedesc_biblstruct_analytic_editor', 'sourcedesc_biblstruct_monogr_title', 'sourcedesc_biblstruct_monogr_imprint_pubplace', 'sourcedesc_biblstruct_monogr_imprint_publisher', 'sourcedesc_biblstruct_monogr_imprint_date', 'sourcedesc_biblstruct_monogr_imprint_biblscope_vol', 'sourcedesc_biblstruct_monogr_imprint_biblscope_pp', 'sourcedesc_biblstruct_monogr_extent', 'sourcedesc_biblstruct_idno');

        // caption of each columns
        $crud->display_as('xml_id','xml:Id');
        $crud->display_as('public','Public');
        $crud->display_as('featured','Featured');
        $crud->display_as('seriesstmt','Series');
        $crud->display_as('titlestmt_title','Title');
        $crud->display_as('titlestmt_author','Author');
        $crud->display_as('titlestmt_editor','Editor');
        $crud->display_as('titlestmt_respstmt','Responsibility (Other than author and editor)');
        $crud->display_as('publicationstmt_publisher','Publisher');
        $crud->display_as('publicationstmt_pubplace','Publication Place');
        $crud->display_as('publicationstmt_date','Date');
        $crud->display_as('publicationstmt_authority','Authority');
        $crud->display_as('publicationstmt_availability','Availability');
        $crud->display_as('sourcedesc_biblstruct_analytic_title','Title');
        $crud->display_as('sourcedesc_biblstruct_analytic_author','Author');
        $crud->display_as('sourcedesc_biblstruct_analytic_editor','Editor');
        $crud->display_as('sourcedesc_biblstruct_monogr_title','Title');
        $crud->display_as('sourcedesc_biblstruct_monogr_imprint_pubplace','Publication Place');
        $crud->display_as('sourcedesc_biblstruct_monogr_imprint_publisher','Publisher');
        $crud->display_as('sourcedesc_biblstruct_monogr_imprint_date','Publishing Date');
        $crud->display_as('sourcedesc_biblstruct_monogr_imprint_biblscope_vol','Volume nb');
        $crud->display_as('sourcedesc_biblstruct_monogr_imprint_biblscope_pp','Volume pp');
        $crud->display_as('sourcedesc_biblstruct_monogr_extent','Extent');
        $crud->display_as('sourcedesc_biblstruct_idno','Unique ID');

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
        $crud->required_fields('xml_id','seriesstmt', 'titlestmt_title');

        ////////////////////////////////////////////////////////////////////////
        // HINT: Put required field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/unique_fields)
        // eg:
        //      $crud->unique_fields( $field1, $field2, $field3, ... );
        ////////////////////////////////////////////////////////////////////////
        $crud->unique_fields('xml_id');

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
        $crud->set_relation('seriesstmt', $this->t('imbrex_filedesc_seriesstmt'), 'title');

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
                'Title Statement'  => 4,
                'Publication Statement' => 5,
                'Source Analytic'=>3,
                'Source Monographic'=>7,
                'Source Extra'=>1
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


        ////////////////////////////////////////////////////////////////////////
        // HINT: Put custom error message here
        // (documentation: httm://www.grocerycrud.com/documentation/set_lang_string)
        ////////////////////////////////////////////////////////////////////////
        // $crud->set_lang_string('delete_error_message', 'Cannot delete the record');
        // $crud->set_lang_string('update_error',         'Cannot edit the record'  );
        // $crud->set_lang_string('insert_error',         'Cannot add the record'   );

		$crud->set_lang_string('alert_delete', 'This action will delete all pages and tiled pages related to this edition. Are you sure that you want to delete this record?');

		$crud->add_action('Edit Step2', 'glyphicon glyphicon-pencil','','edit_step2 btn btn-info',array($this,'edit_step2'));

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
        $this->view($this->cms_module_path().'/Manage_imbrex_filedesc_view', $output,
            $this->n('manage_imbrex_filedesc'), $config);
    }


    // returned on insert and edit
    public function _callback_field_titlestmt_author($value, $primary_key){
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
                'imbrex_titlestmt_author', // DETAIL TABLE NAME
                'author_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_titlestmt_author',$data, TRUE);
    }

    // returned on view
    public function _callback_column_titlestmt_author($value, $row){
        return $this->_humanized_record_count(
                'imbrex_titlestmt_author', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Author',
                    'multiple_caption'  => 'Authors',
                    'zero_caption'      => 'No Author',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_titlestmt_editor($value, $primary_key){
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
                'imbrex_titlestmt_editor', // DETAIL TABLE NAME
                'editor_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_titlestmt_editor',$data, TRUE);
    }

    // returned on view
    public function _callback_column_titlestmt_editor($value, $row){
        return $this->_humanized_record_count(
                'imbrex_titlestmt_editor', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Editor',
                    'multiple_caption'  => 'Editors',
                    'zero_caption'      => 'No Editor',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_titlestmt_respstmt($value, $primary_key){
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
                'imbrex_titlestmt_respstmt', // DETAIL TABLE NAME
                'resp_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_titlestmt_respstmt',$data, TRUE);
    }

    // returned on view
    public function _callback_column_titlestmt_respstmt($value, $row){
        return $this->_humanized_record_count(
                'imbrex_titlestmt_respstmt', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Responsibility (Other than author and editor)',
                    'multiple_caption'  => 'Responsibility (Other than author and editor)s',
                    'zero_caption'      => 'No Responsibility (Other than author and editor)',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_publicationstmt_publisher($value, $primary_key){
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
                'imbrex_publicationstmt_publisher', // DETAIL TABLE NAME
                'publisher_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_publicationstmt_publisher',$data, TRUE);
    }

    // returned on view
    public function _callback_column_publicationstmt_publisher($value, $row){
        return $this->_humanized_record_count(
                'imbrex_publicationstmt_publisher', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Publisher',
                    'multiple_caption'  => 'Publishers',
                    'zero_caption'      => 'No Publisher',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_sourcedesc_biblstruct_analytic_author($value, $primary_key){
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
                'imbrex_analytic_author', // DETAIL TABLE NAME
                'author_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_sourcedesc_biblstruct_analytic_author',$data, TRUE);
    }

    // returned on view
    public function _callback_column_sourcedesc_biblstruct_analytic_author($value, $row){
        return $this->_humanized_record_count(
                'imbrex_analytic_author', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Author',
                    'multiple_caption'  => 'Authors',
                    'zero_caption'      => 'No Author',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_sourcedesc_biblstruct_analytic_editor($value, $primary_key){
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
                'imbrex_analytic_editor', // DETAIL TABLE NAME
                'editor_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_sourcedesc_biblstruct_analytic_editor',$data, TRUE);
    }

    // returned on view
    public function _callback_column_sourcedesc_biblstruct_analytic_editor($value, $row){
        return $this->_humanized_record_count(
                'imbrex_analytic_editor', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Editor',
                    'multiple_caption'  => 'Editors',
                    'zero_caption'      => 'No Editor',
                )
            );
    }


    // returned on insert and edit
    public function _callback_field_sourcedesc_biblstruct_idno($value, $primary_key){
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
                'imbrex_biblstruct_idno', // DETAIL TABLE NAME
                'idno_id', // DETAIL PK NAME
                'ed_id', // DETAIL FK NAME
                $primary_key, // CURRENT TABLE PK VALUE
                $lookup_config_list, // LOOKUP CONFIGS
                $many_to_many_config_list, // MANY TO MANY CONFIGS
                $set_column_option_list, // SET OPTIONS
                $enum_column_option_list // ENUM OPTIONS
            );
        // Parse the data to the view
        return $this->load->view($this->cms_module_path().'/field_imbrex_filedesc_sourcedesc_biblstruct_idno',$data, TRUE);
    }

    // returned on view
    public function _callback_column_sourcedesc_biblstruct_idno($value, $row){
        return $this->_humanized_record_count(
                'imbrex_biblstruct_idno', // DETAIL TABLE NAME
                'ed_id', // DETAIL FK NAME
                $row->ed_id, // CURRENT TABLE PK VALUE
                array( // CAPTIONS
                    'single_caption'    => 'Unique Bibliographic ID',
                    'multiple_caption'  => 'Unique Bibliographic IDs',
                    'zero_caption'      => 'No Unique Bibliographic ID',
                )
            );
    }


    public function _after_insert_or_update($post_array, $primary_key){
        // SAVE CHANGES OF imbrex_titlestmt_author
        $data = json_decode($this->input->post('md_real_field_titlestmt_author_col'), TRUE);
        $this->_save_one_to_many(
            'titlestmt_author', // FIELD NAME
            'imbrex_titlestmt_author', // DETAIL TABLE NAME
            'author_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('author_id', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_titlestmt_editor
        $data = json_decode($this->input->post('md_real_field_titlestmt_editor_col'), TRUE);
        $this->_save_one_to_many(
            'titlestmt_editor', // FIELD NAME
            'imbrex_titlestmt_editor', // DETAIL TABLE NAME
            'editor_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('editor_id', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_titlestmt_respstmt
        $data = json_decode($this->input->post('md_real_field_titlestmt_respstmt_col'), TRUE);
        $this->_save_one_to_many(
            'titlestmt_respstmt', // FIELD NAME
            'imbrex_titlestmt_respstmt', // DETAIL TABLE NAME
            'resp_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('resp_id', 'resp', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_publicationstmt_publisher
        $data = json_decode($this->input->post('md_real_field_publicationstmt_publisher_col'), TRUE);
        $this->_save_one_to_many(
            'publicationstmt_publisher', // FIELD NAME
            'imbrex_publicationstmt_publisher', // DETAIL TABLE NAME
            'publisher_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('publisher_id', 'publisher', 'address', 'target'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_analytic_author
        $data = json_decode($this->input->post('md_real_field_sourcedesc_biblstruct_analytic_author_col'), TRUE);
        $this->_save_one_to_many(
            'sourcedesc_biblstruct_analytic_author', // FIELD NAME
            'imbrex_analytic_author', // DETAIL TABLE NAME
            'author_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('author_id', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_analytic_editor
        $data = json_decode($this->input->post('md_real_field_sourcedesc_biblstruct_analytic_editor_col'), TRUE);
        $this->_save_one_to_many(
            'sourcedesc_biblstruct_analytic_editor', // FIELD NAME
            'imbrex_analytic_editor', // DETAIL TABLE NAME
            'editor_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('editor_id', 'type', 'name', 'key'), // REAL DETAIL COLUMN NAMES
            array(), // SET DETAIL COLUMN NAMES
            $many_to_many_config_list=array()
        );

        // SAVE CHANGES OF imbrex_biblstruct_idno
        $data = json_decode($this->input->post('md_real_field_sourcedesc_biblstruct_idno_col'), TRUE);
        $this->_save_one_to_many(
            'sourcedesc_biblstruct_idno', // FIELD NAME
            'imbrex_biblstruct_idno', // DETAIL TABLE NAME
            'idno_id', // DETAIL PK NAME
            'ed_id', // DETAIL FK NAME
            $primary_key, // PARENT PRIMARY KEY VALUE
            $data, // DATA
            array('idno_id', 'type', 'idno'), // REAL DETAIL COLUMN NAMES
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
		$dir="files/".$primary_key;
		$images_dir=$dir."/images/";
		if (!is_dir($dir)) {
		mkdir($dir, 0777);
		}		
		if (!is_dir($images_dir)) {
		mkdir($images_dir, 0777);
		}
        return TRUE;
    }

    public function _before_update($post_array, $primary_key){
        return $post_array;
    }

    public function _after_update($post_array, $primary_key){
        return TRUE;
    }

    public function _before_delete($primary_key){
        // delete corresponding imbrex_titlestmt_author
        $this->db->delete($this->t('imbrex_titlestmt_author'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_titlestmt_editor
        $this->db->delete($this->t('imbrex_titlestmt_editor'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_titlestmt_respstmt
        $this->db->delete($this->t('imbrex_titlestmt_respstmt'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_publicationstmt_publisher
        $this->db->delete($this->t('imbrex_publicationstmt_publisher'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_analytic_author
        $this->db->delete($this->t('imbrex_analytic_author'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_analytic_editor
        $this->db->delete($this->t('imbrex_analytic_editor'),
              array('ed_id'=>$primary_key));
        // delete corresponding imbrex_biblstruct_idno
        $this->db->delete($this->t('imbrex_biblstruct_idno'),
              array('ed_id'=>$primary_key));
        
              
        //delete also labels, shapes and selections
        $this->db->select('page_id');
		$query = $this->db->get_where($this->t('imbrex_text_body_lg'), array('xml_id' => $primary_key));
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
		
		//delete step 2...
        $this->db->delete($this->t('imbrex_text'),
              array('xml_id'=>$primary_key));
        //...and all the pages related with this edition      
        $this->db->delete($this->t('imbrex_text_body_lg'),
              array('xml_id'=>$primary_key));
             
        return TRUE;
    }

    public function _after_delete($primary_key){
        return TRUE;
    }
    
    public function delete_edition($primary_key){
		
		}
		
	public function edit_step2($primary_key , $row){
		$module_path = $this->cms_module_path();
		$this->load->model($module_path.'/imbrex_filedesc_model');
		
		//$xml_id=$this->input->get('xml_id');
		
		$step2 = $this->imbrex_filedesc_model->get_text($primary_key);
		if($step2){
		return site_url($this->cms_module_path().'/manage_imbrex_text/index/edit').'/'.$step2->text_id;
			}
		else return 'false';
		}	
    
    public function go_to_step2(){
		$module_path = $this->cms_module_path();
		$this->load->model($module_path.'/imbrex_filedesc_model');
		
		$xml_id=$this->input->get('xml_id');

		//$xml_id_value=$this->input->get('xml_id_value');
		$step2 = $this->imbrex_filedesc_model->get_text($xml_id);
		
		
		if($step2){
			$text_id=$step2->text_id;
			echo 'edit/'.$text_id;
			}
		else {
			echo "add?xml_id=".$xml_id;				
		}	
	}

}
