<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagPayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_payables', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('payer_id');
            $table->unsignedInteger('receiver_id');
            $table->unsignedInteger('group_id');
            $table->decimal('amount_due', 8, 2);
            $table->boolean('is_paid');
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
        Schema::dropIfExists('tag_payables');
    }
}
