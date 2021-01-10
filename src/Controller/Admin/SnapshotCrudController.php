<?php

namespace App\Controller\Admin;

use App\Entity\OfficerNote;
use App\Entity\Role;
use App\Entity\Snapshot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SnapshotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Snapshot::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Snapshot')
            ->setEntityLabelInPlural('Snapshots')
            ->setSearchFields(['id', 'uid', 'name']);
    }

    public function configureFields(string $pageName): iterable
    {
        $governorSnapshots = AssociationField::new('governorSnapshots');
        $uid = TextField::new('uid');
        $name = TextField::new('name');
        $created = DateTimeField::new('created');
        $completed = DateTimeField::new('completed');

        if (Crud::PAGE_INDEX === $pageName) {
            yield $name;
            yield $uid;
            yield $created;
            yield $governorSnapshots;
            yield $completed;
        }

        if ($this->isGranted(Role::ROLE_SUPERADMIN)) {
            yield $uid;
            yield $completed;
        }
        yield $name;
        yield $governorSnapshots;
    }

    public function createEntity(string $entityFqcn)
    {
        $snapshot = new Snapshot();
        $snapshot->setCreated(new \DateTime);

        return $snapshot;
    }
}