<?php

namespace App\Trait;

use Illuminate\Support\Facades\App;

trait HasLocaleValue
{
    protected mixed $fallbackLocale;

    public function __construct()
    {
        $this->fallbackLocale = config('app.locale', 'ar');
    }

    /**
     * Using match syntax against the following the text
     *
     * @param $attribute
     * @return mixed
     */
    public function getLocaleValue($attribute): mixed
    {
        $locale = App::getLocale();

        $value = $this->{"{$attribute}_{$locale}"};

        return $value ?: $this->{"{$attribute}_{$this->fallbackLocale}"};
    }
}
