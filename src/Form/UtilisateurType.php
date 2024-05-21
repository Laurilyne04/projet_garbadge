<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            ->add('nom')
            ->add('prenom')
            ->add('motDePasse')
            ->add('dateInscription')
            ->add('fonction')
            ->add('roles',EntityType::class,[
                'class' => Role::class,
                'choice_label' => 'libelle',
                 'multiple' => true,
                 'expanded' => true,
            ])
            ->add('valider',SubmitType::class,['label'=>'Valider']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
