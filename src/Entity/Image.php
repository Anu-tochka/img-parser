<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Image
{
    private string $src;

	public function getSRC(): string
    {
        return $this->src;
    }

    public function setSRC(string $src): static
    {
        $this->src = $src;
        return $this;
    }

    public function pictureURL($url)
    {
		$s = $this->src;
		if (!strstr($s, 'http')) {
			
			$this->src = $url.$s;
		}
		return $this->src;
    }
}
