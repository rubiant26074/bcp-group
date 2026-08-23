<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'label',
        'value',
        'type',
    ];

    /**
     * Get a setting value by its key.
     *
     * @param string $key
     * @param mixed $default
     * @return string|null
     */
    public static function get(string $key, $default = null): ?string
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by its key.
     *
     * @param string $key
     * @param string|null $value
     * @return void
     */
    public static function set(string $key, ?string $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
