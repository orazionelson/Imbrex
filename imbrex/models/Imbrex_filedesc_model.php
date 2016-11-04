<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_filedesc_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_filedesc_model extends  CMS_Model{
    public function get_data($keyword, $page=0, $series_id=NULL){
        $limit = 10;
        $query = $this->db->select('imbrex_filedesc.ed_id, imbrex_filedesc.xml_id, imbrex_filedesc.public, imbrex_filedesc.featured, imbrex_filedesc_seriesstmt.title as imbrex_filedesc_seriesstmt_title, imbrex_filedesc.titlestmt_title, imbrex_filedesc.publicationstmt_pubplace, imbrex_filedesc.publicationstmt_date, imbrex_filedesc.publicationstmt_authority, imbrex_filedesc.publicationstmt_availability, imbrex_filedesc.sourcedesc_biblstruct_analytic_title, imbrex_filedesc.sourcedesc_biblstruct_monogr_title, imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_pubplace, imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_publisher, imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_date, imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_biblscope_vol, imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_biblscope_pp, imbrex_filedesc.sourcedesc_biblstruct_monogr_extent')
            ->from($this->t('imbrex_filedesc').' as imbrex_filedesc')
            ->join($this->t('imbrex_filedesc_seriesstmt').' as imbrex_filedesc_seriesstmt', 'imbrex_filedesc.seriesstmt=imbrex_filedesc_seriesstmt.series_id', 'left')
            ->where('imbrex_filedesc.public', 1);
            if($series_id){$query=$this->db->where('imbrex_filedesc.seriesstmt', $series_id);}
            $query=$this->db->group_start()
	            ->like('imbrex_filedesc.xml_id', $keyword)
	            ->or_like('imbrex_filedesc.featured', $keyword)
	            ->or_like('imbrex_filedesc_seriesstmt.title', $keyword)
	            ->or_like('imbrex_filedesc.titlestmt_title', $keyword)
	            ->or_like('imbrex_filedesc.publicationstmt_pubplace', $keyword)
	            ->or_like('imbrex_filedesc.publicationstmt_date', $keyword)
	            ->or_like('imbrex_filedesc.publicationstmt_authority', $keyword)
	            ->or_like('imbrex_filedesc.publicationstmt_availability', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_analytic_title', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_title', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_pubplace', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_publisher', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_date', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_biblscope_vol', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_imprint_biblscope_pp', $keyword)
	            ->or_like('imbrex_filedesc.sourcedesc_biblstruct_monogr_extent', $keyword)
	        ->group_end()
            ->limit($limit, $page*$limit)
            ->get();
         
        $result = $query->result();
        
        // Loop through the products array
        //$result = array($result);
        if(count($result)>0){
			foreach($result as $i=>$edition) {			
				
				$authors_query = $this->db->where('ed_id', $edition->ed_id)->get($this->t('imbrex_titlestmt_author'))->result();
				$editors_query = $this->db->where('ed_id', $edition->ed_id)->get($this->t('imbrex_titlestmt_editor'))->result();
				//var_dump($editors_query);
				$edition->authors = $authors_query;
				$edition->editors = $editors_query;
				
				$edition->text=$this->get_text($edition->ed_id);
				//var_dump($edition->text);
				if($edition->text){
				$edition->first_page=$this->get_first_page($edition->text->text_id);
				}
				
				$nresult[]=$edition;
			}
		}
		/* */   
		
        
        return $result;
    }
	
    public function get_titles($id){
        $limit = 10;
        $query = $this->db->select('imbrex_filedesc.ed_id, imbrex_filedesc.xml_id, imbrex_filedesc_seriesstmt.title as imbrex_filedesc_seriesstmt_title, imbrex_filedesc.titlestmt_title')
            ->from($this->t('imbrex_filedesc').' as imbrex_filedesc')
            ->join($this->t('imbrex_filedesc_seriesstmt').' as imbrex_filedesc_seriesstmt', 'imbrex_filedesc.seriesstmt=imbrex_filedesc_seriesstmt.series_id', 'left')
            ->where('imbrex_filedesc.ed_id', $id)
            ->get();
        $result = $query->result();
        
        return $result;
    }
	
	public function get_text($id){
		$query = $this->db->select('imbrex_text.text_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, imbrex_text.text_type, imbrex_languages.language as imbrex_languages_language, imbrex_text.body_note, imbrex_text.linebreak')
            ->from($this->t('imbrex_text').' as imbrex_text')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text.xml_id=imbrex_filedesc.ed_id', 'left')
            ->join($this->t('imbrex_languages').' as imbrex_languages', 'imbrex_text.text_lang=imbrex_languages.language_id', 'left')
            ->where('imbrex_text.xml_id', $id)
            ->get();
        $result = $query->row();
        //var_dump($result);
        return $result;
	}
	
	public function get_first_page($text_id){
        $query = $this->db->select('imbrex_text_body_lg.file')
            ->from($this->t('imbrex_text_body_lg').' as imbrex_text_body_lg')
            ->where('imbrex_text_body_lg.text_id', $text_id)
            ->get();
        $result = $query->row();
        //var_dump($result);
        return $result;
	}	

}
