<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;

use Doctrine\ORM\EntityManagerInterface;

class ListeCategoriesController extends AbstractController
{
    #[Route('/liste/categories', name: 'app_liste_categories')]
    public function index(): Response
    {
        return $this->render('liste_categories/index.html.twig', [
            'controller_name' => 'ListeCategoriesController',
        ]);
    }

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/categories", name="liste_categories")
     */
    public function listeCategories(EntityManagerInterface $entityManager): Response
    {
        // Utilise directement $entityManager pour accéder à l'Entity Manager
        $categories = $entityManager->getRepository(Categories::class)->findAll();

        return $this->render('liste_categories/liste_categories.html.twig', [
            'categories' => $categories,
        ]);
    }
}
