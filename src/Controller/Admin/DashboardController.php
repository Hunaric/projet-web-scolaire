<?php

namespace App\Controller\Admin;

use App\Entity\Animaux;
use App\Entity\Categorie;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use function Symfony\Component\Translation\t;

// #[IsGranted('ROLE_ADMIN')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="https://i.ibb.co.com/1Gh8MrWx/pet-1.png" style="height:40px;"> PetBoost')
            ->setLocales([
                'fr' => 'Français',
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        // Animaux
        yield MenuItem::subMenu('Animaux', 'fa fa-box')->setSubItems([
            MenuItem::linkToCrud('Ajouter Catégorie Animal', 'fa fa-plus', Animaux::class)->setAction('new'),
            MenuItem::linkToCrud('Voir Animaux', 'fa fa-eye', Animaux::class),
        ]);
        // Categories
        yield MenuItem::subMenu('Categories', 'fa fa-shopping-cart')->setSubItems([
            MenuItem::linkToCrud('Ajouter Categorie', 'fa fa-plus', Categorie::class)->setAction('new'),
            MenuItem::linkToCrud('Voir Categories', 'fa fa-eye', Categorie::class),
        ]);        
        // Produits
        yield MenuItem::subMenu('Produits', 'fa fa-user')->setSubItems([
            MenuItem::linkToCrud('Ajouter Produit', 'fa fa-plus', Produit::class)->setAction('new'),
            MenuItem::linkToCrud('Voir Produits', 'fa fa-eye', Produit::class),
        ]); 
        yield MenuItem::linkToUrl('Retour au site', 'fa fa-arrow-left', '/');
    }
}
