<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- Aggiungi questa riga

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Popolamento automatico dei tag con DB::table
        $tags = ['Low Cost', 'Weekend', 'Zaino in spalla', 'Ostelli', 'Offerte Voli', 'Europa', 'Gite fuori porta', 'Consigli di viaggio' , 'Asia' , 'Viaggi avventura' , 'Viaggi di coppia'];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};