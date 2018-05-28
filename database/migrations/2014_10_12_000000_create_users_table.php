<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver_num')->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('country')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('postcode')->nullable();
            $table->text('telephone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_img')->nullable();
            $table->string('user_ip')->nullable();
            $table->string('commission_cal')->nullable();
            $table->enum('driver_status',[0,1])->default(0);
            $table->enum('active',[0,1])->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
