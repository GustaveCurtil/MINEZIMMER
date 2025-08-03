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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('subroom_id')->nullable()->constrained('subrooms')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->boolean('with_description')->default(true);
            $table->boolean('with_weblink')->default(true);
            $table->unique(['name', 'room_id', 'subroom_id']);
            $table->unique(['slug', 'room_id', 'subroom_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
