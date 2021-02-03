<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'country.form.name.label',
            ])
            ->add('nationality', TextType::class, [
                'label' => 'country.form.nationality.label',
                'constraints' => [
                    new NotBlank([
                        'message' => 'country.form.nationality.error_not_blank',
                    ]),
                    new Length([
                        'minMessage' => 'country.form.nationality.error_length',
                        'min' => 3,
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
            // Si jamais vous travaillez sur plusieurs fichiers de traduction
            'translation_domain' => 'messages',
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
