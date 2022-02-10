<?php

namespace Codecycler\Uuid\Concerns;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait HasUuid
{
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public static function bootUuid()
    {
        static::creating(function ($model) {
            if (empty($model->attributes[$model->getKeyName()])) {
                $uuid = $model->generateUuid();

                $model->attributes[$model->getKeyName()] = $uuid;
            }
        });
    }

    /**
     * Generate the UUID.
     *
     * @return string
     */
    protected function generateUuid()
    {
        return RamseyUuid::uuid4()
            ->toString();
    }
}