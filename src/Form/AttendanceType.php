<?php

namespace App\Form;

use App\Entity\Attendance;
use App\Entity\User;
use App\EventListener\AttendanceListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AttendanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('checkedAt')
            ->add('status', HiddenType::class)
            ->add('isPresent')
            ->add('absenceReason')
            ->add('user', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Attendance::class,
        ]);
    }

}
