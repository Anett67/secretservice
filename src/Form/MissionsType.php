<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\Mission;
use App\Entity\Specialty;
use App\Entity\MissionType;
use App\Entity\MissionStatus;
use App\Entity\Target;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextType::class, [
                'label' => 'Déscription'
            ])
            ->add('code_name', TextType::class, [
                'label' => 'Code'
            ])
            ->add('start_date', DateType::class, [
                'label' => 'Date de début'
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin'
            ])
            ->add('country', EntityType::class, [
                'label' => 'Pays',
                'class' => Country::class,
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type',
                'class' => MissionType::class,
                'choice_label' => 'name'
            ])
            ->add('status', EntityType::class, [
                'label' => 'Status',
                'class' => MissionStatus::class,
                'choice_label' => 'name'
            ])
            ->add('specialty', EntityType::class, [
                'label' => 'Spécialités',
                'class' => Specialty::class,
                'choice_label' => 'name'
            ])
            ->add('Contact', EntityType::class, [
                'label' => 'Contact',
                'class' => Contact::class,
                'choice_label' => 'lastname',
                'multiple' => true
            ])
            ->add('Target', EntityType::class, [
                'label' => 'Cibles',
                'class' => Target::class,
                'choice_label' => 'lastname',
                'multiple' => true
            ])
            ->add('Hideout', EntityType::class, [
                'label' => 'Planques',
                'class' => Hideout::class,
                'choice_label' => 'code',
                'multiple' => true
            ])
            ->add('agent', EntityType::class, [
                'label' => 'Agents',
                'class' => Agent::class,
                'choice_label' => 'lastname',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
