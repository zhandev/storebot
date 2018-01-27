<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char("name");
            $table->char("email");
            $table->char("domain");
            $table->dateTimeTz('created_at');
            $table->char("province")->nullable();
            $table->char("country");
            $table->char("address1")->nullable();
            $table->char("zip")->nullable();
            $table->char("city")->nullable();
            $table->char("customer_email")->nullable();
            $table->char("phone")->nullable();
            $table->dateTimeTz("updated_at");
            $table->char("country_code")->nullable();
            $table->char("country_name")->nullable();
            $table->char("currency")->nullable();
            $table->char("shop_owner")->nullable();
            $table->char("money_format")->nullable();
            $table->char("plan_name")->nullable();
            $table->char("plan_display_name")->nullable();
            $table->char("myshopify_domain")->nullable();
            $table->char("money_in_emails_format")->nullable();
            $table->char("source")->nullable();
            $table->char("latitude")->nullable();
            $table->char("longitude")->nullable();
            $table->char("primary_locale")->nullable();
            $table->char("address2")->nullable();
            $table->char("timezone")->nullable();
            $table->char("iana_timezone")->nullable();
            $table->char("money_with_currency_format")->nullable();
            $table->char("weight_unit")->nullable();
            $table->char("province_code")->nullable();
            $table->char("taxes_included")->nullable();
            $table->char("tax_shipping")->nullable();
            $table->char("county_taxes")->nullable();
            $table->char("has_discounts")->nullable();
            $table->char("has_gift_cards")->nullable();
            $table->char("google_apps_domain")->nullable();
            $table->char("google_apps_login_enabled")->nullable();
            $table->char("money_with_currency_in_emails_format")->nullable();
            $table->char("eligible_for_payments")->nullable();
            $table->char("requires_extra_payments_agreement")->nullable();
            $table->char("password_enabled")->nullable();
            $table->char("has_storefront")->nullable();
            $table->char("eligible_for_card_reader_giveaway")->nullable();
            $table->char("finances")->nullable();
            $table->char("primary_location_id")->nullable();
            $table->char("setup_required")->nullable();
            $table->char("force_ssl")->nullable();

            $table->char("token");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
