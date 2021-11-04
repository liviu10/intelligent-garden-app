<?php

return [
    'page_title'   => 'Listă Echipamente',
    'page_info_1'  => 'Mai jos este afișată o listă a tuturor echipmanetelor conectate la sistemul informatic.',
    'page_info_2'  => 'Următoarele operații sunt permise: creare, vizualizare, modificare și ștergere echipamente.',
    'page_btn_add' => [
        'label'    => 'Echipament Nou',
        'title'    => 'Adaugă un nou echipament în baza de date',
    ],
    'page_table'   => [
        'column_1' => 'Id Echipament',
        'column_2' => 'Descriere Echipament',
        'column_3' => 'Note Echipament',
        'column_4' => 'Dată Echipament',
        'column_5' => [
            'title'      => 'Acțiuni',
            'btn_show'   => 'Vezi mai multe detalii despre :sensorDescription',
            'btn_edit'   => 'Editează :sensorDescription',
            'btn_delete' => 'Șterge :sensorDescription',
        ],
    ],
    'page_modal'   => [
        'title'    => 'Informații despre :sensorDescription',
    ],
    'page_new_records' => [
        'info_1'     => 'Crează și salvează un echipament nou în baza de date',
        'error_info' => 'Au apărut probleme la salavare!',
        'actions'    => [
            'btn_save'  => 'SALVEAZĂ',
            'btn_title' => 'Salvează echipamentul în baza de date!',
        ],
    ],
    'page_edit_records' => [
        'info_1'     => 'Modifică și salvează un echipament existent în baza de date',
        'error_info' => 'Au apărut probleme la salavare!',
        'actions'    => [
            'btn_save'  => 'MODIFICĂ',
            'btn_title' => 'Salvează echipamentul în baza de date!',
        ],
    ],
];