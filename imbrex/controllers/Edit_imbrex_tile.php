<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of edit_imbrex_tile
 *
 * @author No-CMS Module Generator
 */

class Edit_imbrex_tile extends CMS_Secure_Controller {
	
	public $result=array();
	
	/*public function __construct ( ) {
		$module_path = $this->cms_module_path();
        $model=$this->load->model($module_path.'/imbrex_tile_model');
        $page = 0; 
        $keyword = '';
        
        $result = $this->imbrex_tile_model->get_data($keyword, $page);

		$this->result = $result;
		//var_dump($this->imbrex_tile_model);
	}*/
	
    protected function do_override_url_map($URL_MAP){
        $module_path = $this->cms_module_path();
        $navigation_name = $this->n('edit_imbrex_tile');
        $URL_MAP[$module_path.'/edit_imbrex_tile'] = $navigation_name;
        $URL_MAP[$module_path] = $navigation_name;
        $URL_MAP[$module_path.'/edit_imbrex_tile/get_data'] = $navigation_name;
        $URL_MAP[$module_path.'/get_data'] = $navigation_name;
        return $URL_MAP;
    }

    public function index(){	
        $module_path = $this->cms_module_path();
        $page_id=$this->input->get('page_id');
        $xml_id=$this->input->get('xml_id');
        
        $this->load->model($module_path.'/imbrex_tile_model');
        
        //$record_num = end();
        $result = $this->imbrex_tile_model->get_data($page_id);
        //var_dump($result);
        //echo $this->db->last_query();
        
        //$this->result=$result;
        $data = array(
			//'result'                 	=> $result,
			'page_id'                 	=> $page_id,
			'file'                 		=> $result->file,
			'xml_id'					=> $result->imbrex_filedesc_xml_id,
            'text_id'					=> $result->text_id,
            'allow_navigate_backend'    => $this->cms_allow_navigate($this->n('manage_imbrex_text_body_lg')),
            'have_add_privilege'        => $this->cms_have_privilege($this->n('add_imbrex_text_body_lg')),
            'have_edit_privilege'       => $this->cms_have_privilege($this->n('edit_imbrex_text_body_lg')),
            'have_delete_privilege'     => $this->cms_have_privilege($this->n('delete_imbrex_text_body_lg')),
            'backend_url'               => site_url($module_path.'/manage_imbrex_text_body_lg/index'),
            'module_path'               => $module_path,
            //'first_data'                => Modules::run($module_path.'/edit_imbrex_tile/get_data', 0, '')
        );
        $this->view($module_path.'/Edit_imbrex_tile_view',$data,
            $this->n('edit_imbrex_tile'));
    }

    public function get_data($page_id){
        $module_path = $this->cms_module_path();
        // get data from model
        $this->load->model($module_path.'/imbrex_tile_model');
        $result = $this->imbrex_tile_model->get_data($page_id);
        //echo $this->db->last_query();
        //
        var_dump($result);
        $data = array(
            'result'                 =>$result,
            'allow_navigate_backend' => $this->cms_allow_navigate($this->n('manage_imbrex_text_body_lg')),
            'have_add_privilege'     => $this->cms_have_privilege($this->n('add_imbrex_text_body_lg')),
            'have_edit_privilege'    => $this->cms_have_privilege($this->n('edit_imbrex_text_body_lg')),
            'have_delete_privilege'  => $this->cms_have_privilege($this->n('delete_imbrex_text_body_lg')),
            'backend_url'            => site_url($module_path.'/manage_imbrex_text_body_lg/index'),
        );
        $config = array('only_content'=>TRUE);
        $this->view($module_path.'/Edit_imbrex_tile_partial_view',$data,
           $this->n('edit_imbrex_tile'), $config);
    }
    
    // author: Grant Dickie

// Handles methods from coredata and xml_stream_import that will import data from XML into JSON

/*function html_template($data){
	// $content=preg_replace('/&amp;|&gt;|&lt;/','NO',$content);
	$html='<html><head><title>untitled</title></head><body><textarea>'.htmlspecialchars($data).'</textarea></body></html>';
	return $html;
	
}*/

 public function importDataScript(){
	$page_id=$this->input->get('page_id');
	$module_path = $this->cms_module_path();
	$this->load->model($module_path.'/imbrex_tile_model');

	$result = $this->imbrex_tile_model->get_data($page_id);
	//var_dump($result);
	//$res=json_encode($result);
	//echo "<hr>";//.$res."<hr>";
	$labels = $this->imbrex_tile_model->get_page_labels($page_id);
	$shapes = $this->imbrex_tile_model->get_text_shapes($page_id);
	$selections = $this->imbrex_tile_model->get_text_selections($page_id);

//var_dump($selections);

//echo "<hr>";

	$data['pages']=array();
	$page=array();
	$page['id']=$result->page_id;
	$page['url']=base_url()."files/".$result->imbrex_filedesc_xml_id."/images/".$result->file;
	$page['lines']=array();
	
		$values = preg_split("/\\r\\n|\\r|\\n/", $result->pagecontent);
		foreach($values as $k=>$v){	
			$page['lines'][$k]=array("text"=>$v,'id'=>'line'.$k);	
			$shaperef=$this->imbrex_tile_model->check_shape_reference($result->page_id,'line'.$k);
			if($shaperef) {
				$page['lines'][$k]['shapes']=$shaperef;
				
				}
			}
	$page['selections']=$selections;
	$page['shapes']=$shapes;
	
	$data['pages'][] = $page;
	$data['labels']=$labels;
	
	$data=json_encode($data);

	header('Content-type: text/javascript');
	echo $data;
	

}

