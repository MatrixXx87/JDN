<?php

namespace App\Form;

use App\Entity\Jeux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class JeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {           
        $builder
            ->add('title',null,[
                'label'=>'Nom du jeu'
                ])
            ->add('imageFile', FileType::class, [
                'required' => false
                ])
            ->add('description',null,[
                'label'=>'Descriptif'
                ])
            ->add('joueursmini',null,[
                'label'=>'Nb de joueurs mini'
                ])
            ->add('joueursmaxi',null,[
                'label'=>'Nb de joueurs maxi'
                ])
            ->add('timegame',null,[
                'label'=>'Temps de jeu (min)'
                ])
            ->add('agemini',null,[
                'label'=>'Age requis'
                ])
            ->add('contenuboite',null,[
                'label'=>'Contenu de la boite'
                ])
            ->add('regledujeu',null,[
                'label'=>'Regles du jeu'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jeux::class,
        ]);
    }
}
