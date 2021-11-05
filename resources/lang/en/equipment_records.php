<?php

return [
    'page_title'   => 'Equipment Records',
    'page_info_1'  => 'Here you will find all the values for :sensorDescription that were recorded and sent to this web application via the API. The graphic chart shows the read records evolution in the last 7 days. The table displays these values in descending order based on the reading date and time.',
    'page_info_2'  => 'The following actions are permitted: create, show, modify and delete read values.',
    'page_btn_add' => [
        'label'    => 'New Record',
        'title'    => 'Add a new equipment record in the database',
        'modal'    => [
            'title'               => 'Add a new record',
            'first_label'         => 'Equipment Id',
            'second_label'        => 'Equipment Value',
            'btn_name'            => 'Save',
            'btn_title'           => 'Save the record to the data base',
            'last_record_info'    => 'Last recorded value',
            'last_record_details' => ' on :created_at_date at :created_at_time',
            'equipment_options'   => [
                'normal' => 'Normal level',
                'high'   => 'High level',
                '0'      => 'STOPPED',
                '1'      => 'STARTED',
            ],
        ],
    ],
    'page_btn_export' => [
        'label'    => 'Export to CSV / Excel',
        'title'    => 'Export the :sensorDescription record(s) to CSV or Excel',
    ],
    'page_btn_statistics' => [
        'label'    => 'View Statistics',
        'title'    => 'Display statistics about the :sensorDescription',
        'modal'    => [
            'ph_sensor' => [
                'title'       => 'Statistics :sensorDescription',
                'title_1'     => 'Last hour information',
                'title_2'     => 'Today\'s information',
                'title_3'     => 'Yesterday\'s information',
                'title_4'     => 'Last week information',
                'title_5'     => 'General information',
                'list_item_1' => 'Total number of measurements',
                'list_item_2' => 'The smallest value',
                'list_item_3' => 'The highest value',
                'list_item_4' => 'Average of all the measurements',
            ],
            'ec_sensor' => [
                'title'         => 'Statistics :equipment_id',
                'title_1'       => 'Last hour information',
                'title_2'       => 'Today\'s information',
                'title_3'       => 'Yesterday\'s information',
                'title_4'       => 'Last week information',
                'title_5'       => 'General information',
                'list_item_1'   => 'Total number of measurements',
                'list_item_2'   => 'The smallest value',
                'list_item_3'   => 'The highest value',
                'list_item_4'   => 'Average of all the measurements',
            ],
            'level_sensor' => [
                'title'         => 'Statistics :equipment_id',
                'title_1'       => 'Last hour information',
                'title_2'       => 'Today\'s information',
                'title_3'       => 'Yesterday\'s information',
                'title_4'       => 'Last week information',
                'title_5'       => 'General information',
                'list_item_1'   => 'Total number of measurements',
                'list_item_2'   => 'How many times was recorded critical level',
                'list_item_3'   => 'How many times was recorded low level',
                'list_item_4'   => 'How many times was recorded high level',
            ],
        ],
    ],
    'page_table'   => [
        'column_1' => 'Equipment Id',
        'column_2' => 'Equipment Value',
        'column_3' => 'Read Date',
        'column_4' => [
            'title'      => 'Actions',
            'btn_edit'   => 'Edit the :sensorDescription',
            'btn_delete' => 'Delete the :sensorDescription',
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