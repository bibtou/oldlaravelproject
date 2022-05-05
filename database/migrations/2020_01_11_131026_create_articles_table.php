<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->boolean('published')->default(false);
			$table->boolean('private')->default(true);
			$table->string('title', 125)->unique()->nullable(false);
			$table->string('slug', 255)->unique()->nullable(false);
			$table->string('description', 255)->nullable();
			$table->text('article')->nullable();
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedTinyInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories');
			$table->timestamp('displayed_at')->nullable(true);
            $table->timestamps();
			
			$table->index(['displayed_at', 'published', 'private']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
			$table->dropIndex(['displayed_at', 'published', 'private']);
        });
        Schema::dropIfExists('articles');
    }
}
