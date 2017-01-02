<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Rate;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_POST)
            ->add('technical', ChoiceType::class, [
                'choices' => Rate::getRange(),
            ])
            ->add('adrenaline', ChoiceType::class, [
                'choices' => Rate::getRange(),
            ])
            ->add('originality', ChoiceType::class, [
                'choices' => Rate::getRange(),
            ])
            ->add('comment', TextareaType::class)
            ->add('rate', SubmitType::class, ['label' => 'Rate']);
    }
}
