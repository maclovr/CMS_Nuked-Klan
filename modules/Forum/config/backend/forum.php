<?php

/* nkList configuration */

// Define the list of forum
$forumList = array(
    'css' => array('tablePrefix' => 'forum', 'fieldsPrefix' => 'f'),
    'sqlQuery' => 'SELECT A.id, A.nom, A.niveau, A.level, B.nom AS category FROM '. FORUM_TABLE .' AS A LEFT JOIN '. FORUM_CAT_TABLE .' AS B ON B.id = A.cat',
    'defaultSortables' => array(
        'order'     => array('B.ordre', 'B.nom', 'A.ordre', 'A.nom')
    ),
    'fields' => array(
        'nom'       => array('label' => _NAME),
        'category'  => array('label' => _CAT),
        'niveau'    => array('label' => _LEVELACCES),
        'level'     => array('label' => _LEVELPOST)
    ),
    'edit' => array(
        'op'                => 'editForum',
        'imgTitle'          => _EDITTHISFORUM
    ),
    'delete' => array(
        'op'                => 'deleteForum',
        'imgTitle'          => _DELTHISFORUM,
        'confirmTxt'        => _DELETE_CONFIRM .' %s ! '. _CONFIRM,
        'confirmField'      => 'nom'
    ),
    'emptytable' => _NOFORUMINDB,
    'callbackRowFunction' => array(
        'functionName'      => 'formatForumRow'
    )
);

/* nkForm configuration */

// List of fields to update
$forumField = array(
    'nom',
    'comment',
    'cat',
    'moderateurs',
    'image',
    'niveau',
    'level',
    'ordre',
    'level_poll',
    'level_vote'
);

// Definition of editing forum form
$forumForm = array(
    'checkform' => true,
    'id'        => 'editForumForm',
    'action'    => 'index.php?file=Forum&amp;page=admin&amp;op=saveForum',
    'method'    => 'post',
    'enctype'   => 'multipart/form-data',
    'items' => array(
        'nom' => array(
            'label'             => '<b>'. _NAME .' : </b>',
            'type'              => 'text',
            'name'              => 'titre',
            'size'              => 30,
            'dataType'          => 'text',
            'required'          => true,
            'noempty'           => true
        ),
        'cat' => array(
            'label'             => '<b>'. _CAT .' : </b>',
            'type'              => 'select',
            'name'              => 'cat',
            'options'           => array()
        ),
        'comment' => array(
            'label'             => '<b>'. _DESCR .' : </b>',
            'type'              => 'text',
            'name'              => 'description',
            'rows'              => 10,
            'rows'              => 69,
            'inputClass'        => array('editor')
        ),
        'image' => array(
            'label'             => '<b>'. _IMAGE .' : </b>',
            'type'              => 'text',
            'name'              => 'urlImageForum',
            'size'              => 42
        ),
        'upImageForum' => array(
            'label'             => '<b>'. _UPLOADIMAGE .' : </b>',
            'type'              => 'file',
            'name'              => 'upImageForum'
        ),
        'niveau' => array(
            'label'             => '<b>'. _LEVELACCES .' : </b>',
            'type'              => 'select',
            'name'              => 'niveau',
            'options'           => array(
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9
            )
        ),
        'level' => array(
            'label'             => '<b>'. _LEVELPOST .' : </b>',
            'type'              => 'select',
            'name'              => 'level',
            'options'           => array(
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9
            )
        ),
        'ordre' => array(
            'label'             => '<b>'. _ORDER .' : </b>',
            'type'              => 'text',
            'name'              => 'ordre',
            'value'             => '0',
            'size'              => 2,
            'dataType'          => 'numeric',
            'required'          => true,
            'noempty'           => true
        ),
        'level_poll' => array(
            'label'             => '<b>'. _LEVELPOLL .' : </b>',
            'type'              => 'select',
            'name'              => 'level_poll',
            'options'           => array(
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9
            )
        ),
        'level_vote' => array(
            'label'             => '<b>'. _LEVELVOTE .' : </b>',
            'type'              => 'select',
            'name'              => 'level_vote',
            'options'           => array(
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9
            )
        ),
        'moderatorList' => array(
            'fakeLabel'         => '<b>'. _MODO .' : </b>',
            'html'              => ''
        ),
        'moderateurs' => array(
            'label'             => '<b>'. _MODERATEUR .' : </b>',
            'type'              => 'select',
            'name'              => 'modo',
            'options'           => array()
        )
    ),
    'itemsFooter' => array(
        'submit' => array(
            'type'              => 'submit',
            'name'              => 'submit',
            'value'             => _ADDTHISFORUM,
            'inputClass'        => array('button')
        ),
        'backlink' => array(
            'html'              => '<a class="buttonLink" href="index.php?file=Forum&amp;page=admin&amp;op=main_cat">'. _BACK .'</a>'
        )
    )
);

?>