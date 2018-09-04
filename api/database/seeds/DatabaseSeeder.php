<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(TipoUsuarioSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}

class TipoUsuarioSeeder extends Seeder {

    public function run()
    {
        DB::table('tipos_usuario')->insert([
        	['desc' => 'Invocador'], 
        	['desc' => 'Juiz'], 
        	['desc' => 'Organizador']
        ]);
        // DB::table('tipos_usuario')->insert(['desc' => 'Juiz']);
        // DB::table('tipos_usuario')->insert(['desc' => 'Organizador']);
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array('email' => 'foo@bar.com', 'password' => bcrypt(12345678), 'tipo_usuario_id' => 1));
    }

}
