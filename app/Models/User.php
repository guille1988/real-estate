<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 *  @property-read string $uuid
 *  @property-read string $name
 *  @property-read string $email
 *  @property-read CarbonImmutable|null $email_verified_at
 *  @property-read string $password
 *  @property-read string|null $thumbnail
 *  @property-read bool $is_admin
 *  @property-read CarbonImmutable|null $created_at
 *  @property-read CarbonImmutable|null $updated_at
 */
final class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // @pest-arch-ignore-line
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the field to use on route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /*
     * Returns null because we don't use
     * remember token functionality.
     */
    public function getRememberToken(): ?string
    {
        return null;
    }

    /**
     * Get the fields from which will be unique.
     *
     * @return list<string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /**
     * Checks if the user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /*
     * Returns the user thumbnail or
     * the placeholder if there is none.
     */
    public function getThumbnail(): string
    {
        return Storage::disk('users')
            ->url($this->thumbnail ?? $this->getPlaceholder());
    }

    /*
     * Returns the placeholder image.
     */
    public function getPlaceholder(): string
    {
        return 'thumbnails/placeholder.jpeg';
    }
}
