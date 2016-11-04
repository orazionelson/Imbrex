<?php
# Use to automatically load in data into TILE

$host='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$prefix=preg_replace('/plugins\/AutoLoad\/autoLoadConfig\.php/','',$host);
// $prefix=preg_replace('/\//','\/',$prefix);

# SET DEFAULT SCRIPT HERE
$DEFAULT_SCRIPT=$prefix."plugins/CoreData/importDataScript.php?file=http://localhost/No-CMS/files/swinburne.xml";
//$DEFAULT_SCRIPT="imbrex/browse_imbrex_tile/importDataScript?file=http://localhost/No-CMS/files/swinburne.xml";

echo $DEFAULT_SCRIPT;
?>
