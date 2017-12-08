<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Entity\User;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'input'],
                'label_attr' => ['class' => 'label']
            ])
            ->add('username', TextType::class, [
                'attr' => ['class' => 'input'],
                'label_attr' => ['class' => 'label']
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'           => PasswordType::class,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => ['class' => 'input'],
                    'label_attr' => ['class' => 'label']
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                    'attr' => ['class' => 'input'],
                    'label_attr' => ['class' => 'label']
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection'=>true,
        ]);
    }
}