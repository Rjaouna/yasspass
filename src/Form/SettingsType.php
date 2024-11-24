<?php

// src/Form/SettingsType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('theme', ChoiceType::class, [
			'choices' => [
				'Bleu light' => 'light',
				'Bleu' => 'bleu',
				'Default' => 'default',
				'Move' => 'move',
			],
			'label' => 'Choose a theme',
		]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([]);
	}
}
