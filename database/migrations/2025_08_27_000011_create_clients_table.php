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
        Schema::create('clients', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->unsignedInteger('since');
            $table->string('url');
            $table->string('company');
            $table->string('domain');
            $table->string('category');
            $table->string('opinion');
            $table->timestamps();
        });
    }
};
