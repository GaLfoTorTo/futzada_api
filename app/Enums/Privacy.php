<?php

namespace App\Enums;

enum Privacy: string
{
    case Public = 'Public';
    case Private = 'Private';

    public static function fromBool(bool $value): self
    {
        return $value ? self::Private : self::Public;
    }

    public function toBool(): bool
    {
        return $this === self::Private;
    }
}
