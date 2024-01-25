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
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('type_id');
            $table->bigInteger('icon_id')->default(0);                               
            $table->string('title')->default('Untitled');
            $table->string('color')->default('#5185E4');
            $table->string('filter_color')->default('invert(46%) sepia(67%) saturate(1503%) hue-rotate(200deg) brightness(95%) contrast(89%)');
            $table->string('description',60)->default('No Description');            
            $table->bigInteger('max_val')->default(1);                         
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
        Schema::dropIfExists('routines');
    }
};
