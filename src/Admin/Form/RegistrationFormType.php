<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Admin\Form;

use App\Admin\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usernameCanonical', EmailType::class, [
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'İsim Soyisim'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email Adresi'
                ],
            ])
            ->add('username', null, [
                'label' => false,
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Kullanıcı Adı'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => [
                        'autocomplete' => 'new-password'
                    ],
                ],
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Şifre',
                        'class' => 'form-control',
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Şifre Tekrarı',
                        'class' => 'form-control',
                    ]
                ],
                'invalid_message' => 'fos_user.password.mismatch',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'csrf_token_id' => 'registration',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_registration';
    }
}
