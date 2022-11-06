<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('language_id');
            $table->char('title', 100);
            $table->string('description', 500);
            $table->text('content');
            $table->timestamps();
            $table->primary(['post_id', 'language_id']);

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('language_id')->references('id')->on('languages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('post_translations');
        Schema::enableForeignKeyConstraints();
    }
};
