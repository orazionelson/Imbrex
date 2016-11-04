<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$contents = '';
foreach($result as $record){
    $contents .= '<div id="record_'.$record->page_id.'" class="record_container panel panel-default">';
    $contents .= '<div class="panel-body">';

    // TABLE
    $contents .= '<table class="table table-hover">';
    $contents .= '<tbody>';

    // COLUMNS
    //XML:ID
    $contents .= '<tr>';
    $contents .= '<th>xml:Id</th>';
    $contents .= '<td>' . $record->imbrex_filedesc_xml_id . '</td>';
    $contents .= '</tr>';
    //FILE
    $contents .= '<tr>';
    $contents .= '<th>file</th>';
    $contents .= '<td>' . $record->file . '</td>';
    $contents .= '</tr>';
    //PAGE NUMBER
    $contents .= '<tr>';
    $contents .= '<th>Page number</th>';
    $contents .= '<td>' . $record->pagenum . '</td>';
    $contents .= '</tr>';
    //MANTAIN LINE BREAKS
    $contents .= '<tr>';
    $contents .= '<th>Mantain line breaks</th>';
    $contents .= '<td>' . $record->linebreaks . '</td>';
    $contents .= '</tr>';
    //CONTENT
    $contents .= '<tr>';
    $contents .= '<th>Content</th>';
    $contents .= '<td>' . $record->pagecontent . '</td>';
    $contents .= '</tr>';
    //CLOSED
    $contents .= '<tr>';
    $contents .= '<th>Closed</th>';
    $contents .= '<td>' . $record->closed . '</td>';
    $contents .= '</tr>';

    $contents .= '</tbody>';
    $contents .= '</table>';


    // EDIT AND DELETE BUTTON
    if($allow_navigate_backend && ($have_edit_privilege || $have_delete_privilege)){

        $contents .= '<div class="edit_delete_record_container pull-right">';

        // EDIT BUTTON
        if($have_edit_privilege){
            $contents .= '<a href="'.$backend_url.'/edit/'.$record->page_id.'" class="btn edit_record btn-default" primary_key = "'.$record->page_id.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
            $contents .= '&nbsp;';
        }
        // DELETE BUTTON
        if($have_delete_privilege){
            $contents .= '<a href="'.$backend_url.'/delete/'.$record->page_id.'" class="btn delete_record btn-danger" primary_key = "'.$record->page_id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
        }

        $contents .= '</div>';

        $contents .= '<div style="clear:both;"></div>';
    }

    // end of div record
    $contents .= '</div>';
    $contents .= '</div>';
}

echo $contents;
