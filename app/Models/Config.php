<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];

    public static function value(string $key)
    {
        if (cache()->has($key)) {
            return cache($key);
        }

        return cache()->rememberForever($key, function () use ($key) {
            return (new static())::where('key', $key)->first()->value ?? null;
        });
    }

    public static function set($key, $value)
    {
        cache()->forget($key);

        return (new static())::updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );
    }
}
