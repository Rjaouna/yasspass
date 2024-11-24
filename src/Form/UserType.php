<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('etablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => 'id',
                'multiple' => true,
            ]);

        // Ajoutez le champ 'password' seulement si l'utilisateur crée un nouveau compte
        if ($options['is_edit'] !== true) {
            $builder->add('password', PasswordType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Mot de passe'],
                'label' => 'Mot de passe',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false, // Valeur par défaut
        ]);
    }
}
