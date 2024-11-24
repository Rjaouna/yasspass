<?php

namespace App\Service;

class PromoCodeGenerator
{
	public function generate(): string
	{
		return strtoupper(bin2hex(random_bytes(4))); // Exemple : Génère un code promo comme "A1B2C3D4"
	}
}
