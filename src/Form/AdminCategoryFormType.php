<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;


class AdminCategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameUk', TextType::class)
            ->add('nameRu', TextType::class)
            ->add('alias', TextType::class)
            ->add('orderNumber', TextType::class)
            ->add('parentId', TextType::class)
            ->add('save', SubmitType::class)
            ->add('create', SubmitType::class)
            ;
    }
}