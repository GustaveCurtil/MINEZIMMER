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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();            
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('open')->default(true);
            $table->string('code')->unique()->nullable();
            $table->boolean('write_read')->default(true);
            $table->string('color')->nullable();
            $table->string('bg_color')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
