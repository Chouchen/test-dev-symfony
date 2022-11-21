<?php

namespace App\Form;

use App\Entity\Commentaire;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Ajouter votre email',
                'attr' => [
                    'class' => 'email-form'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'votre pseudo',
                'attr' => [
                    'required' => 'true',
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
                ]
            ])
            ->add('titre', TextType::class, [
                'label' => 'titre de commentaire',
                'attr' => [
                    'class' => 'title',
                    'minlength' => 4
                ]
            ])
            ->add('contenu', CKEditorType::class, [
                'label' => 'contenu de commentaire',
                'attr' => [
                    'class' => 'email-form',
                    'minlength' => 100
                ]
            ])


            
            
            ->add('commenter' , SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
