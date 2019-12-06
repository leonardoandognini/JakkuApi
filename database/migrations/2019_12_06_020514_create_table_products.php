<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('product_name');
            $table->text('description');
            $table->boolean('status');
            $table->decimal('sale_price', 10,2);
            $table->decimal('cost_price', 10,2);
            $table->integer('quantity');
            $table->integer('minimum_quantity');
            $table->decimal('weight', 4,3);
            $table->string('ncm',8);
            $table->string('cst_pis',3);
            $table->string('cst_cofins',3);
            $table->decimal('pis_percentage',6,4);
            $table->decimal('cofins_percentage',6,4);
            $table->string('cfop',4);
            $table->string('ean', 13);
            $table->string('slug');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
