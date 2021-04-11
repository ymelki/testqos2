<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password',PasswordType::class)
            ->add('magasin')
            ->add('prenom',TextType::class, array(
                'attr' => array('value' => 'XXXX')))
            ->add('nom',TextType::class, array(
                'attr' => array('value' => 'XXXX')))
            ->add('Adresse')
            ->add('cp')
            ->add('ville')
            ->add('tel',TextType::class, array(
                'attr' => array('value' => '0199999999')))
            ->add('Code_client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
