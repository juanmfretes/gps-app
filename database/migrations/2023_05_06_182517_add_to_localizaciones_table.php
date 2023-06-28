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
        Schema::table('localizaciones', function (Blueprint $table) {
            $table->foreignID('vehiculo_id')->constrained('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('localizaciones', function (Blueprint $table) {
            $table->dropForeign('localizaciones_vehiculo_id_foreign');
            $table->dropColumn('vehiculo_id');
        });
    }
};
