<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Settings
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private ?int $id = null;

	#[ORM\Column(type: 'string', length: 255)]
	private ?string $fieldName = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getFieldName(): ?string
	{
		return $this->fieldName;
	}

	public function setFieldName(string $fieldName): self
	{
		$this->fieldName = $fieldName;

		return $this;
	}
}
