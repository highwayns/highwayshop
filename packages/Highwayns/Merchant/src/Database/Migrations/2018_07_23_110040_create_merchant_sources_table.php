<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_sources', function (Blueprint $table) {
            $table->increments('id')->comment('製造者ID');
            $table->integer('vendor_id')->comment('ベンダーID');
            $table->integer('merchant_group_id')->comment('製造者グループID');
            $table->string('name', 50)->comment('製造者名');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('role_id')->unsigned();
            $table->string('postal_code', 8)->comment('郵便番号');
            $table->integer('pref')->comment('都道府県');
            $table->string('city', 50)->comment('市町村');
            $table->string('address', 100)->comment('番地');
            $table->string('building_name', 100)->nullable()->comment('建物名');
            $table->string('tel', 20)->comment('電話番号');
            $table->string('fax', 20)->nullable()->comment('FAX番号');
            $table->string('agency_denki_shop_code', 5)->nullable()->comment('SmartCIS製造者ID');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_user_id')->comment('作成ユーザーID');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_user_id')->comment('更新ユーザーID');
            $table->boolean('del_flg')->default(false);
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
        Schema::dropIfExists('merchant_sources');
    }
}
