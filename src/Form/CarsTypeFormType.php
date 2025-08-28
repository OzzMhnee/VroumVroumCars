<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarsTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('circulationAt', null, [
                'widget' => 'single_text',
            ])
            ->add('DoorsNumber')
            ->add('isElectric')
            ->add('imgCar', \Symfony\Component\Form\Extension\Core\Type\FileType::class, [
                'label' => 'Image (JPG, PNG, etc.)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez ajouter une image valide (JPG, PNG, GIF).',
                    ])
                ],
            ])
            ->add('Brand_id', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
