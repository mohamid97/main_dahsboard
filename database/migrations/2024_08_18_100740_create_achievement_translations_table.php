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
        Schema::create('achievement_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('achivement_id');
            $table->string('locale')->index();
            $table->unique(['achivement_id', 'locale']);
            $table->string('name');
            $table->string('small_des')->nullable();
            $table->foreign('achivement_id')->references('id')->on('achievements')->onDelete('cascade');
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
        Schema::dropIfExists('achievement_translations');
    }
};
