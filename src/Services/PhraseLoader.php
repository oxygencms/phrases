<?php

namespace Oxygencms\Phrases\Services;

use Oxygencms\Phrases\Models\Phrase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;

class PhraseLoader extends FileLoader
{
    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $phrases = Cache::tags('phrases')
                       ->remember("phrases.{$locale}.{$group}", 60, function () use ($group, $locale) {
                           return Phrase::getGroup($group, $locale);
                       });

        $translations = parent::load($locale, $group, $namespace);

        return array_merge($translations, $phrases);
    }
}
