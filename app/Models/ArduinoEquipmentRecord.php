<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArduinoEquipmentRecord extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'arduino_equipment_records';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'arduino_list_of_equipment_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'arduino_list_of_equipment_id',
        'equipment_value',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * Eloquent relationship between arduino_equipment_records and arduino_list_of_equipments.
     * One or many blog equipment record(s) may have only one arduino equipment.
     */
    public function arduino_list_of_equipment()
    {
        return $this->belongsTo('App\Models\ArduinoListOfEquipment');
    }
}
