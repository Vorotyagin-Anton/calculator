<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class CustomTwigExtension extends AbstractExtension
{
    public function getTests(): array
    {
        return [
            new TwigTest('numeric', function ($value) { return  is_numeric($value); }),
        ];
    }
}