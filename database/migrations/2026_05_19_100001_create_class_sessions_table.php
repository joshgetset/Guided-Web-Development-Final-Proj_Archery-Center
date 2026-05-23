<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archery_class_id')->constrained()->cascadeOnDelete();
            $table->dateTime('starts_at');
            $table->unsignedSmallInteger('spots_available')->default(8);
            $table->timestamps();

            $table->index(['archery_class_id', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_sessions');
    }
};
