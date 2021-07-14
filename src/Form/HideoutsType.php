<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\HideoutType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HideoutsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Code'
            ])
            ->add('address', TextType::class, [
                'label' => 'Addresse'
            ])
            ->add('country', EntityType::class, [
                'label' => 'Pays',
                'class' => Country::class,
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type',
                'class' => HideoutType::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hideout::class,
        ]);
    }
}
