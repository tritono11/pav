<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profilos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('i_user_id')->unsigned();
            $table->string('t_nome');
            $table->string('t_cognome');
            $table->string('t_sesso');
            $table->datetime('d_nascita');
            $table->string('t_stato_nascita');
            $table->string('t_regione_nascita');
            $table->string('t_provincia_nascita');
            $table->string('t_comune_nascita');
            $table->string('t_cf');
            $table->string('t_piva');
            $table->string('t_ci');
            $table->string('t_patente');
            $table->string('t_telefono');
            $table->string('t_indirizzo_res');
            $table->string('t_numero_civico_res');
            $table->string('t_cap_res');
            $table->string('t_stato_res');
            $table->string('t_regione_res');
            $table->string('t_provincia_res');
            $table->string('t_comune_res');
            $table->string('b_privacy');
            $table->datetime('d_privacy');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('i_user_id')
                            ->references('id')
                            ->on('users');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profilos');
    }
}
