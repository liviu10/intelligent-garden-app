<?php

return [
    'page_title'    => 'Equipment List',
    'error_info'    => 'Your equipment details could not be save in the database!',
    'page_header'   => [
        'info_1'    => 'Below is displayed a list of all the equipments that are connected to the informatics system.',
        'info_2'    => 'The following actions are permitted: create, show, modify and delete equipments.',
        'btn_add'   => [
            'label' => 'New Equipment',
            'title' => 'Add a new equipment in the database',
        ],
    ],
    'page_modal_new'=> [
        'title'     => 'Add a new equipment',
        'info_1'    => 'Create and save a new equipment in the database',
        'form'      => [
            'label_1' => 'Equipment Id',
            'label_2' => 'Equipment Description',
            'label_3' => 'Equipment Notes',
            'label_4' => 'Equipment Date',
        ],
        'btn_save'  => [
            'label' => 'SAVE',
            'title' => 'Save the equipment in the database!',
        ],
    ],
    'page_table'   => [
        'label_1'  => 'Equipment Id',
        'label_2'  => 'Equipment Description',
        'label_3'  => 'Equipment Notes',
        'label_4'  => 'Equipment Date',
        'label_5'  => [
            'title'      => 'Actions',
            'btn_show'   => 'View more details about :sensorDescription',
            'btn_edit'   => 'Edit :sensorDescription',
            'btn_delete' => 'Delete :sensorDescription',
        ],
        'empty' => [
            'btn_save'  => [
                'label' => 'Add Equipment',
                'title' => 'Add your first equipment to the database!',
            ],
        ],
    ],
    'page_modal_show'   => [
        'title'    => 'Information about the :sensorDescription',
        'info_1'   => 'Equipment name: :sensorDescription',
        'info_2'   => 'Equipment information: :sensorInformation',
        'info_3'   => 'Equipment date added: '
    ],
    'page_modal_edit' => [
        'info_1'     => 'Modify the details of an equipment',
        'btn_save'  => [
            'label' => 'MODIFY',
            'title' => 'Modify the equipment and save it in the database!',
        ],
    ],
];