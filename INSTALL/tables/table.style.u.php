<?php

$dbTable->setTable($this->_session['db_prefix'] .'_style');

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table removal
///////////////////////////////////////////////////////////////////////////////////////////////////////////

// install / update 1.7.9 RC1 (created)
// update 1.7.9 RC6 (removed)
if ($process == 'update' && $dbTable->tableExist())
    $dbTable->dropTable();

?>