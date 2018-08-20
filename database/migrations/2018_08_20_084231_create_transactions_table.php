<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('group_hu_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('house_id');
            $table->text('description')->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('location')->nullable();
            $table->boolean('is_calculated')->default('0');
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
        Schema::dropIfExists('transactions');
    }
}
