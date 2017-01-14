<?php

namespace BoardBundle\Controller;

use BoardBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends Controller {

    /**
     * @Route("/add_comment/{advertId}", name="add_comment")
     */
    public function newCommentAction(Request $req, $advertId) {
        $comment = new Comment();
        if ($this->getUser() !== null) {
            //setting logged user
            $comment->setUser($this->getUser());
        } else {
            //setting anonymous user
            $comment->setUser();
        }

        $form = $this->createFormBuilder($comment)
                ->setAction("/add_comment/{$advertId}")
                ->add("comment", "textarea", ['label' => 'Wpisz komentarz', 'attr' => ['class' => 'form-control']])
                //->add("advertisement", EntityType::class, ["label" => "Advertisement", "class" => "BoardBundle:Advertisement", "choice_label" => "id", 'attr' => ['class' => 'form-control']])
                ->add("Dodaj", "submit", ['attr' => ['class' => 'btn btn-primary']])
                ->getForm();


        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $comment = $form->getData();
            $comment->setAdvertisement($this->getDoctrine()->getRepository('BoardBundle:Advertisement')->find($advertId));
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($req->headers->get('referer'));
        }

        return $this->render("BoardBundle:Comment:newComment.html.twig", ["advertId" => $advertId, "form" => $form->createView()]);
    }

}
