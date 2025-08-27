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
        Schema::create('team', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('name');
            $table->string('position');
            $table->string('thumbnail');
            $table->timestamps();
        });
    }
};
