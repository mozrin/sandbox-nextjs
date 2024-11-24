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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('handle')->unique();
            $table->string('intro');
            $table->text('bio');
            $table->unsignedTinyInteger('gender'); // 1, 2, or 3
            $table->date('birthday');
            $table->string('city');
            $table->string('country');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('photo4')->nullable();
            $table->string('photo5')->nullable();
            $table->string('photo6')->nullable();
            $table->string('photo7')->nullable();
            $table->string('photo8')->nullable();
            $table->string('photo9')->nullable();
            $table->string('photo10')->nullable();
            $table->string('photo11')->nullable();
            $table->string('photo12')->nullable();
            $table->string('photo13')->nullable();
            $table->string('photo14')->nullable();
            $table->string('photo15')->nullable();
            $table->string('photo16')->nullable();
            $table->string('photo17')->nullable();
            $table->string('photo18')->nullable();
            $table->string('photo19')->nullable();
            $table->string('photo20')->nullable();
            $table->unsignedTinyInteger('photo_default')->default(0); // 0 to 20
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
        Schema::dropIfExists('profiles');
    }
}
