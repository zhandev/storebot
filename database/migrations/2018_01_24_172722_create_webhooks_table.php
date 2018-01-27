<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->bigInteger('shop_id')->unique();
            $table->boolean('order')->default(true);
            $table->boolean('customer')->default(true);
            $table->boolean('fulfillment')->default(true);
            $table->boolean('fulfillment_event')->default(true);
            $table->boolean('order_transaction')->default(true);
            $table->boolean('cart')->default(true);
            $table->boolean('draft_order')->default(true);
            $table->boolean('checkout')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
}
