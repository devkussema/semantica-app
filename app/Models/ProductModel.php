<?php

declare(strict_types=1);

namespace App\Models;

use Semantica\Core\Database\Model;

/**
 * ProductModel model
 * 
 * @author Augusto Kussema
 * @since 28 de September de 2025
 */
class ProductModel extends Model
{
    /**
     * The table associated with the model
     */
    protected string $table = 'products';

    /**
     * The attributes that are mass assignable
     */
    protected array $fillable = [
        // Add your fillable attributes here
    ];

    /**
     * The attributes that should be hidden for serialization
     */
    protected array $hidden = [
        // Add hidden attributes here (e.g., passwords)
    ];

    /**
     * Get all Product records
     */
    public static function all(): array
    {
        return static::query()->get();
    }

    /**
     * Find Product by ID
     */
    public static function find(int $id): ?static
    {
        return static::query()->where('id', $id)->first();
    }

    /**
     * Create new Product
     */
    public static function create(array $attributes): static
    {
        $instance = new static();
        $instance->fill($attributes);
        $instance->save();
        return $instance;
    }
}