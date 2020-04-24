<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
    $builder
        ->add('firstName')
        ->add('surname')
        ->add('group', EntityType::class, [
        // list objects from this class
            'class' => 'App:Group',
        // use the 'Category.name' property as the visible option string
            'choice_label' => 'name',
        ])
        ->add('save', SubmitType::class, array('label' => 'Create Student'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
