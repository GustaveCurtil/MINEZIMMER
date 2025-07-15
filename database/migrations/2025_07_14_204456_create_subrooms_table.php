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
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('cascade');
            $table->foreignId('subroom_id')->nullable()->constrained('subrooms')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->integer('level');
            $table->string('color')->nullable();
            $table->string('bgColor')->nullable();
            $table->string('icon_path')->default('0-B/1_066.ICO');
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
