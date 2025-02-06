<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom de la partie',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de la partie',
                    'class' => FormTypeConstant::FORM_INPUT_CLASS,
                ],
                'label_attr' => [
                    'class' => FormTypeConstant::FORM_LABEL_CLASS,
                ],
            ])
            ->add('prizes', CollectionType::class, [
                'entry_type' => PrizeType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
