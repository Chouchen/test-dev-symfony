<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Ajouter votre email',
                'attr' => [
                    'placeholder' => 'exemple@gmail.fr', 
                    'class' => 'email-form'
                ]
            ])
            ->add('nom',TextType::class, [
                'label' => 'votre pseudo',
                'attr' => [
                    'required' => 'true',
                    'placeholder' => 'Nom & prénom', 
                    'class' => 'pseudo-form'
                ]
            ])
            ->add('note', IntegerType::class, [
                'label' => 'la note',
                'attr' => [
                    'class' => 'note-form',
                    'min' => 1,
                    'max' => 5,
                    'step' => 1
                ],
                'data' => 1
            ])
            ->add('titre', TextType::class, [
                'label' => 'titre de commentaire',
                'attr' => [
                    'placeholder' => 'titre', 
                    'class' => 'title',
                    'minlength' => 4
                ]
            ])
            ->add('contenu',TextType::class, [
                'label' => 'votre commentaire',
                'attr' => [
                    'placeholder' => 'commentaire', 
                    'required' => 'true',
                    'class' => 'content-form'
                ]
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
            'post' => null,
        ]);
    }
}
