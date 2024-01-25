<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\RoutinesTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines_types', function (Blueprint $table) {
            $table->id();        
            $table->string('title')->default('Untitled');
        });
        RoutinesTypes::create(['title'=>'checklist']);
        RoutinesTypes::create(['title'=>'incremental']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routines_type');
    }
};
