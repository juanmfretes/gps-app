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
        Schema::create('localizaciones', function (Blueprint $table) {
            $table->id();
            // $table->string('imei', 10);
            $table->double('lat', 10, 8); // lat: [-90, +90]
            $table->double('lng', 11, 8);   // lng: [-180, +180] 
            $table->float('speed', 4, 2);
            $table->dateTime('fechaHora');
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
        Schema::dropIfExists('localizaciones');
    }
};
