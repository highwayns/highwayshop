<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('role_id')->unsigned();
            $table->string('name_kana',40);
            $table->string('creditcard_main_apikey',30)->nullable();
            $table->string('creditcard_denki_apikey',30)->nullable();
            $table->string('account_transfer_company_code',30);
            $table->string('smartcis_my_auth_id',128)->nullable();
            $table->string('smartcis_my_auth_key',128)->nullable();
            $table->string('vendor_denki_shop_code',2)->nullable();
            $table->datetime('updated_at');
            $table->integer('updated_user_id');
            $table->datetime('created_at');
            $table->integer('created_user_id');
            $table->string('gmo_main_site_id',30)->nullable();
            $table->string('gmo_main_site_pass',30)->nullable();
            $table->string('gmo_main_shop_id',30)->nullable();
            $table->string('gmo_main_shop_pass',30)->nullable();
            $table->string('gmo_denki_site_id',30)->nullable();
            $table->string('gmo_denki_site_pass',30)->nullable();
            $table->string('gmo_denki_shop_id',30)->nullable();
            $table->string('gmo_denki_shop_pass',30)->nullable();
            $table->string('aplus_bank_consignor_number',6)->nullable();
            $table->string('aplus_division',2)->nullable();
            $table->string('aplus_conveni_consignor_number',4)->nullable();
            $table->string('aplus_transfer_date',2)->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_sources');
    }
}
