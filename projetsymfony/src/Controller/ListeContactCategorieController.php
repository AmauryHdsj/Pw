<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categories;
use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;

class ListeContactCategorieController extends AbstractController
{
    #[Route('/liste/contact/categorie', name: 'app_liste_contact_categorie')]
    public function index(): Response
    {
        return $this->render('liste_contact_categorie/index.html.twig', [
            'controller_name' => 'ListeContactCategorieController',
        ]);
    }

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/categorie/{categorieId}/contacts", name="lister_contacts_par_categorie")
     */
    public function listerContactsParCategorie(int $categorieId): Response
    {
                // Récupère la catégorie spécifique
                $categorie = $this->entityManager->getRepository(Categories::class)->find($categorieId);
                $contacts = $this->entityManager->getRepository(Contacts::class)->findContactsByCategorie($categorieId);
                // Vérifie si la catégorie existe
                if (!$categorie) {
                    throw $this->createNotFoundException('La catégorie n\'existe pas.');
                }
        
                // Passe les données à la vue
                return $this->render('liste_contact_categorie/liste_contacts_par_categorie.html.twig', [
                    'categorie' => $categorie,
                    'contacts' => $contacts,
                ]);
    }
}
