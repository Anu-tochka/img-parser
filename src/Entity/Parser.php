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
/*
	public function addition()
    {
        return $this->arg1 + $this->arg2;
    }

    public function subtraction()
    {
        return $this->arg1 - $this->arg2;
    }

    public function multiplication()
    {
        return $this->arg1 * $this->arg2;
    }

    public function division()
    {
        return $this->arg1 / $this->arg2;
    }
*/
}
