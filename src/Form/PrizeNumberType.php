<?php

namespace App\Form;

use App\Entity\Prize;
use App\Entity\PrizeNumber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrizeNumberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', NumberType::class, [
                'label' => 'Numéro tiré',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Numéro tiré',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrizeNumber::class,
        ]);
    }
}
