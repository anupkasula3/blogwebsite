<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'termsandcondition',
        'privacypolicy',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'string', $group = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group
            ]
        );
    }

    public static function getGroup($group)
    {
        return static::where('group', $group)->get()->pluck('value', 'key');
    }

    public static function getWebsiteSettings()
    {
        return static::getGroup('website');
    }

    public static function getContactSettings()
    {
        return static::getGroup('contact');
    }

    public static function getSocialSettings()
    {
        return static::getGroup('social');
    }

    public static function getSeoSettings()
    {
        return static::getGroup('seo');
    }

    // Add helpers for termsandcondition and privacypolicy
    public static function getTermsAndCondition()
    {
        return static::query()->value('termsandcondition');
    }
    public static function setTermsAndCondition($content)
    {
        static::query()->update(['termsandcondition' => $content]);
    }
    public static function getPrivacyPolicy()
    {
        return static::query()->value('privacypolicy');
    }
    public static function setPrivacyPolicy($content)
    {
        static::query()->update(['privacypolicy' => $content]);
    }
}
