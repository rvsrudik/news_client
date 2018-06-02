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
			$table->string('email');
			$table->string('password');
			$table->string('name')->nullable();;
			$table->string('lastname')->nullable();;
			$table->string('country')->nullable();;
			$table->string('city')->nullable();;
			$table->string('phone')->nullable();;
			$table->date('birthday')->nullable();;
			$table->json('news_sources')->nullable();;
			$table->boolean('confirmed')->default(0);
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
