<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Type;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,

            [   'label'=>false,
                'attr' => [
                'placeholder' => 'Nom'
            ]
            ]
            )
            ->add('prenom',TextType::class , [
                'label'=> false,
                'attr'=> [
                    'placeholder'=>"Prénom"
                ]
            ])
            ->add('dateNaissance',BirthdayType::class,['label'=> false])
            ->add('moyen', NumberType::class,[
                'label'=> false,
                'constraints' => [new Type(['type' => 'float', 'message' => 'veuillez saisir des valeur  valides SVP !'])],
                'attr'=>[
                    'placeholder'=>"Moyen",
                    'step' => 'any'
                ]
            ])
            ->add('classe', EntityType::class,[
                'class'=>Classe::class,
                'choice_label' => 'ClasseName',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
