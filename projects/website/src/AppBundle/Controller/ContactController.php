<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Contact;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('reason', ChoiceType::class, [
                'choices' => Contact::getReasons(),
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Send'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = Swift_Message::newInstance()
                ->setSubject('Contact - ' . array_flip(Contact::getReasons())[$contact->getReason()])
                ->setFrom('mail@nolimits-exchange.com')
                ->setReturnPath('bounces@nolimits-exchange.com')
                ->setTo('thepixeldeveloper@googlemail.com')
                ->setReplyTo($contact->getEmail(), $contact->getName())
                ->setBody(
                    $this->renderView('AppBundle:Emails:contact.html.twig', ['message' => $contact->getMessage()]),
                    'text/html'
                );

            $this->get('mailer')->send($message);

            return $this->render('AppBundle:Contact:sent.html.twig');
        }

        return $this->render('AppBundle:Contact:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
