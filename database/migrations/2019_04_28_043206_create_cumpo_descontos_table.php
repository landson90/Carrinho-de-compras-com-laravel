<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCumpoDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumpo_descontos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('localizador')->unique();
            $table->decimal('desconto', 6, 2)->default(0);
            $table->enum('modo_desconto', ['valor', 'porc'])->default('porc');
            $table->decimal('limite', 6, 2)->default(0);
            $table->enum('modo_limite', ['valor', 'qdt'])->default('qdt');
            $table->dateTime('dthr_validade');
            $table->enum('ativo', ['S', 'N'])->dafault('S');
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
        Schema::dropIfExists('cumpo_descontos');
    }
}
