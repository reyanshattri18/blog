<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(['email' => 'admin@mail.com'],[
            'name' => 'Admin', 
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role2 = Role::firstOrCreate(['name' => 'author']);
     
        $permissions = Permission::pluck('id','id')->all();
        $permissions2 = Permission::where('name' , 'post-list')->orWhere('name' , 'post-create')->pluck('id','id')->all();

        $role2->syncPermissions($permissions2);
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
