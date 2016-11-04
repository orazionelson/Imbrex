<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_mte_jobs_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_mte_jobs_model extends  CMS_Model{

    public function get_data($keyword, $page=0){
        $limit = 10;
        $query = $this->db->select('imbrex_mte_jobs.mte_job_id, imbrex_filedesc.xml_id as imbrex_filedesc_xml_id, main_user.user_name as user_name')
            ->from($this->t('imbrex_mte_jobs').' as imbrex_mte_jobs')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_mte_jobs.ed_id=imbrex_filedesc.ed_id', 'left')
            ->join($this->t('main_user').' as main_user', 'imbrex_mte_jobs.user_id=main_user.user_id', 'left')
            ->like('imbrex_filedesc.xml_id', $keyword)
            ->or_like('main_user.user_name', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }

}
