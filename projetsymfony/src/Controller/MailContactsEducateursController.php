<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use DateTime;
use App\Entity\MailContact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactsRepository;
use App\Repository\EducateursRepository;
use App\Repository\CategoriesRepository;
use App\Repository\MailContactRepository;


class MailContactsEducateursController extends AbstractController
{


    private MailContactRepository $mailContactRepository;
    private ContactsRepository $contactRepository;
    private  EducateursRepository $educateursRepository;
    private CategoriesRepository $categorieRepository;



    public function  __construct(CategoriesRepository $categorieRepository,EducateursRepository $educateursRepository,MailContactRepository $mailContactRepository,ContactsRepository $contactRepository){
        $this->mailContactRepository=$mailContactRepository;
        $this->contactRepository=$contactRepository;
        $this->categorieRepository=$categorieRepository;
        $this->educateursRepository=$educateursRepository;
    }

    #[Route('/mail/contacts/educateurs', name: 'app_mail_contacts_educateurs')]
    public function index(): Response
    {
        $userId = $this->getUser()->getId();
        $mails = $this->mailContactRepository->findContact($userId);
        return $this->render('mail_contacts_educateurs/index.html.twig', [
            'mails' => $mails,
        ]);

    }



    #[Route('/mail/contact/delete', name: 'app_mail_contact_delete')]
    public function deleteMailEducateur(Request $request): Response {
        $id=$request->query->get('id');
        $this->mailContactRepository->delete($id);
        return $this->redirectToRoute('app_mail_edu_educateurs');
    }

    #[Route(path: '/mail/contact/send', name: 'app_send_mail_contact')]
    public function add(Request $request): Response {
        $categories = $this->categorieRepository->findAll();
        $form = $this->createFormBuilder()
            ->add('objet', TextType::class, [
                'label' => 'Objet: ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Objet...',
                ]])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message: ',
                'attr' => [
                    'placeholder' => 'Entrer votre message ici..',
                ]])
            ->add('destinataire', ChoiceType::class, [
                'label' => 'Destinataire: ',
                'choices' => $categories,
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => false,
            ])->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mail  = new MailContact();
            $mail->setObjet($data['objet']);
            $mail->setMessage($data['message']);
            $now = new DateTime();
            $mail->setDateDenvoie($now);
            $userId = $this->getUser()->getId();
            $expediteur = $this->educateursRepository->findOneBy(['id'=> $userId]);
            $mail->setExpediteur($expediteur);
            foreach ($data['destinataire'] as $categorie) {
                $contacts = $this->contactRepository->findContactsByCategorie($categorie->getId());
                foreach ($contacts as $value) {
                    $mail->addDestinataire($value);
                }
            }
            $this->mailContactRepository->add($mail);
            return $this->redirectToRoute('app_mail_contacts_educateurs');
        }

        return $this->render('mail_contacts_educateurs/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

}