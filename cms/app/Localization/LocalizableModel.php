<?php

namespace App\Localization;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait LocalizableModel
{
    public function localizations(): HasMany
    {
        return $this->hasMany(static::LOCALIZATION_CLASS, static::LOCALIZATION_FK);
    }

    public static function localizationTable(): string
    {
        $className = static::LOCALIZATION_CLASS;

        return (new $className())->getTable(); // TODO: do this without instancing a new object?
    }

    public static function getLocalizationFields(): array
    {
        return self::$localizationFields;
    }
    
    public function parent(){
        
    }
    
    public function language(){
        
    }
}
