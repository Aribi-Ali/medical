<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wilaya as WilayaModel;

class wilaya extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:wilaya';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        WilayaModel::create([
            'name' => 'Alger',
            'zipcode' => 16000,
        ]);
        WilayaModel::create([
            'name' => 'Oran',
            'zipcode' => 31000,
        ]);
        WilayaModel::create([
            'name' => 'Constantine',
            'zipcode' => 25000,
        ]);
        WilayaModel::create([
            'name' => 'Annaba',
            'zipcode' => 23000,
        ]);
        WilayaModel::create([
            'name' => 'Tlemcen',
            'zipcode' => 13000,
        ]);
        WilayaModel::create([
            'name' => 'Batna',
            'zipcode' => 05000,
        ]);
        WilayaModel::create([
            'name' => 'Blida',
            'zipcode' => 9000,
        ]);
        WilayaModel::create([
            'name' => 'Setif',
            'zipcode' => 19000,
        ]);
        WilayaModel::create([
            'name' => 'Tizi Ouzou',
            'zipcode' => 15000,
        ]);
        WilayaModel::create([
            'name' => 'Skikda',
            'zipcode' => 21000,
        ]);
    }
}
