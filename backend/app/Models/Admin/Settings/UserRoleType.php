<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_role_types';

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
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'user_role_name',
        'user_role_description',
        'user_role_slug',
        'user_role_is_active',
    ];

    /**
    * The attributes that are mass assignable.
    *
    * @var string
    */
    protected $attributes = [
        'user_role_is_active' => false,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Eloquent relationship between user role types and users.
     *
     */
    public function users()
    {
        return $this->hasMany('App\Models\Admin\Settings\User');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active')->paginate(15);
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
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to order records in ascending or descending order.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function orderTableColumn($payload)
    {
        try
        {
            return $this->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active')
                        ->orderBy($payload['column_name'], $payload['order_type'])
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to filter the database table.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function filterTableColumn($payload)
    {
        try
        {
            if ($payload['column_name'] === 'user_role_name')
            {
                return $this->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active')
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
                            ->get();
            }
            else
            {
                return $this->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active')
                            ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                            ->get();
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
