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
        Schema::create('curiosities', function (Blueprint $table) {
            $table->id();
            $table->string('text', 60);

            $table->foreignId('weapon_id')->constrained(
                table: 'weapons',
                column: 'id',
                indexName: 'curiosity_weapon'
            )->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curiosities');
    }
};
