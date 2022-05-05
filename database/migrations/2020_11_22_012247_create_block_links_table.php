<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_links', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('block_id');
			$table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
			$table->unsignedBigInteger('page_id')->nullable(true);
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
			$table->unsignedBigInteger('user_id')->nullable(true);
			$table->unsignedBigInteger('position')->default(0);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->string('url')->nullable(false);
            $table->timestamps();

			$table->index(['block_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_links');
    }
}
