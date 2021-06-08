<?php

namespace App\Controller\Admin;

use App\Entity\Attendance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttendanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attendance::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            DateTimeField::new('arriveAt'),
            DateTimeField::new('leaveAt'),
            BooleanField::new('isPresent'),
            TextAreaField::new('absenceReason'),
        ];
    }
}
