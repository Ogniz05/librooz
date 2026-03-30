<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ADMIN =====
        DB::table('Utente')->insert([
            [
                'nome'     => 'Admin',
                'cognome'  => 'Librooz',
                'email'    => 'admin@librooz.it',
                'password' => Hash::make('admin123'),
                'telefono' => null,
                'localita' => null,
                'via'      => null,
                'civico'   => null,
                'cap'      => null,
            ],
        ]);

        DB::table('Admin')->insert([
            ['username' => 'admin', 'email' => 'admin@librooz.it'],
        ]);

        // ===== CATEGORIE =====
        DB::table('Categoria')->insert([
            ['nome_categoria' => 'Classici',  'descrizione' => 'Grandi classici della letteratura mondiale'],
            ['nome_categoria' => 'Storico',   'descrizione' => 'Romanzi ambientati in epoche storiche'],
            ['nome_categoria' => 'Fantasy',   'descrizione' => 'Mondi magici e avventure fantastiche'],
            ['nome_categoria' => 'Thriller',  'descrizione' => 'Suspense, misteri e colpi di scena'],
            ['nome_categoria' => 'Romantico', 'descrizione' => 'Storie d amore emozionanti'],
        ]);
    }
}