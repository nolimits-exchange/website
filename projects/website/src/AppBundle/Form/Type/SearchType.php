<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\SearchTypes;

class SearchType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_GET)
            ->add('term', TextType::class, ['required' => false])
            ->add('type', EntityType::class, [
                'class'        => 'AppBundle:SearchTypes',
                'placeholder'  => 'Coaster Type',
                'required'     => false,
                'choice_label' => function(SearchTypes $types) {
                    return $types->getNameWithCounts();
                },
                'group_by' => function(SearchTypes $types) {
                    return $types->getVersionAsString();
                },
            ])
            ->add('submit', SubmitType::class);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
