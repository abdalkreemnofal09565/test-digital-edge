<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        DB::table('roles')->delete();
        $admin = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'identifier' => 'admin@gmail.com',
            'password' => Hash::Make('admin123')
        ]);
        DB::table('roles')->insert([
            [
                'name'       => 'Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ], 
            [
                'name'       => 'User',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ], 
        ]);
        $admin->assignRole('Admin');
    }
}
