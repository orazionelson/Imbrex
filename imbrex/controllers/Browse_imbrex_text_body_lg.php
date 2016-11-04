<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Browse_imbrex_text_body_lg
 *
 * @author No-CMS Module Generator
 */

class Browse_imbrex_text_body_lg extends CMS_Secure_Controller {

    protected function do_override_url_map($URL_MAP){
        $module_path = $this->cms_module_path();
        $navigation_name = $this->n('browse_imbrex_text_body_lg');
        $URL_MAP[$module_path.'/browse_imbrex_text_body_lg'] = $navigation_name;
        $URL_MAP[$module_path] = $navigation_name;
        $URL_MAP[$module_path.'/browse_imbrex_text_body_lg/get_data'] = $navigation_name;
        $URL_MAP[$module_path.'/get_data'] = $navigation_name;
        return $URL_MAP;
    }

    public function index(){
        $module_path = $this->cms_module_path();
        if(!$this->input->get('text_id')){
        redirect('imbrex/browse_imbrex_filedesc_seriesstmt');
		}
		else {
		$text_id=$this->input->get('text_id');}
		
		
		$this->load->model($module_path.'/imbrex_text_body_lg_model');
        $result = $this->imbrex_text_body_lg_model->get_pages($text_id);
		
		$xml_id=$result[0]->xml_id;
		$this->load->model($module_path.'/imbrex_filedesc_model');
		$titles = $this->imbrex_filedesc_model->get_titles($xml_id);
		
		$first_page_id=$result[0]->page_id;
		$file = $result[0]->file;
		//$first_page_data=$this->get_first_page($text_id,$first_page_id);
        $data = array(
			'result'					=> $result,
			'text_id'					=> $text_id,
			'page_id'					=> $first_page_id,
			'file'						=> $file,
			'titles'					=> $titles,
            //'allow_navigate_backend'    => $this->cms_allow_navigate($this->n('manage_imbrex_text_body_lg')),
            //'have_add_privilege'        => $this->cms_have_privilege($this->n('add_imbrex_text_body_lg')),
            //'have_edit_privilege'       => $this->cms_have_privilege($this->n('edit_imbrex_text_body_lg')),
            //'have_delete_privilege'     => $this->cms_have_privilege($this->n('delete_imbrex_text_body_lg')),
            //'backend_url'               => site_url($module_path.'/manage_imbrex_text_body_lg/index'),
            'module_path'               => $module_path,
            //'first_data'                => Modules::run($module_path.'/browse_imbrex_text_body_lg/get_data', 0, ''),
            //'first_page_data'      => Modules::run($module_path.'/browse_imbrex_text_body_lg/get_first_page',$text_id,$first_page_id)
            //'first_page_data'	=> $first_page_data
        );
        
        $this->view($module_path.'/Browse_imbrex_text_body_lg_view',$data,
            $this->n('browse_imbrex_text_body_lg'));
    }
    
    public function get_page($text_id=NULL,$page_id=NULL){
		$module_path = $this->cms_module_path();
		$get_text_id   = $this->input->get('text_id');
        $get_page_id   = $this->input->get('page_id');
        if($text_id == NULL && $get_text_id != NULL) $text_id = $get_text_id;
        if($page_id == NULL && $get_page_id != NULL) $page_id = $get_page_id;
        
		$this->load->model($module_path.'/imbrex_text_body_lg_model');
        $result = $this->imbrex_text_body_lg_model->get_page($text_id,$page_id);
        //var_dump($result);
        $data = array(
            'result'                 =>$result,
           );
        $config = array('only_content'=>FALSE);   
        
        $this->view($module_path.'/Browse_imbrex_text_body_lg_partial_view',$data, $this->n('browse_imbrex_text_body_lg'), $config);  
           //var_dump($result); 
        //return $result;
	}

	public function get_first_page($text_id,$page_id){
		$module_path = $this->cms_module_path();
        
		$this->load->model($module_path.'/imbrex_text_body_lg_model');
        $result = $this->imbrex_text_body_lg_model->get_page($text_id,$page_id);
        $data = array(
            'result'                 =>$result,
           );
           
       $config = array('only_content'=>TRUE);
       //$this->view($module_path.'/Browse_imbrex_text_body_lg_partial_view',$data,
       //$this->n('browse_imbrex_text_body_lg'), $config);   
        return $result;
	}

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

    public function get_data($page = 0, $keyword = ''){
        $module_path = $this->cms_module_path();
        // get page and keyword parameter
        /*$post_keyword   = $this->input->post('keyword');
        $post_page      = $this->input->post('page');
        if($keyword == '' && $post_keyword != NULL) $keyword = $post_keyword;
        if($page == 0 && $post_page != NULL) $page = $post_page;
        // get data from model
        $this->load->model($module_path.'/imbrex_text_body_lg_model');
        $result = $this->imbrex_text_body_lg_model->get_data($keyword, $page);
        $data = array(
            'result'                 =>$result,
            'allow_navigate_backend' => $this->cms_allow_navigate($this->n('manage_imbrex_text_body_lg')),
            'have_add_privilege'     => $this->cms_have_privilege($this->n('add_imbrex_text_body_lg')),
            'have_edit_privilege'    => $this->cms_have_privilege($this->n('edit_imbrex_text_body_lg')),
            'have_delete_privilege'  => $this->cms_have_privilege($this->n('delete_imbrex_text_body_lg')),
            'backend_url'            => site_url($module_path.'/manage_imbrex_text_body_lg/index'),
        );
        $config = array('only_content'=>TRUE);
        $this->view($module_path.'/Browse_imbrex_text_body_lg_partial_view',$data,
           $this->n('browse_imbrex_text_body_lg'), $config);*/
    }

}
