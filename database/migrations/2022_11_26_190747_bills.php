<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->bigInteger('address_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->double('amount');
            $table->double('is_paid')->default('0');
            $table->date('due_date')->nullable();
            $table->date('date_paid')->nullable();
            $table->double('amount_paid')->default('0');
            $table->integer('period')->default('1');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('bill_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
