<?php

namespace App\Form;

use App\Entity\Repas;
use App\Entity\Utilisateur;
use App\Entity\Zone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RepasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('periode')
            ->add('valide')
            ->add('idConsomateur', EntityType::class, [
                'class' => Utilisateur::class,
'choice_label' => 'id',
            ])
            ->add('idZone', EntityType::class, [
                'class' => Zone::class,
'choice_label' => 'id',
            ])
            ->add('modifier',SubmitType::class,['label'=>'Appuyer ici pour modifier']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Repas::class,
        ]);
    }
}
