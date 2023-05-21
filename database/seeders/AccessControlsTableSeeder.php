<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class AccessControlsTableSeeder extends Seeder
{


    public function run()
    {
        $dev = User::where('email', 'systemadmin@gmail.com')->first();

        if (empty($dev)) {

            $data = [
                [
                    'id'=>'1',
                    'name' => 'System Admin',
                    'email' => 'systemadmin@gmail.com',
                    'mobile' => '01700000000',
                    'status' => '1',
                    'user_type' => 'systemadmin',
                    'password' => bcrypt('123456'),
                ],
                [
                    'id'=>'2',
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'mobile' => '01800000000',
                    'status' => '1',
                    'user_type' => 'user',
                    'password' => bcrypt('123456'),
                ]
            ];

            User::insert($data);
        }
    }
}
