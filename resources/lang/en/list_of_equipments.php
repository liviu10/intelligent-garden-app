<?php

return [
    'page_title'   => 'Equipment List',
    'page_info_1'  => 'Below is displayed a list of all the equipments that are connected to the informatics system.',
    'page_info_2'  => 'The following actions are permitted: create, show, modify and delete equipments.',
    'page_btn_add' => [
        'label'    => 'New Equipment',
        'title'    => 'Add a new equipment in the database',
    ],
    'page_table'   => [
        'column_1' => 'Equipment Id',
        'column_2' => 'Equipment Description',
        'column_3' => 'Equipment Notes',
        'column_4' => 'Equipment Date',
        'column_5' => [
            'title'      => 'Actions',
            'btn_show'   => 'View more details about :sensorDescription',
            'btn_edit'   => 'Edit :sensorDescription',
            'btn_delete' => 'Delete :sensorDescription',
        ],
    ],
    'page_modal'   => [
        'title'    => 'Information about the :sensorDescription',
    ],
    'page_new_records' => [
        'info_1'     => 'Create and save a new equipment in the database',
        'error_info' => 'There was some problems with your input!',
        'actions'    => [
            'btn_save'  => 'SAVE',
            'btn_title' => 'Save the equipment in the database!',
        ],
    ],
    'page_edit_records' => [
        'info_1'     => 'Modify the details of an equipment',
        'error_info' => 'There was some problems with your input!',
        'actions'    => [
            'btn_save'  => 'MODIFY',
            'btn_title' => 'Save the equipment in the database!',
        ],
    ],
];