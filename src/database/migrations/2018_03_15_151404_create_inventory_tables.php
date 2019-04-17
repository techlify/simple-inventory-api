<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->unique();
            $table->string('measure');
            $table->integer("creator_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('inventory_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("item_id")->unsigned();
            $table->date('dated');
            $table->string('quantity');
            $table->integer('cost');
            $table->string('details');
            $table->integer("creator_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('inventory_outs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("item_id")->unsigned();
            $table->date('dated');
            $table->string('quantity');
            $table->string('details');
            $table->integer("creator_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('inventory_ins');
        Schema::dropIfExists('inventory_outs');
    }
}
