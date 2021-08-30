<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DefaultType extends AbstractType
{
    public const BUTTON_ONE = 'firstButton';
    public const BUTTON_TWO = 'secondButton';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fieldOne')
            ->add('fieldTwo')
            ->add(self::BUTTON_ONE, SubmitType::class)
            ->add(self::BUTTON_TWO, SubmitType::class)
        ;
    }
}