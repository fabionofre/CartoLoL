<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

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
        $this->call(CampeonatoTableSeeder::class);
        $this->call(RodadaTableSeeder::class);
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
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array('email' => 'fabio@zleague.com', 'password' => bcrypt(123), 'tipo_usuario_id' => 1, 'foto' => 'faboka.jpg'));
    }

}

class CampeonatoTableSeeder extends Seeder {

    public function run() {

        DB::table('campeonatos')->insert([
            [
                'titulo' => 'CBLOL',
                'desc' => 'Circuito Brasileiro de League of Legends',
                'data_inicio' => new Carbon(),
                'criador_id' => 1,
                'fl_publico' => 1,
                'data_fim' => (new Carbon())->addWeeks(10),
                'fl_profissional' => 1,
                'brasao' => 'cblol.jpg'
            ]
        ]);
    }
}

class RodadaTableSeeder extends Seeder {

    public function run() {
        $today = Carbon::today();

        DB::table('rodadas')->insert([
            ['num_rodada' => 1, 'campeonato_id' => 1, 'data' => new Carbon()],
            ['num_rodada' => 2, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(1)],
            ['num_rodada' => 3, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(2)],
            ['num_rodada' => 4, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(3)],
            ['num_rodada' => 5, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(4)],
            ['num_rodada' => 6, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(5)],
            ['num_rodada' => 7, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(6)],
            ['num_rodada' => 8, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(7)],
            ['num_rodada' => 9, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(8)],
            ['num_rodada' => 10, 'campeonato_id' => 1, 'data' => (new Carbon())->addWeeks(9)],
        ]);
    }
}
