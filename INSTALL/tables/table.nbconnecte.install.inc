<?php

if ($this->data['process'] == 'install') {
    $sql = 'DROP TABLE IF EXISTS `'. $this->data['db_prefix'] .'_nbconnecte`';
    mysql_query($sql) or die(mysql_error());

    $sql = 'CREATE TABLE `'. $this->data['db_prefix'] .'_nbconnecte` (
            `IP` varchar(40) NOT NULL default \'\',
            `type` int(10) NOT NULL default \'0\',
            `date` int(14) NOT NULL default \'0\',
            `user_id` varchar(20) NOT NULL default \'\',
            `username` varchar(40) NOT NULL default \'\',
            PRIMARY KEY  ( `IP` , `user_id` )
        ) ENGINE=MyISAM DEFAULT CHARSET='. $charset .' COLLATE='. $collate .';';
    mysql_query($sql) or die(mysql_error());

    return 'CREATED';
}
else if ($this->data['process'] == 'update') {
    require_once 'class/updateDbTable.class.php';

    $udt = new updateDbTable($this->data['db_prefix'] .'_nbconnecte');

    // update 1.7.9 RC6
    if ($udt->fieldExist('IP')) {
        if ($udt->getFieldType('IP') != 'varchar(40)')
            $udt->modifyField('IP', array('type' => 'VARCHAR(40)', 'null' => false, 'default' => '\'\''));
    }
    else {
        die(sprintf($this->_i18n['MISSING_FIELD'], 'IP', $this->data['db_prefix'] .'_nbconnecte'));
    }

    $udt->modifyTable();

    if ($udt->isUpdated())
        return 'UPDATED';
    else
        return 'NOTHING_TO_DO';
}

?>