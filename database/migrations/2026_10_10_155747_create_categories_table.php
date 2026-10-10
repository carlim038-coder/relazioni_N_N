<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category; // <-- Importiamo il modello Category

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Popolamento automatico delle categorie come fatto a lezione dal prof
        $categories = ['Low Cost', 'Weekend', 'Zaino in spalla', 'Ostelli', 'Offerte Voli', 'Europa', 'Gite fuori porta', 'Consigli di viaggio' , 'Asia' , 'Viaggi avventura' , 'Viaggi di coppia'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};