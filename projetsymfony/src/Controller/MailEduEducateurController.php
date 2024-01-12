<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EducateursRepository;
use App\Repository\MailEduRepository;

class MailEduEducateurController extends AbstractController
{

    private MailEduRepository $mailEduRepository;
    private  EducateursRepository $educateursRepository;


    public function  __construct(
        EducateursRepository $educateursRepository, MailEduRepository $mailEduRepository){
        $this->mailEduRepository=$mailEduRepository;
        $this->educateursRepository=$educateursRepository;

    }

    #[Route('/mail/edu/educateurs', name: 'app_mail_edu_educateurs')]
    public function index(): Response
    {
        $userId = $this->getUser()->getId();
        $mails = $this->mailEduRepository->getEduById($userId);
        return $this->render('mail_educateur/index.html.twig', ["mails" => $mails]);
    }


    #[Route(path: '/mail/send', name: 'app_send_mail_educateur')]
    public function sendMailEducateur(Request $request): Response {
        $educateurs = $this->educateursRepository->findAll();
        $form = $this->createFormBuilder()->add('objet', TextType::class, [
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
                'choices' => $educateurs,
                'choice_label' => 'email',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => false,
            ])->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mail  = new MailEdu();
            $mail->setObjet($data['objet']);
            $mail->setMessage($data['message']);
            $now = new DateTime();
            $mail->setDateEnvoi($now);
            $userId = $this->getUser()->getId();
            $expediteur = $this->educateursRepository->findOneBy(['id'=> $userId]);
            $mail->setExpediteur($expediteur);
            foreach ($data['destinataire'] as $value) {
                $mail->addDestinataire($value);
            }
            $this->mailEduRepository->add($mail);
            return $this->redirectToRoute('app_mail_educateur');
        }
        return $this->render('mail_educateur/addMessageEducateur.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route(path: '/mail/delete', name: 'app_delete_mail_educateur')]
    public function deleteMailEducateur(Request $request): Response {
        $id = $request->query->get('id');
        $this->mailEduRepository->delete($id);
        return $this->redirectToRoute('app_mail_educateur');
    }


}