<?php

use App\Statu;
use Illuminate\Database\Seeder;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['EN ATTENTE REGLEMENT', 'RECU DAKAR', 'RECU PARIS', 'RECU USA', 'RECU CHINE', 'EN COURS DE LIVRAISON', 'LIVREE'];

        foreach($statuses as $status){
            Statu::create(['libelles' => $status]);
        }
    }
}
