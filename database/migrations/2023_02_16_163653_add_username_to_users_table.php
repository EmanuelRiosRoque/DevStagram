<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. Creando la columna de usuarios 
     */
    public function up(): void
    {
        // unique permite que que los nombre de usuario sean unicas 
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique(); // NO DEBE DE EXITIR REGISTROS DUBLICADSOS
        });
    }

    /**
     * Reverse the migrations. Estaria elimiando la columand de usuarios de la tabla 
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
