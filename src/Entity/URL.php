<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Parser
{
    #[Assert\Regex(
        pattern: '/https?:\\/\S.\S/',
        match: true,
        message: 'Введите url',
    )]
    public $url;
}
