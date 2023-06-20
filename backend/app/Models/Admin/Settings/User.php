<?php

namespace App\Models\Admin\Settings;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\ApiLogError;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ApiLogError;

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
    protected $foreignKey = 'user_role_type_id';

    /**
     * The data type of the database table foreign key.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'first_name',
        'last_name',
        'nickname',
        'email',
        'password',
        'user_role_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * Eloquent relationship between users and accepted domains.
     *
     */
    public function accepted_domains()
    {
        return $this->hasMany('App\Models\Admin\Settings\AcceptedDomain');
    }

    /**
     * Eloquent relationship between users and errors and notifications.
     *
     */
    public function errors_and_notifications()
    {
        return $this->hasMany('App\Models\Admin\Settings\ErrorAndNotification');
    }

    /**
     * Eloquent relationship between users and user role types.
     *
     */
    public function user_role_type()
    {
        return $this->belongsTo('App\Models\Admin\Settings\UserRoleType');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select('id', 'full_name', 'nickname', 'email')->paginate(15);
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
                'full_name'         => $payload['full_name'],
                'first_name'        => $payload['first_name'],
                'last_name'         => $payload['last_name'],
                'nickname'          => $payload['nickname'],
                'email'             => $payload['email'],
                'password'          => bcrypt($payload['password']),
                'user_role_type_id' => $payload['user_role_type_id'],
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
                            'user_role_type' => function ($query) {
                                $query->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active');
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
                'full_name'         => $payload['full_name'],
                'first_name'        => $payload['first_name'],
                'last_name'         => $payload['last_name'],
                'nickname'          => $payload['nickname'],
                'email'             => $payload['email'],
                'password'          => bcrypt($payload['password']),
                'user_role_type_id' => $payload['user_role_type_id'],
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
     * SQL query to order records in ascending or descending order.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function orderTableColumn($payload)
    {
        try
        {
            return $this->select('id', 'full_name', 'nickname', 'email')
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
            if ($payload['column_name'] === 'type')
            {
                return $this->select('id', 'full_name', 'nickname', 'email')
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
                            ->get();
            }
            else
            {
                return $this->select('id', 'full_name', 'nickname', 'email')
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
