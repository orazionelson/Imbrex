<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_filedesc_seriesstmt_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_filedesc_seriesstmt_model extends  CMS_Model{

    public function get_data($keyword, $page=0,$series_id=NULL){
        $limit = 10;
        $query = $this->db->select('imbrex_filedesc_seriesstmt.series_id, imbrex_filedesc_seriesstmt.public, imbrex_filedesc_seriesstmt.featured, imbrex_filedesc_seriesstmt.title, imbrex_filedesc_seriesstmt.description, imbrex_filedesc_seriesstmt.logo, imbrex_filedesc_seriesstmt.cover')
            ->from($this->t('imbrex_filedesc_seriesstmt').' as imbrex_filedesc_seriesstmt')
            ->where('imbrex_filedesc_seriesstmt.public', 1);
        if($series_id){$query=$this->db->where('imbrex_filedesc_seriesstmt.series_id', $series_id);}     
            //->or_like('imbrex_filedesc_seriesstmt.featured', $keyword)
        $query=$this->db->group_start()
            ->like('imbrex_filedesc_seriesstmt.title', $keyword)
            ->or_like('imbrex_filedesc_seriesstmt.description', $keyword)
            ->group_end()
            //->or_like('imbrex_filedesc_seriesstmt.logo', $keyword)
            //->or_like('imbrex_filedesc_seriesstmt.cover', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }

}
