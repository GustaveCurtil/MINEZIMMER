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
        Schema::create('subrooms', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('subroom_id')->nullable()->constrained('subrooms')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->integer('level');
            $table->string('color')->nullable();
            $table->string('bg_color')->nullable(); 
            $table->unique(['name', 'room_id', 'subroom_id']);      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subrooms');
    }
};
