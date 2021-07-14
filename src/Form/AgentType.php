<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Country;
use App\Entity\Specialty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('date_of_birth', DateType::class, [
                'label' => 'Date de naissance',
                'years' => range(date('Y') - 100, date('Y')),
            ])
            ->add('id_code', TextType::class, [
                'label' => 'Code'
            ])
            ->add('nationality', EntityType::class, [
                'label' => 'Nationalité',
                'class' => Country::class,
                'choice_label' => 'nationality',
            ])
            ->add('specialty', EntityType::class, [
                'label' => 'Spécialité',
                'class' => Specialty::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
