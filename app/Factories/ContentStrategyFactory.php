<?php

namespace App\Factories;


use InvalidArgumentException;

class ContentStrategyFactory {
  const STRATEGIES = [
        'podcast' => PodcastStrategy::class, 
        'audiobook' => AudiobookStrategy::class,
    ];

    public static function create(string $type)
    {
        if (!isset(self::STRATEGIES[$type])) {
            throw new InvalidArgumentException("النوع غير مدعوم");
        }

        return app()->make(self::STRATEGIES[$type]); 
    }
}