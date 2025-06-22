<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('path');
            $table->boolean('is_default');
            $table->foreignId('property_id')->constrained('properties');
            $table->timestamps();
        });
    }
};
