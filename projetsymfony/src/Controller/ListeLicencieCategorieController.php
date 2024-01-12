<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Licencies;
use Doctrine\ORM\EntityManagerInterface;

class ListeLicencieCategorieController extends AbstractController
{
    #[Route('/liste/licencie/categorie', name: 'app_liste_licencie_categorie')]
    public function index(): Response
    {
        return $this->render('liste_licencie_categorie/index.html.twig', [
            'controller_name' => 'ListeLicencieCategorieController',
        ]);
    }


    /**
     * @Route("/categorie/{categorieId}/licencies", name="lister_licencies_par_categorie")
     */
    public function listerLicenciesParCategorie(int $categorieId, EntityManagerInterface $entityManager): Response
    {
        $categorie = $entityManager->getRepository(Categories::class)->find($categorieId);
        $licencies = $entityManager->getRepository(Licencies::class)->findLicenciesByCategorie($categorieId);
        
        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie n\'existe pas.');
        }

        return $this->render('liste_licencie_categorie/liste_licencies_par_categorie.html.twig', [
            'categorie' => $categorie,
            'licencies' => $licencies,
        ]);
    }
}
