<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->boolean('published')->default(false);
			$table->boolean('private')->default(true);
			$table->string('title', 125)->nullable(false);
			$table->string('slug', 255)->nullable(false);
			$table->string('description', 255)->nullable();
			$table->text('content')->nullable();
			$table->unsignedBigInteger('link_id')->nullable();
			$table->foreign('link_id')->references('id')->on('links');
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('pages');
    }
}
