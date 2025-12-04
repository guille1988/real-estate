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
        Schema::create('inquiries', function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('message')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->foreignIdFor(Property::class)->constrained();
            $table->timestamps();
        });
    }
};
