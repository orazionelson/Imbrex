<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Imbrex_tile_model
 *
 * @author No-CMS Module Generator
 */
class Imbrex_tile_model extends  CMS_Model{

    public function get_data($page_id){
        //$limit = 10;
        
        $query = $this->db->select('imbrex_text_body_lg.page_id, imbrex_filedesc.ed_id as imbrex_filedesc_xml_id, imbrex_text_body_lg.file, imbrex_text_body_lg.pagenum, imbrex_text_body_lg.linebreaks, imbrex_text_body_lg.pagecontent, imbrex_text_body_lg.closed,imbrex_text_body_lg.text_id')
            ->from($this->t('imbrex_text_body_lg').' as imbrex_text_body_lg')
            ->join($this->t('imbrex_filedesc').' as imbrex_filedesc', 'imbrex_text_body_lg.xml_id=imbrex_filedesc.ed_id', 'left')
            /*->like('imbrex_filedesc.xml_id', $keyword)
            ->or_like('imbrex_text_body_lg.file', $keyword)
            ->or_like('imbrex_text_body_lg.pagenum', $keyword)
            ->or_like('imbrex_text_body_lg.linebreaks', $keyword)
            ->or_like('imbrex_text_body_lg.pagecontent', $keyword)*/
            ->where('imbrex_text_body_lg.closed', true)
            ->where('imbrex_text_body_lg.page_id',$page_id)
            //->where('imbrex_text_body_lg.closed',1)
            //->limit($limit, $page*$limit)
            ->get();
        $result = $query->row();
        return $result;
    }
    
    public function get_labels($result){
		//var_dump($result);
		//var_dump($result->text_id);
		$xml_id=$result->imbrex_filedesc_xml_id;
		 $query = $this->db->select('imbrex_filedesc.seriesstmt')
            ->from($this->t('imbrex_filedesc').' as imbrex_filedesc')
            ->where('imbrex_filedesc.ed_id',$xml_id)
            ->get();
            
        $series_id = $query->row();
        //var_dump($series_id);
        
        $query2 = $this->db->select('imbrex_text_labels.id, imbrex_text_labels.name')
            ->from($this->t('imbrex_text_labels').' as imbrex_text_labels')
            ->where('imbrex_text_labels.series_id',$series_id->seriesstmt)
            ->get();
        $labels = $query2->result_array();
        //var_dump($labels);

        /*SELECT * 
FROM  `cms_imbrex_text_labels` 
WHERE  `series_id` =1*/
        
        return $labels;
		}
 
    public function get_page_labels($page_id){		
		$query = $this->db->select('id, name, selections, shapes')
		->get_where($this->t('imbrex_page_labels'), array('page_id' => $page_id));
        
        $labels = $query->result_array();
        //var_dump($labels);
        //echo "<hr>";
        
        $llabels=array();
        
        foreach($labels as $field=>$label){
			if(isset($label['selections'])){
				$label['selections']=explode(',', $label['selections']);
				}
			else {unset($label['selections']);}
			
			if(isset($label['shapes'])){
				$label['shapes']=explode(',', $label['shapes']);
				}
			else {unset($label['shapes']);}
			$llabels[]=$label;	
			}        
        
        return $llabels;
		}

    public function get_text_shapes($page_id){		
		$query = $this->db->select('id, type, _scale, color, posinfo_x_cx, posinfo_y_cy, posinfo_width_rx, posinfo_height_ry, labels, lines')
		->get_where($this->t('imbrex_text_shapes'), array('page_id' => $page_id));
        
        $shapes = $query->result_array();
        //var_dump($shapes);
        //echo "<hr>";
        $sshapes=array();
        foreach($shapes as $field=>$shape){
			if(isset($shape['labels'])){
				$shape['labels']=explode(',', $shape['labels']);
				}
			else {unset($shape['labels']);}
			
			if(isset($shape['lines'])){
				$shape['lines']=explode(',', $shape['lines']);
				}
			else {unset($shape['lines']);}
			
			
			$shape['posInfo']=array();
			
			if($shape['type']=='rect'){
					$shape['posInfo']['x']=$shape['posinfo_x_cx'];
					$shape['posInfo']['y']=$shape['posinfo_y_cy'];
					$shape['posInfo']['width']=$shape['posinfo_width_rx'];
					$shape['posInfo']['height']=$shape['posinfo_height_ry'];
					unset($shape['posinfo_x_cx']);
					unset($shape['posinfo_y_cy']);
					unset($shape['posinfo_width_rx']);
					unset($shape['posinfo_height_ry']);
				}
			if($shape['type']=='ellipse'){
					$shape['posInfo']['cx']=$shape['posinfo_x_cx'];
					$shape['posInfo']['cy']=$shape['posinfo_y_cy'];
					$shape['posInfo']['rx']=$shape['posinfo_width_rx'];
					$shape['posInfo']['ry']=$shape['posinfo_height_ry'];
					unset($shape['posinfo_x_cx']);
					unset($shape['posinfo_y_cy']);
					unset($shape['posinfo_width_rx']);
					unset($shape['posinfo_height_ry']);
				}	
			
			$sshapes[]=$shape;	
			}        
        
        return $sshapes;
		}

    public function get_text_selections($page_id){		
		$query = $this->db->select('id, startparent, startoffset, startchild, endparent, endoffset, endchild, color, labels')
		->get_where($this->t('imbrex_text_selections'), array('page_id' => $page_id));
        
        $selections = $query->result_array();
        //var_dump($shapes);
        //echo "<hr>";
        $sselections=array();
        foreach($selections as $field=>$selection){
			if(isset($selection['labels'])){
				$selection['labels']=explode(',', $selection['labels']);
				}
			$selection['StartParent']=$selection['startparent'];
			unset($selection['startparent']);	
			$selection['StartOffset']=$selection['startoffset'];
			unset($selection['startoffset']);	
			$selection['StartChild']=$selection['startchild'];
			unset($selection['startchild']);	
			$selection['EndParent']=$selection['endparent'];
			unset($selection['endparent']);	
			$selection['EndOffset']=$selection['endoffset'];
			unset($selection['endoffset']);	
			$selection['EndChild']=$selection['endchild'];
			unset($selection['endchild']);	
			
			$sselections[]=$selection;	
			}        
        
        return $sselections;
		}

	public function check_shape_reference($page_id, $line){
		$query = $this->db->select('id')
		->get_where($this->t('imbrex_text_shapes'), array('page_id'=>$page_id,'lines' => $line));
		
		$shapes_id = $query->row_array();
		
		if($shapes_id){
		$shapes_id=array_values($shapes_id);
		}

		return $shapes_id;
		
		}
}
