<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArduinoListOfEquipment extends Model
{
    use HasFactory;
    protected $table = 'arduino_list_of_equipments';
    protected $fillable = [
        'equipment_id',
        'equipment_description',
        'equipment_notes'
    ];
}
