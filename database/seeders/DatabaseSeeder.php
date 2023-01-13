<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    #tabelas que serão apagadas
    protected $toTruncate = ['categories'];
    public function run() {
        #limpa as tabelas
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        #executa o seeder
        $this->call(CategorySeeder::class);

        Model::reguard();
    }

}
