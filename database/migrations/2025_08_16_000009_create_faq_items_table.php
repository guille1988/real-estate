<?php

declare(strict_types=1);

use App\Models\Faq;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_items', function (Blueprint $table): void {
            $table->id();
            $table->uuid()->unique();
            $table->string('subtitle');
            $table->json('paragraphs');
            $table->foreignIdFor(Faq::class)->constrained();
            $table->timestamps();
        });
    }
};
