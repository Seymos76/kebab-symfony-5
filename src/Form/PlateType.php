<?php

namespace App\Form;

use App\Entity\Plate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlateType extends AbstractType
{
    protected const TYPE_X_PDF = 'application/x-pdf';
    protected const TYPE_PDF = 'application/pdf';
    protected const TYPE_PNG = 'image/png';
    protected const TYPE_JPG = 'image/jpg';
    protected const TYPE_JPEG = 'image/jpeg';
    protected const TYPE_WEBP = 'image/webp';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('label')
            ->add('price')
            ->add('yourChoice')
            ->add('support')
            ->add('formula')
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Brochure (PDF file)',

                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,

                    // make it optional so you don't have to re-upload the PDF file
                    // every time you edit the Product details
                    'required' => false,

                    // unmapped fields can't define their validation using annotations
                    // in the associated entity, so you can use the PHP constraint classes
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypes' => [
                                self::TYPE_PNG,
                                self::TYPE_JPEG,
                                self::TYPE_JPG,
                                self::TYPE_WEBP
                            ],
                            'mimeTypesMessage' => 'Please upload a valid image',
                        ])
                    ],
                ]
            )
            ->add('extraCost')
        ;
    }

    public function setPlateSlug()
    {

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plate::class,
        ]);
    }
}
