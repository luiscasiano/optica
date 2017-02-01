<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('descripcion');
            $table->integer('valor');
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('ruc');
            $table->string('direccion')->nullable();
            $table->timestamps();
        });

        Schema::create('empresaslugares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            
            $table->timestamps();
        });

        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apepaterno',50);
            $table->string('apematerno',50);

            $table->timestamps();
        });

        Schema::create('trabajos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->dateTime('fechainicio');
            $table->dateTime('fechafin')->nullable();
            $table->timestamps();
        });


        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('trabajo_id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->integer('empresalugar_id')->unsigned();

            $table->foreign('trabajo_id')->references('id')->on('trabajos');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('empresalugar_id')->references('id')->on('empresaslugares');
            
            $table->dateTime('fechadiagnostico');
            $table->text('refraccionocular');
            $table->text('diagnosticovisual');
            $table->text('observaciones')->nullable();

            $table->boolean('pterigion');
            $table->string('pterigionobs')->nullable();
            $table->boolean('catarata');
            $table->string('catarataobs')->nullable();
            $table->boolean('ambliopia');
            $table->string('ambliopiaobs')->nullable();
            $table->boolean('estrabismo');
            $table->string('estrabismoobs')->nullable();



            $table->integer('tipolente_id')->unsigned();
            $table->foreign('tipolente_id')->references('id')->on('catalogo');
            
            $table->decimal('ll_od_esph')->nullable();
            $table->decimal('ll_od_cyl')->nullable();
            $table->decimal('ll_od_axis')->nullable();
            $table->decimal('ll_od_av')->nullable();
            $table->decimal('ll_od_diametro')->nullable();
            $table->decimal('ll_oi_esph')->nullable();
            $table->decimal('ll_oi_cyl')->nullable();
            $table->decimal('ll_oi_axis')->nullable();
            $table->decimal('ll_oi_av')->nullable();
            $table->decimal('ll_oi_diametro')->nullable();
            $table->decimal('ll_dip')->nullable();
            $table->decimal('lc_od_esph')->nullable();
            $table->decimal('lc_od_cyl')->nullable();
            $table->decimal('lc_od_axis')->nullable();
            $table->decimal('lc_oi_esph')->nullable();
            $table->decimal('lc_oi_cyl')->nullable();
            $table->decimal('lc_oi_axis')->nullable();
            $table->decimal('lc_dip')->nullable();
            $table->decimal('lc_add')->nullable();
            $table->decimal('lc_altura')->nullable();


            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::dropIfExists('diagnosticos');
        Schema::dropIfExists('trabajos');
        Schema::dropIfExists('personas');
        Schema::dropIfExists('empresaslugares');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('catalogo');

        
    }
}
