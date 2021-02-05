<?php


namespace App\Form\Filter;


use App\Entity\Country;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\NumberFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ArtistsFilterType.php
 *
 * @author Kevin Tourret
 */
class ArtistsFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextFilterType::class, [
                'condition_pattern' => FilterOperands::STRING_CONTAINS,
            ])
            ->add('beginningYear', NumberFilterType::class)
            ->add('country', EntityFilterType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
            ])
        ;
    }

}
