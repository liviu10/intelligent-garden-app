<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiLogError;

class ListOfEquipment extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'list_of_equipments';

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
     * The foreign key associated with the table.
     *
     * @var string
     */
    protected $foreignKey = 'user_id';

    /**
     * The data type of the database table foreign key.
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
        'equipment_id',
        'equipment_description',
        'equipment_notes',
        'is_active',
        'user_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $attributes = [
        'is_active' => false,
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
     * Eloquent relationship between list of equipments and users.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\Settings\User');
    }

    /**
     * Eloquent relationship between list of equipments and equipment readings.
     *
     */
    public function equipment_readings()
    {
        return $this->hasMany('App\Models\Admin\Settings\EquipmentReading');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select(
                'id',
                'equipment_id',
                'equipment_description',
                'is_active'
            )->paginate(15);
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to save a single record in the database.
     * @param  array  $payload
     * @return  Bool
     */
    public function createRecord($payload)
    {
        try
        {
            $this->create([
                'equipment_id'          => $payload['equipment_id'],
                'equipment_description' => $payload['equipment_description'],
                'equipment_notes'       => $payload['equipment_notes'],
                'is_active'             => $payload['is_active'],
                'user_id'               => $payload['user_id'],
            ]);

            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to fetch a single record from the database.
     * @param  int  $id
     * @return  Collection|Bool
     */
    public function fetchSingleRecord($id)
    {
        try
        {
            return $this->select('*')
                        ->where('id', '=', $id)
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'full_name');
                            }
                        ])
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to update a single record in the database.
     * @param  array  $payload
     * @param  int  $id
     * @return  Bool
     */
    public function updateRecord($payload, $id)
    {
        try
        {
            $this->find($id)->update([
                'equipment_id'          => $payload['equipment_id'],
                'equipment_description' => $payload['equipment_description'],
                'equipment_notes'       => $payload['equipment_notes'],
                'is_active'             => $payload['is_active'],
                'user_id'               => $payload['user_id'],
            ]);

            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
