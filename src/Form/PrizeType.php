<?php

namespace App\Form;

use App\Entity\Prize;
use App\Enum\WinningCondition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Titre du lot',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description du lot',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
            ->add('sort', IntegerType::class, [
                'label' => 'Ordre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ordre de passage',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
            ->add('winningCondition', EnumType::class, [
                'class' => WinningCondition::class,
                'label' => 'Condition de gain',
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
                'choice_label' => fn (WinningCondition $winningCondition) => $winningCondition->value,
                'attr' => [
                    'placeholder' => 'Condition de gain',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'required' => true,
                'currency' => 'EUR',
                'html5' => true,
                'attr' => [
                    'placeholder' => 'Prix du lot',
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
            'data_class' => Prize::class,
        ]);
    }
}
