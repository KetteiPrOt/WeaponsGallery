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
        Schema::create('main_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');

            $table->foreignId('weapon_id')->unique()->constrained(
                table: 'weapons',
                column: 'id',
                indexName: 'main_image_weapon'
            )->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_images');
    }
};
