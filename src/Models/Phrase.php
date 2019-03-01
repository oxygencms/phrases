<?php

namespace Oxygencms\Phrases\Models;

use Oxygencms\Core\Models\Model;
use Spatie\Translatable\HasTranslations;

class Phrase extends Model
{
    use HasTranslations;

    /**
     * Attributes that should be mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'group', 'key', 'text',
    ];

    public $translatable = ['text'];

    public $appends = ['model_name'];

    /**
     * @param string $group
     * @param string $locale
     * @return array
     */
    public static function getGroup(string $group, string $locale = null)
    {
        $query = static::query()->where('group', $group);

        if (is_null($locale)) {
            return $query->pluck('text', 'key')->all();
        }

        return $query->get()->flatMap(function ($phrase) use ($locale) {
            return [$phrase->key => $phrase->getTranslation('text', $locale)];
        })->all();
    }
}