 public function exportDataScript(){
	 $data=$this->input->post('values');
	 $data=json_decode($data,TRUE);
	 
	 $shapes= $data['pages'][0]['shapes'];
	 $selections= $data['pages'][0]['selections'];
	 $labels=$data['labels'];
	 
	 //var_dump($data['pages']);
	 //echo "<hr>";
     
     //Manage shapes
     //delete shapes in this page
	 $this->db->delete($this->t('imbrex_text_shapes'), array('page_id' => $data['pages'][0]['id'])); 
	foreach($shapes as $shape){
		if(isset($shape['labels'])){
			$shape['labels']=implode($shape['labels'],",");
		}
		
		if(isset($shape['lines'])){
			$shape['lines']=implode($shape['lines'],",");
		}
		$shape = array('page_id' => $data['pages'][0]['id']) + $shape;
		
		if(isset($shape['posInfo']['x'])){
			$shape['posinfo_x_cx']=$shape['posInfo']['x'];
		}
		elseif(isset($shape['posInfo']['cx'])){
			$shape['posinfo_x_cx']=$shape['posInfo']['cx'];
		}

		if(isset($shape['posInfo']['y'])){
			$shape['posinfo_y_cy']=$shape['posInfo']['y'];
		}
		elseif(isset($shape['posInfo']['cy'])){
			$shape['posinfo_y_cy']=$shape['posInfo']['cy'];
		}

		if(isset($shape['posInfo']['width'])){
			$shape['posinfo_width_rx']=$shape['posInfo']['width'];
		}
		elseif(isset($shape['posInfo']['rx'])){
			$shape['posinfo_width_rx']=$shape['posInfo']['rx'];
		}

		if(isset($shape['posInfo']['height'])){
			$shape['posinfo_height_ry']=$shape['posInfo']['height'];
		}
		elseif(isset($shape['posInfo']['ry'])){
			$shape['posinfo_height_ry']=$shape['posInfo']['ry'];
		}
		unset($shape['posInfo']);		
		//var_dump($shape);
		$this->db->insert( $this->t('imbrex_text_shapes'), $shape);
	}
	//Delete uneeded records
	$this->db->delete($this->t('imbrex_text_shapes'), array('id' => 'undefined')); 

	$where_line_labels_null ="page_id = ".$data['pages'][0]['id']." AND `labels` IS NULL AND  `lines` IS NULL "; 
	$this->db->where($where_line_labels_null)->delete($this->t('imbrex_text_shapes')); 

     //Manage selections
     //delete selections in this page
	 $this->db->delete($this->t('imbrex_text_selections'), array('page_id' => $data['pages'][0]['id'])); 
	 foreach($selections as $selection){
		if(isset($selection['labels'])){
			$selection['labels']=implode($selection['labels'],",");
			$selection = array('page_id' => $data['pages'][0]['id']) + $selection;
			$selection=array_change_key_case($selection, CASE_LOWER);

			//Insert in db only if selection has at least one label
			$this->db->insert( $this->t('imbrex_text_selections'), $selection);
		}
	 }
	
	//Delete unneeded
	$where ="page_id = ".$data['pages'][0]['id']." AND `startparent` =  `endparent` AND  `startoffset` >  `endoffset`"; 
	$this->db->where($where)->delete($this->t('imbrex_text_selections')); 

	
	 //Manage labels
	 //delete labels in this page
	 $this->db->delete($this->t('imbrex_page_labels'), array('page_id' => $data['pages'][0]['id'])); 
	 
	 //Get real shapes
	 $query_shapes = $this->db->select('id')->get($this->t('imbrex_text_shapes'));
	 $sha_id = $query_shapes->result_array();
	 
	 foreach($sha_id as $k=>$v){
		 $shap_id[]=$v['id'];
		 }
		 
	 //Get real selections
	 $query_selections = $this->db->select('id')->get($this->t('imbrex_text_selections'));
	 $sel_id = $query_selections->result_array();
	 
	 foreach($sel_id as $k=>$v){
		 $selec_id[]=$v['id'];
		 }
	
	 
	 foreach($labels as $label){
		//
		 if(isset($label['shapes'])){
			$shape_result = array_intersect($shap_id,$label['shapes']);
			$label['shapes']=implode($shape_result,",");
		}
		
		if(isset($label['selections'])){
			$select_result = array_intersect($selec_id,$label['selections']);
			$label['selections']=implode($select_result,",");
		}
		$label = array('page_id' => $data['pages'][0]['id']) + $label;
		 
		 //Insert labels
		 $this->db->insert( $this->t('imbrex_page_labels'), $label);
	}
	
	
	
	$where_no_label ="page_id = ".$data['pages'][0]['id']." AND (`selections` =  '' OR  `selections` IS NULL) AND (`shapes` =  '' OR  `shapes` IS NULL)";
	$this->db->where($where_no_label)->delete($this->t('imbrex_page_labels')); 
}

function isJSON(){
	//session_start();
	//var_dump($_SESSION);
	if(isset($_SESSION["json"])){
	
	
	$j=$_SESSION["json"];
	$j= stripslashes($j);
	$j=stripslashes($j);
	echo $j;
	} 
//end session
	//session_destroy();
}


public function get_series_labels(){
	$page_id=$this->input->get('page_id');
	
	$module_path = $this->cms_module_path();
	$this->load->model($module_path.'/imbrex_tile_model');

	$result = $this->imbrex_tile_model->get_data($page_id);
	
	$labels = $this->imbrex_tile_model->get_labels($result);
	$labels=json_encode($labels);
	echo $labels;
	}

}
