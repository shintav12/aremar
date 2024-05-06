<?php

namespace App\Localization;

use App\Models\BaseModel;
use App\Models\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property BaseModel $parent
 * @property int       $language_id
 * @property Language  $language
 */
trait Localization
{
    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(
            static::LOCALIZED_CLASS,
            constant(static::LOCALIZED_CLASS . '::LOCALIZATION_FK')
        );
    }

    /**
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
