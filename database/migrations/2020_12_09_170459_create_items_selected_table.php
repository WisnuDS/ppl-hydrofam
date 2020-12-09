<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsSelectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_selected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('quantity');
            $table->tinyInteger('status')->comment("1:cart, 2:checkout");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_id')->on('transactions')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('item_id')->on('items')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_selected');
    }
}
