<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{

    /**
     * @var CountryRepository
     */
    private CountryRepository $countryRepository;

    /**
     * ArtistType constructor.
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('name')
//            ->add('beginningYear')
//            ->add('country')
//        ;
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('beginningYear', NumberType::class, [
                'label' => 'Année de début',
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choices' => $this->countryRepository->findAll(),
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
