<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\TypeEtablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Logo ou façade du restaurant'
            ])
            ->add('typeEtablissement', EntityType::class, [
                'class' => TypeEtablissement::class,
                'choice_label' => 'nom',
                'placeholder' => '',
                'required' => true,
                'label' => false,
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Nom de l\'établissement'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est obligatoire',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])
            ->add('address', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Adresse de l\'établissement'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse est obligatoire',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])
            ->add('phone', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Numéro de téléphone'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le numéro de téléphone est obligatoire',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le numéro de téléphone doit comporter au moins {{ limit }} caractères',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Adresse email'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse email est obligatoire',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse email valide',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])
            ->add('description', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Description de l\'établissement'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'La description est obligatoire',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])

            ->add('promo_code', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Code promotionnel'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le code promotionnel est obligatoire',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])

            ->add('type', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'Type d\'établissement'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le type d\'établissement est obligatoire',
                    ]),
                ],
                'label' => false,  // Pas de label
            ])
            ->add('promo', TextType::class, [
                'required' => true,
                'attr' => ['placeholder' => 'promo'],

                'label' => false,  // Pas de label
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
