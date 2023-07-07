<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

use App\Repository\CategoryRepository;

class AdminSiteFormType extends AbstractType
{

    function __construct(
        private CategoryRepository $categoryService) 
    {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $allCategories = $this->categoryService->findAll();
        $choices = [];
        $choices[''] = 0;

        foreach ($allCategories as $category) {
            $choices[$category->getName('uk')] = $category->getId();            
        }

        $builder
            ->add('name', TextType::class)
            ->add('domain', TextType::class)
            ->add('email', TextType::class)
            ->add('categoryId', ChoiceType::class, [
                'choices'  => $choices,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => '15', 'maxlength' => '4096'],
            ])
            ->add('delete', SubmitType::class)
            ->add('save', SubmitType::class)
            ->add('invoice', SubmitType::class)
            ->add('add', SubmitType::class)
        ;
    }
}