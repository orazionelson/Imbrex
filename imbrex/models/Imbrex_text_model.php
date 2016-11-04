<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_text_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_text_model extends  CMS_Model{

    public function get_data($keyword, $page=0){
        $limit = 10;
        $query = $this->db->select('imbrex_text.text_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, imbrex_text.text_type, imbrex_languages.language as imbrex_languages_language, imbrex_text.body_note, imbrex_text.linebreak')
            ->from($this->t('imbrex_text').' as imbrex_text')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text.xml_id=imbrex_filedesc.ed_id', 'left')
            ->join($this->t('imbrex_languages').' as imbrex_languages', 'imbrex_text.text_lang=imbrex_languages.language_id', 'left')
            ->like('imbrex_filedesc.xml_id', $keyword)
            ->or_like('imbrex_text.text_type', $keyword)
            ->or_like('imbrex_languages.language', $keyword)
            ->or_like('imbrex_text.body_note', $keyword)
            ->or_like('imbrex_text.linebreak', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }
   
}
