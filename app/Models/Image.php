<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Image extends Model
{
    /** @use HasFactory<ImageFactory> */
    use HasFactory, HasUuids;

    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // @pest-arch-ignore-line
    {
        return ['is_default' => 'boolean'];
    }

    /**
     * Get the field to use on route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Get the fields which will be unique.
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
