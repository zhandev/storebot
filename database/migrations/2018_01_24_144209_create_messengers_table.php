<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messengers', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->char('first_name');
            $table->char('last_name');
            $table->char('profile_pic');
            $table->char('locale')->nullable();
            $table->char('timezone')->nullable();
            $table->char('gender')->nullable();
            $table->bigInteger('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messengers');
    }
}
