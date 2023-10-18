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
	
	// очистка урла от лишних символов
    public function clearingURL()
    {
        if (strpos($this->url, '?')) {
			$pos = strpos($this->url, '?');
			$this->url = substr($this->url, 0, $pos);
		}
		if (preg_match('/\S.\S\\/\S/',$this->url)) {
			$search = substr($this->url, 8);
			$pos = strpos($search, '/');
			$this->url = substr($this->url, 0, $pos+8);
		}
		return $this->url;
    }

}
