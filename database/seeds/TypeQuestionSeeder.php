<?php

use Illuminate\Database\Seeder;

class TypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            \Illuminate\Support\Facades\DB::table('type_questions')->insert([
                 'nom_type_question'=>"Choix unique",
            ]);
        \Illuminate\Support\Facades\DB::table('type_questions')->insert([
            'nom_type_question'=>"Choix multiple",
        ]);

    }
}
