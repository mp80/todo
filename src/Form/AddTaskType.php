<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,  [
                'attr' => [
                    'style' => 'width: 400px; float:right;',

                ]
            ])
            ->add('author', TextType::class, [
                'attr' => [
                    'style' => 'width: 400px; float:right;'
                ]
            ])
            ->add('Save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
