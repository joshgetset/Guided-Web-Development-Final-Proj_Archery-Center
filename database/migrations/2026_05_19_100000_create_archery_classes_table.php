<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archery_classes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('badge');
            $table->string('name');
            $table->text('short_description');
            $table->text('full_description');
            $table->text('prerequisites');
            $table->string('price_label');
            $table->unsignedInteger('price_cents')->default(0);
            $table->string('image_url')->nullable();
            $table->json('gallery')->nullable();
            $table->unsignedSmallInteger('duration_minutes')->default(60);
            $table->string('cta_text')->default('View Class');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archery_classes');
    }
};
