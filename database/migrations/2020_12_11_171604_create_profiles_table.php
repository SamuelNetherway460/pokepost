<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('profileable_type');
            $table->integer('profileable_id');
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('profile_image');
            $table->string('cover_image');
            $table->string('phone_number');
            $table->string('favorite_pokemon');

            // Foreign Keys:
            $table->bigInteger('user_id')->unsigned();

            // References:
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
