<?php

namespace xGrz\LarSet\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use xGrz\LarSet\Enums\SettingFieldTypeEnum;
use xGrz\LarSet\Exceptions\AppSettingsNotFoundException;

class Setting extends Model
{
    protected $guarded = [];
    protected $casts = [
        'type' => SettingFieldTypeEnum::class,
    ];

    /**
     * @throws AppSettingsNotFoundException
     */
    static public function read($key)
    {
        $keyFound = self::where('key', $key)->first();
        if (!$keyFound) throw new AppSettingsNotFoundException('Setting key ' . $key . ' not exists');
        return $keyFound->value;
    }

    protected function key(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value)
        );
    }

    protected function value(): Attribute
    {
        return Attribute::make(
            fn($value) => self::convertAttributeToValue($value),
            fn($value) => self::convertAttributeToDatabase($value)
        );
    }

    private function convertAttributeToValue($value): array|string|int
    {
        if ($this->type === SettingFieldTypeEnum::Selectable) {
            $value = json_decode($value, true);
            $value = array_unique($value);
            sort($value);
        }
        return $value;
    }

    private function convertAttributeToDatabase($value): array|string|int
    {
        if ($this->type === SettingFieldTypeEnum::Selectable) {
            $value = array_unique($value);
            sort($value);
            $value = json_encode($value);
        }
        return $value;
    }

}
