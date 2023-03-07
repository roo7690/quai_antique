<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class Inscrip_Connexion extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=>'Nom',
                'attr'=>[
                    'class'=>'form',
                    'onfocus'=>'inlabel(event)',
                    'onfocusout'=>'offlabel(event)',
                    'onload'=>'load_label(event)'
                ]
            ])
            ->add('lastname',TextType::class, [
                'label'=>'Prénom',
                'attr'=>[
                    'class'=>'form',
                    'onfocus'=>'inlabel(event)',
                    'onfocusout'=>'offlabel(event)',
                    'onload'=>'load_label(event)'
                ]
            ])
            ->add('email',EmailType::class, [
                'label'=>'Email',
                'attr'=>[
                    'class'=>'form',
                    'onfocus'=>'inlabel(event)',
                    'onfocusout'=>'offlabel(event)',
                    'onload'=>'load_label(event)'
                ]
            ])
            ->add('password',PasswordType::class, [
                'label'=>'Mot de passe',
                'attr'=>[
                    'class'=>'form',
                    'onfocus'=>'inlabel(event)',
                    'onfocusout'=>'offlabel(event)',
                    'onload'=>'load_label(event)'
                ]
            ])
        ;
    }
}