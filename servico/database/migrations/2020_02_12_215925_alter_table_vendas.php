<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendedor_id');
            $table->bigInteger('veiculo_id');
            $table->bigInteger('cliente_id');    
            $table->timestamps();
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
            $table->foreign('vendedor_id')
                ->references('id')
                ->on('vendedores');
            $table->foreign('veiculo_id')
                ->references('id')
                ->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dorpIfExists('vendas');
 
    }
}
