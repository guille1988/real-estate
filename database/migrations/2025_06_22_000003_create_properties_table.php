<?php

declare(strict_types=1);

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
        Schema::create('properties', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('caption');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('type');
            $table->unsignedInteger('bathrooms');
            $table->unsignedInteger('bedrooms');
            $table->unsignedInteger('area');
            $table->unsignedInteger('price');
            $table->boolean('is_featured');
            $table->timestamps();
        });
    }
};
