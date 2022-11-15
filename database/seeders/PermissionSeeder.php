<?php

namespace Database\Seeders;



use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use \Spatie\Permission\Models\Role;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->delete();
        app()['cache']->forget('spatie.permission.cache');
        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        

        DB::table('permissions')->insert([  
            $this->create('user.*'),
            $this->create('user.index'),
            $this->create('user.store'),
            $this->create('user.update'),
            $this->create('user.show'),
            $this->create('user.create'),
            $this->create('user.edit'),
            $this->create('user.delete'),

            $this->create('product.*'),
            $this->create('product.index'),
            $this->create('product.store'),
            $this->create('product.update'),
            $this->create('product.show'),
            $this->create('product.create'),
            $this->create('product.edit'),
            $this->create('product.delete'),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        DB::commit();

        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo('user.*');
            $adminRole->givePermissionTo('user.index');
            $adminRole->givePermissionTo('user.create');
            $adminRole->givePermissionTo('user.update');
            $adminRole->givePermissionTo('user.show');
            $adminRole->givePermissionTo('user.delete');


            $adminRole->givePermissionTo('product.*');
            $adminRole->givePermissionTo('product.index');
            $adminRole->givePermissionTo('product.update');
            $adminRole->givePermissionTo('product.show');
            $adminRole->givePermissionTo('product.create');
            $adminRole->givePermissionTo('product.delete');
        }
        $userRole =  Role::where('name', 'User')->first();
        if ($userRole) {
            $userRole->givePermissionTo('product.index');
            $userRole->givePermissionTo('product.show');
        }
    }
    private function create($name): array
    {
        return [
            'name' => $name,
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

}
