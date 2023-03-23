<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class Reserver extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('name',textType::class)
            ->add('couvert',integerType::class)
            ->add('enfant',integerType::class)
            ->add('date',textType::class)
            ->add('hour',textType::class)
            ->add('email',textType::class)
            ->add('jour',integerType::class)
        ;
    }

}