<?php declare(strict_types=1);

namespace App\Enums;

enum OpinionType: string
{
    case Agree = 'agree';
    case Neutral = 'neutral';
    case Disagree = 'disagree';
}
