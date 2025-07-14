<?php

declare(strict_types=1);

use App\Models\Property;
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
        Schema::create('pricing_details', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('category');
            $table->unsignedInteger('price');
            $table->foreignIdFor(Property::class)->constrained();
            $table->timestamps();
        });
    }
};
