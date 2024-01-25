<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\RoutinesIcons;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines_icons', function (Blueprint $table) {
            $table->id();
            $table->string('title', 64)->unique();
            $table->timestamps();
        });

        // list all routines icons and 
        $files = Storage::disk('public')->files('routines_icon');
        RoutinesIcons::create(['title'=>'default.svg']);
        foreach($files as $file){
            $title = str_replace('routines_icon/','',$file);
            if($title !== 'default.svg') RoutinesIcons::create(['title'=>$title]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routines_icons');
    }
};
