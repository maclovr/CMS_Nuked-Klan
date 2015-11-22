<?php

// List of fields to update
$forumCatField = array(
    'nom',
    'image',
    'niveau',
    'ordre'
);

// Definition of editing forum category form
$forumCatForm = array(

    'id'        => 'editForumCatForm',
    'action'    => 'index.php?file=Forum&amp;page=admin&amp;op=saveCat',
    'method'    => 'post',
    'enctype'   => 'multipart/form-data',
    'items' => array(
        'nom' => array(
            'label'             => _NAME .' : ',
            'type'              => 'text',
            'name'              => 'nom',
            'size'              => 30
        ),
        'image' => array(
            'label'             => _IMAGE .' : ',
            'type'              => 'text',
            'name'              => 'urlImageCat',
            'size'              => 42
        ),
        'upImageCat' => array(
            'label'             => _UPLOADIMAGE .' : ',
            'type'              => 'file',
            'name'              => 'upImageCat'
        ),
        'niveau' => array(
            'label'             => _NIVEAU .' : ',
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
        'ordre' => array(
            'label'             => _ORDER .' : ',
            'type'              => 'text',
            'name'              => 'ordre',
            'value'             => '0',
            'size'              => 2
        )
    ),
    'itemsFooter' => array(
        'submit' => array(
            'type'              => 'submit',
            'name'              => 'submit',
            'value'             => _CREATECAT,
            'inputClass'        => array('button')
        ),
        'backlink' => array(
            'html'              => '<a class="buttonLink" href="index.php?file=Forum&amp;page=admin&amp;op=main_cat">'. _BACK .'</a>'
        )
    )
);

?>