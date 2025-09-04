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
        Schema::create('property_messages', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('location');
            $table->string('property_type');
            $table->string('budget');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }
};
