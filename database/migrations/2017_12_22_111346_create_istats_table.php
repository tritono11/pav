<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIstatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('istats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('t_codice_regione');
            $table->string('t_codice_cm');
            $table->string('t_codice_provincia');
            $table->string('t_codice_progressivo_comune');
            $table->string('t_codice_alfanumerico_comune');
            $table->string('t_denominazione_comune');
            $table->string('t_codice_ripartizione_geo');
            $table->string('t_ripartizione_desc');
            $table->string('t_denominazione_regione');
            $table->string('t_denominazione_cm');
            $table->string('t_denominazione_provincia');
            $table->string('b_capoluogo_provincia');
            $table->string('t_sigla_automobilistica');
            $table->string('t_codice_comune_numerico');
        });
        $path = database_path();
        DB::unprepared(file_get_contents( $path . DIRECTORY_SEPARATOR .'dump' . DIRECTORY_SEPARATOR . 'istats.sql' ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('istats');
    }
}
