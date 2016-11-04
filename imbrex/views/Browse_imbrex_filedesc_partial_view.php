<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if($result==NULL) break;
$contents = '';
foreach($result as $record){
	//var_dump($record->text);
	if($record->text){$text_id=$record->text->text_id;}
    $contents .= '<div id="record_'.$record->ed_id.'" class="record_container panel panel-default">';
    $contents .= '<div class="panel-body">';
    $contents .='<div class="row">'; 
		$contents .='<div class="col-xs-2">'; 
	    if(isset($record->first_page)){
			$contents .= "<img class=\"edition_first_page img-responsive img-rounded img-thumbnail\" src=\"".base_url()."files/".$record->ed_id."/images/".$record->first_page->file."\" alt=\"Edition First Page\">";
		}
			$contents .= '<div class="btn-group-sm" role="group" style="margin-top:5px" aria-label="info and tiles">';
				$contents .= '<a href="" class="btn btn-warning btn-block">More info</a><a href="browse_imbrex_text_body_lg?text_id='.$text_id.'" class="btn btn-success btn-block">View</a>';
			$contents .= '</div>';		
		$contents .='</div>';
		$contents .='<div class="col-xs-10">';
			$contents .= '<table class="table table-hover">';
			$contents .= '<tbody>';
			if(!$series_id){
				    $contents .= '<tr>';
					$contents .= '<th>Series</th>';
					$contents .= '<td>' . $record->imbrex_filedesc_seriesstmt_title . '</td>';
					$contents .= '</tr>';
				}

			//TITLE
		    $contents .= '<tr>';
		    //
		    $contents .= '<td><h3>' . $record->titlestmt_title . '</h3</td>';
		    $contents .= '<td></td>';
		    $contents .= '</tr>';		    
			//AUTHOR
		    $contents .= '<tr>';
			$contents .= '<td>Authors</td>';
		    $contents .= '<td>'; 
		    
				$authors=$record->authors;
				foreach($authors as $author){
					$contents .= $author->name."<br>";
					}
		    
		    $contents .= '</td>';
		    $contents .= '</tr>';
		    //EDITORS
		    $contents .= '<tr>';
		    $contents .= '<td>Editors</td>';
		    $contents .= '<td>'; 
		    
				$editors=$record->editors;
				foreach($editors as $editor){
					$contents .= $editor->name."<br>";
					}
		    
		    $contents .= '</td>';
		    $contents .= '</tr>';		    
		$contents .= '</tbody>';
		$contents .= '</table>';
			//$contents .= $record->description;
		//$contents .='<a class="btn btn-default" href="browse_imbrex_filedesc?series_id='.$record->series_id.'">View</a></div>';
	$contents .='</div>';
	$contents .='</div>';

    // TABLE
    /*$contents .= '<table class="table table-hover">';
    $contents .= '<tbody>';*/

    // COLUMNS
    //XML:ID
    /*$contents .= '<tr>';
    $contents .= '<th>xml:Id</th>';
    $contents .= '<td>' . $record->xml_id . '</td>';
    $contents .= '</tr>';
    //PUBLIC
    $contents .= '<tr>';
    $contents .= '<th>Public</th>';
    $contents .= '<td>' . $record->public . '</td>';
    $contents .= '</tr>';
    //FEATURED
    $contents .= '<tr>';
    $contents .= '<th>Featured</th>';
    $contents .= '<td>' . $record->featured . '</td>';
    $contents .= '</tr>';*/
    //SERIES

    /*$contents .= '<tr>';
    $contents .= '<th>Series</th>';
    $contents .= '<td>' . $record->imbrex_filedesc_seriesstmt_title . '</td>';
    $contents .= '</tr>';
    */
    //TITLE
    /*$contents .= '<tr>';
    $contents .= '<th>Title</th>';
    $contents .= '<td><h3>' . $record->titlestmt_title . '</h3><a href="" class="btn btn-default">More info</a>  <a href="" class="btn btn-default">View</a></td>';
    $contents .= '</tr>';*/
    
    //AUTHORS
    /*$contents .= '<tr>';
    $contents .= '<th>Authors</th>';
    $contents .= '<td>'; 
    
		$authors=$record->authors;
		foreach($authors as $author){
			$contents .= $author->name."<br>";
			}
    
    $contents .= '</td>';
    $contents .= '</tr>';

    //AUTHORS
    $contents .= '<tr>';
    $contents .= '<th>Editors</th>';
    $contents .= '<td>'; 
    
		$editors=$record->editors;
		foreach($editors as $editor){
			$contents .= $editor->name."<br>";
			}
    
    $contents .= '</td>';
    $contents .= '</tr>';

    //PUBLICATION PLACE
    $contents .= '<tr>';
    $contents .= '<th>Publication Place</th>';
    $contents .= '<td>' . $record->publicationstmt_pubplace . '</td>';
    $contents .= '</tr>';
    //DATE
    $contents .= '<tr>';
    $contents .= '<th>Date</th>';
    $contents .= '<td>' . $record->publicationstmt_date . '</td>';
    $contents .= '</tr>';
    //AUTHORITY
    $contents .= '<tr>';
    $contents .= '<th>Authority</th>';
    $contents .= '<td>' . $record->publicationstmt_authority . '</td>';
    $contents .= '</tr>';
    //AVAILABILITY
    $contents .= '<tr>';
    $contents .= '<th>Availability</th>';
    $contents .= '<td>' . $record->publicationstmt_availability . '</td>';
    $contents .= '</tr>';
    //TITLE
    $contents .= '<tr>';
    $contents .= '<th>Title</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_analytic_title . '</td>';
    $contents .= '</tr>';
    //TITLE
    $contents .= '<tr>';
    $contents .= '<th>Title</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_title . '</td>';
    $contents .= '</tr>';
    //PUBLICATION PLACE
    $contents .= '<tr>';
    $contents .= '<th>Publication Place</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_imprint_pubplace . '</td>';
    $contents .= '</tr>';
    //PUBLISHER
    $contents .= '<tr>';
    $contents .= '<th>Publisher</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_imprint_publisher . '</td>';
    $contents .= '</tr>';
    //PUBLISHING DATE
    $contents .= '<tr>';
    $contents .= '<th>Publishing Date</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_imprint_date . '</td>';
    $contents .= '</tr>';
    //VOLUME NB
    $contents .= '<tr>';
    $contents .= '<th>Volume nb</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_imprint_biblscope_vol . '</td>';
    $contents .= '</tr>';
    //VOLUME PP
    $contents .= '<tr>';
    $contents .= '<th>Volume pp</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_imprint_biblscope_pp . '</td>';
    $contents .= '</tr>';
    //EXTENT
    $contents .= '<tr>';
    $contents .= '<th>Extent</th>';
    $contents .= '<td>' . $record->sourcedesc_biblstruct_monogr_extent . '</td>';
    $contents .= '</tr>';

    $contents .= '</tbody>';
    $contents .= '</table>';*/


    // EDIT AND DELETE BUTTON
    if($allow_navigate_backend && ($have_edit_privilege || $have_delete_privilege)){

        $contents .= '<div class="edit_delete_record_container pull-right">';

        // EDIT BUTTON
        if($have_edit_privilege){
            $contents .= '<a href="'.$backend_url.'/edit/'.$record->ed_id.'" class="btn edit_record btn-default" primary_key = "'.$record->ed_id.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
            $contents .= '&nbsp;';
        }
        // DELETE BUTTON
        if($have_delete_privilege){
            $contents .= '<a href="'.$backend_url.'/delete/'.$record->ed_id.'" class="btn delete_record btn-danger" primary_key = "'.$record->ed_id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
        }

        $contents .= '</div>';

        $contents .= '<div style="clear:both;"></div>';
    }

    // end of div record
    $contents .= '</div>';
    $contents .= '</div>';
}

echo $contents;
