<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity')
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('product_id', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id',
            ])
            ->add('state', ChoiceType::class, [
                'choices' => [
                    'Non livré' => '1',
                    'En cours de livraison' => '2',
                    'Livré' => '3',
                ],
                'label' => 'Choisissez un état',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
