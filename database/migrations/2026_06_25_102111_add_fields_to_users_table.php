<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('isAdmin')
                ->default(false)
                ->after('password');

            $table->date('datum_rod')
                ->nullable()
                ->after('isAdmin');

            $table->decimal('placa', 10, 2)
                ->default(0)
                ->after('datum_rod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn([
                'isAdmin',
                'datum_rod',
                'placa'
            ]);
        });
    }
};
