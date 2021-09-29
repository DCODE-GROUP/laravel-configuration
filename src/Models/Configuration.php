<?php

namespace Dcodegroup\LaravelConfiguration\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configurations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($configuration) {

            if (empty($configuration->key)) {
                $configuration->key = Str::slug($configuration->name, '_');
            }
        });
    }

    public function configurable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeByKey(Builder $query, string $value): Builder
    {
        return $query->where('key', $value);
    }

    public function scopeByGroup(Builder $query, string $value): Builder
    {
        return $query->where('group', $value);
    }
}
