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
            $table->increments('user_id');
            $table->uuid('uuid');
            $table->char('nick_name', 100);
            $table->integer('group_id')->unsigned()->nullable();
            $table->char('email', 100)->nullable()->unique();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('full_name')->nullable();
            $table->char('about_me')->nullable();
            $table->char('social_id', 50);
            $table->char('social_provider', 50);
            $table->string('profile_url')->nullable();
            $table->tinyInteger('is_new_avatar')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('access')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
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
