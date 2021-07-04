<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArduinoEquipmentRecord extends Model
{
    use HasFactory;
    protected $table = 'arduino_equipment_records';
    protected $fillable = [
        'equipment_id', 
        'equipment_value', 
    ];
}
