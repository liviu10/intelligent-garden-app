<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Settings\UserRoleType;
use Carbon\Carbon;

class UserRoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        UserRoleType::truncate();
        $records = [
            [
                'id'                    => '1',
                'user_role_name'        => 'Webmaster',
                'user_role_description' => 'A user with access to the website network administration features and all other features that are included for the rest of the user role types (administrator, author, editor, contributor and subscriber).',
                'user_role_slug'        => 'webmaster',
                'user_role_is_active'   => '1',
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '2',
                'user_role_name'        => 'Administrator',
                'user_role_description' => 'A user with access to all the administration features withing a single website and all other features that are included for the rest of the user role types (author, editor, contributor and subscriber).',
                'user_role_slug'        => 'administrator',
                'user_role_is_active'   => '1',
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '3',
                'user_role_name'        => 'Accountant',
                'user_role_description' => 'Accountant is the user role for your accounting or bookkeeping staff. They will have the ability to enter journal entries, closing dates and password, access to the chart of accounts and all accountant/taxes and company financial reporting.',
                'user_role_slug'        => 'accountant',
                'user_role_is_active'   => '1',
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '4',
                'user_role_name'        => 'Sales',
                'user_role_description' => 'Sales is a role designed for the staff member that needs access to sales orders, sales receipts, sales reports, estimates, and all information in the customer list.',
                'user_role_slug'        => 'sales',
                'user_role_is_active'   => '1',
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '5',
                'user_role_name'        => 'Client',
                'user_role_description' => 'Assigned to new customers when they create an account on your website. This role is basically equivalent to that of a normal blog subscriber, but customers can edit their own account information and view past or current orders.',
                'user_role_slug'        => 'client',
                'user_role_is_active'   => '1',
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ];
        UserRoleType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
