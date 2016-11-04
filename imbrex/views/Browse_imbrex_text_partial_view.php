<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$contents = '';
foreach($result as $record){
    $contents .= '<div id="record_'.$record->text_id.'" class="record_container panel panel-default">';
    $contents .= '<div class="panel-body">';

    // TABLE
    $contents .= '<table class="table table-hover">';
    $contents .= '<tbody>';

    // COLUMNS
    //EDITION XML ID
    $contents .= '<tr>';
    $contents .= '<th>Edition XML Id</th>';
    $contents .= '<td>' . $record->imbrex_filedesc_xml_id . '</td>';
    $contents .= '</tr>';
    //TEXT TYPE ATTRIB
    $contents .= '<tr>';
    $contents .= '<th>Text type Attrib</th>';
    $contents .= '<td>' . $record->text_type . '</td>';
    $contents .= '</tr>';
    //LANGUAGE 
    $contents .= '<tr>';
    $contents .= '<th>Language </th>';
    $contents .= '<td>' . $record->imbrex_languages_language . '</td>';
    $contents .= '</tr>';
    //TEXT NOTES
    $contents .= '<tr>';
    $contents .= '<th>Text Notes</th>';
    $contents .= '<td>' . $record->body_note . '</td>';
    $contents .= '</tr>';
    //MANTAIN LINE BREAKS
    $contents .= '<tr>';
    $contents .= '<th>Mantain line breaks</th>';
    $contents .= '<td>' . $record->linebreak . '</td>';
    $contents .= '</tr>';

    $contents .= '</tbody>';
    $contents .= '</table>';


    // EDIT AND DELETE BUTTON
    if($allow_navigate_backend && ($have_edit_privilege || $have_delete_privilege)){

        $contents .= '<div class="edit_delete_record_container pull-right">';

        // EDIT BUTTON
        if($have_edit_privilege){
            $contents .= '<a href="'.$backend_url.'/edit/'.$record->text_id.'" class="btn edit_record btn-default" primary_key = "'.$record->text_id.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
            $contents .= '&nbsp;';
        }
        // DELETE BUTTON
        if($have_delete_privilege){
            $contents .= '<a href="'.$backend_url.'/delete/'.$record->text_id.'" class="btn delete_record btn-danger" primary_key = "'.$record->text_id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
        }

        $contents .= '</div>';

        $contents .= '<div style="clear:both;"></div>';
    }

    // end of div record
    $contents .= '</div>';
    $contents .= '</div>';
}

echo $contents;
