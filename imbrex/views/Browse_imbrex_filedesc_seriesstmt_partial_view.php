<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$contents = '';
foreach($result as $record){
    $contents .= '<div id="record_'.$record->series_id.'" class="record_container panel panel-default">';
    $contents .= '<div class="panel-body">';

    // TABLE
    $contents .='<div class="row">'; 
		$contents .='<div class="col-sm-3">'; 
			$contents .= '<img class="series_logo img-responsive img-circle" alt="series logo" src="'.base_url().'/modules/'.$module_path.'/assets/images/series/'. $record->logo . '">';
		$contents .='</div>';
		$contents .='<div class="col-sm-9">';
			$contents .= '<h3>' . $record->title . '</h3>';
			$contents .= $record->description;
		$contents .='<a class="btn btn-default" href="browse_imbrex_filedesc?series_id='.$record->series_id.'">View</a></div>';
	$contents .='</div>';
    //$contents .= '<table class="table table-hover">';
    //$contents .= '<tbody>';

    // COLUMNS
    //PUBLIC
    /*$contents .= '<tr>';
    $contents .= '<th>Public</th>';
    $contents .= '<td>' . $record->public . '</td>';
    $contents .= '</tr>';*/
    //FEATURED
    /*$contents .= '<tr>';
    $contents .= '<th>Featured</th>';
    $contents .= '<td>' . $record->featured . '</td>';
    $contents .= '</tr>';
    //SERIES TITLE
    $contents .= '<tr>';
    //$contents .= '<th>Title</th>';
    $contents .= '<td><img class="series_logo" alt="series logo" src="'.base_url().'/modules/'.$module_path.'/assets/images/series/'. $record->logo . '"></td>';
    $contents .= '<td>' . $record->title . '</td>';
    $contents .= '</tr>';
    //DESCRIPTION
    $contents .= '<tr>';
    $contents .= '<th></th>';
    $contents .= '<td>' . $record->description . '</td>';
    $contents .= '</tr>';
    //SERIES LOGO
    $contents .= '<tr>';
    $contents .= '<th>Series Logo</th>';
    $contents .= '<td><img class="series_logo" alt="series logo" src="'.base_url().'/modules/'.$module_path.'/assets/images/series/'. $record->logo . '"></td>';
    $contents .= '</tr>';
    //SERIES COVER
    $contents .= '<tr>';
    $contents .= '<th>Series Cover</th>';
    $contents .= '<td>' . $record->cover . '</td>';
    $contents .= '</tr>';

    $contents .= '</tbody>';
    $contents .= '</table>';
	*/

    // EDIT AND DELETE BUTTON
    if($allow_navigate_backend && ($have_edit_privilege || $have_delete_privilege)){

        $contents .= '<div class="edit_delete_record_container pull-right">';

        // EDIT BUTTON
        if($have_edit_privilege){
            $contents .= '<a href="'.$backend_url.'/edit/'.$record->series_id.'" class="btn edit_record btn-default" primary_key = "'.$record->series_id.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
            $contents .= '&nbsp;';
        }
        // DELETE BUTTON
        if($have_delete_privilege){
            $contents .= '<a href="'.$backend_url.'/delete/'.$record->series_id.'" class="btn delete_record btn-danger" primary_key = "'.$record->series_id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
        }

        $contents .= '</div>';

        $contents .= '<div style="clear:both;"></div>';
    }

    // end of div record
    $contents .= '</div>';
    $contents .= '</div>';
}

echo $contents;
