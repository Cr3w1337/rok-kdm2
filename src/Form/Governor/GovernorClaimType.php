<?php


namespace App\Form\Governor;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image as ImageConstraint;

class GovernorClaimType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'image',
                FileType::class,
                [
                    'required' => false,
                    'label' => 'Governor Profile Screenshot',
                    'mapped' => false,
                    'constraints' => [
                        new ImageConstraint(['maxSize' => '10M'])
                    ],
                ]
            )
            ->add('submit', SubmitType::class)
        ;
    }
}