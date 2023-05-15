<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username');
            $table->bigInteger('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->set('account_type',[1,2])->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->set('status',[0,1])->default(1);
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
