<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Settings\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        $records = [
            [
                'id'                => '1',
                'full_name'         => 'User Webmaster',
                'first_name'        => 'User',
                'last_name'         => 'Webmaster',
                'nickname'          => 'webmaster',
                'email'             => 'webmaster@' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '1',
                'password'          => bcrypt('123@UserWebmaster'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '2',
                'full_name'         => 'User Administrator',
                'first_name'        => 'User',
                'last_name'         => 'Administrator',
                'nickname'          => 'administrator',
                'email'             => 'administrator@' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '2',
                'password'          => bcrypt('123@UserAdministrator'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '3',
                'full_name'         => 'User Accountant',
                'first_name'        => 'User',
                'last_name'         => 'Accountant',
                'nickname'          => 'accountant',
                'email'             => 'accountant@' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '3',
                'password'          => bcrypt('123@UserAccountant'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '4',
                'full_name'         => 'User Sales',
                'first_name'        => 'User',
                'last_name'         => 'Sales',
                'nickname'          => 'sales',
                'email'             => 'sales@' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '4',
                'password'          => bcrypt('123@UserSales'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '5',
                'full_name'         => 'User Client',
                'first_name'        => 'User',
                'last_name'         => 'Client',
                'nickname'          => 'client',
                'email'             => 'client@' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '5',
                'password'          => bcrypt('123@UserClient'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];
        User::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
