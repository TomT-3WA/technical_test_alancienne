<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $image = ImageField::new('image')
            ->setUploadDir('public/uploads')
            ->setLabel('Image');

        $fields = [
            TextField::new('title'),
            MoneyField::new('price_duty_free')->setCurrency('EUR'),
            PercentField::new('TVA')->setNumDecimals(2),
            IntegerField::new('max_stock_available'),
        ];

        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_EDIT) {
            $fields[] = $image;
        }

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplate('layout', 'bundles\EasyAdminBundle\layout.html.twig');
    }
}
