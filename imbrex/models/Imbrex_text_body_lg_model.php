<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_text_body_lg_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_text_body_lg_model extends  CMS_Model{

    public function get_pages($text_id){
        $query = $this->db->select('imbrex_text_body_lg.page_id, imbrex_text_body_lg.xml_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, imbrex_text_body_lg.file, imbrex_text_body_lg.pagenum, imbrex_text_body_lg.text_id')
            ->from($this->t('imbrex_text_body_lg').' as imbrex_text_body_lg')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text_body_lg.xml_id=imbrex_filedesc.ed_id', 'left')
            ->where('imbrex_text_body_lg.text_id', $text_id)
            ->where('imbrex_text_body_lg.closed', 1)
            ->get();
        $result = $query->result();
        return $result;
    }
    
    public function get_page($text_id,$page_id){
		//var_dump('azz');
		$query = $this->db->select('imbrex_text_body_lg.page_id,imbrex_text_body_lg.xml_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, imbrex_text_body_lg.file, imbrex_text_body_lg.pagenum, imbrex_text_body_lg.linebreaks, imbrex_text_body_lg.pagecontent, imbrex_text_body_lg.closed, imbrex_text_body_lg.text_id')
            ->from($this->t('imbrex_text_body_lg').' as imbrex_text_body_lg')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text_body_lg.xml_id=imbrex_filedesc.ed_id', 'left')
            ->where('imbrex_text_body_lg.page_id', $page_id)
            ->where('imbrex_text_body_lg.text_id', $text_id)
            ->where('imbrex_text_body_lg.closed', 1)
            ->get();
        $result = $query->row();
        //$result=json_encode($result);
        return $result;
    }
 
    public function get_data($keyword, $page=0){
        $limit = 10;
        $query = $this->db->select('imbrex_text_body_lg.page_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, imbrex_text_body_lg.file, imbrex_text_body_lg.pagenum, imbrex_text_body_lg.linebreaks, imbrex_text_body_lg.pagecontent, imbrex_text_body_lg.closed, imbrex_text_body_lg.text_id')
            ->from($this->t('imbrex_text_body_lg').' as imbrex_text_body_lg')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text_body_lg.xml_id=imbrex_filedesc.ed_id', 'left')
            ->like('imbrex_filedesc.xml_id', $keyword)
            ->or_like('imbrex_text_body_lg.file', $keyword)
            ->or_like('imbrex_text_body_lg.pagenum', $keyword)
            ->or_like('imbrex_text_body_lg.linebreaks', $keyword)
            ->or_like('imbrex_text_body_lg.pagecontent', $keyword)
            ->or_like('imbrex_text_body_lg.closed', $keyword)
            ->or_like('imbrex_text_body_lg.text_id', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }

}
