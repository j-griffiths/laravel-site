<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('profile_user_id')->references('user_id')->on('profiles')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('like_id');
            $table->string('like_type');
            $table->primary(['profile_user_id', 'like_id', 'like_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
