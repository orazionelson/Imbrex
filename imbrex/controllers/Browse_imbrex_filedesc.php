<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Browse_imbrex_filedesc
 *
 * @author No-CMS Module Generator
 */

class Browse_imbrex_filedesc extends CMS_Secure_Controller {

    protected function do_override_url_map($URL_MAP){
        $module_path = $this->cms_module_path();
        $navigation_name = $this->n('browse_imbrex_filedesc');
        $URL_MAP[$module_path.'/browse_imbrex_filedesc'] = $navigation_name;
        $URL_MAP[$module_path] = $navigation_name;
        $URL_MAP[$module_path.'/browse_imbrex_filedesc/get_data'] = $navigation_name;
        $URL_MAP[$module_path.'/get_data'] = $navigation_name;
        return $URL_MAP;
    }

    public function index(){
        $module_path = $this->cms_module_path();
        $series_id      = $this->input->get('series_id');
        if($series_id){
			// get data from model
			$this->load->model($module_path.'/imbrex_filedesc_seriesstmt_model');
			$sresult = $this->imbrex_filedesc_seriesstmt_model->get_data('', 0,$series_id);
		}
		else {$sresult=NULL;}
		
        //var_dump($series_id);
        $data = array(
            'allow_navigate_backend'    => $this->cms_allow_navigate($this->n('manage_imbrex_filedesc')),
            'have_add_privilege'        => $this->cms_have_privilege($this->n('add_imbrex_filedesc')),
            'have_edit_privilege'       => $this->cms_have_privilege($this->n('edit_imbrex_filedesc')),
            'have_delete_privilege'     => $this->cms_have_privilege($this->n('delete_imbrex_filedesc')),
            'backend_url'               => site_url($module_path.'/manage_imbrex_filedesc/index'),
            'module_path'               => $module_path,
            'sresult'					=> $sresult,
            'first_data'                => Modules::run($module_path.'/browse_imbrex_filedesc/get_data', 0, '')
        );
        $this->view($module_path.'/Browse_imbrex_filedesc_view',$data,
            $this->n('browse_imbrex_filedesc'));
    }

    public function get_data($page = 0, $keyword = ''){
        $module_path = $this->cms_module_path();
        // get page and keyword parameter
        $post_keyword   = $this->input->post('keyword');
        $post_page      = $this->input->post('page');
        $series_id      = $this->input->get('series_id');
        if($keyword == '' && $post_keyword != NULL) $keyword = $post_keyword;
        if($page == 0 && $post_page != NULL) $page = $post_page;
        // get data from model
        $this->load->model($module_path.'/imbrex_filedesc_model');
        $result = $this->imbrex_filedesc_model->get_data($keyword, $page,$series_id);
        
        /*foreach($result as $record){
			$text=$this->get_text($record->ed_id);
			if($text){//var_dump($text); echo "<hr>";
				if(count($text)>0){
					$first_page=$this->get_first_page($text->text_id);//var_dump($text->text_id);
					$record->first_page=$first_page;
					
					}
				else {$record->first_page='';}	
				}
			//echo count($record)."<hr>";
			if(count($record)>0){
			$nresult[]=$record;
				}	
			}*/
        
        //var_dump($result);
        $data = array(
            'result'                 => $result,
            'series_id'				 => $series_id,
            'allow_navigate_backend' => $this->cms_allow_navigate($this->n('manage_imbrex_filedesc')),
            'have_add_privilege'     => $this->cms_have_privilege($this->n('add_imbrex_filedesc')),
            'have_edit_privilege'    => $this->cms_have_privilege($this->n('edit_imbrex_filedesc')),
            'have_delete_privilege'  => $this->cms_have_privilege($this->n('delete_imbrex_filedesc')),
            'backend_url'            => site_url($module_path.'/manage_imbrex_filedesc/index'),
        );
        $config = array('only_content'=>TRUE);
        $this->view($module_path.'/Browse_imbrex_filedesc_partial_view',$data,
           $this->n('browse_imbrex_filedesc'), $config);
    }
    
    public function get_text($id){
		$module_path = $this->cms_module_path();
		$this->load->model($module_path.'/imbrex_filedesc_model');
        $result = $this->imbrex_filedesc_model->get_text($id);
        //var_dump($result->text_id);
        return $result;
		}
		
	public function get_first_page($text_id){
		$module_path = $this->cms_module_path();
		$this->load->model($module_path.'/imbrex_filedesc_model');
        $result = $this->imbrex_filedesc_model->get_first_page($text_id);
        //var_dump($result);
        return $result;		
		}

}
