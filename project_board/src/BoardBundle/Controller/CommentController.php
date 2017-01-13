<?php

namespace BoardBundle\Controller;

use BoardBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentController extends Controller {

    public function createNewComment() {
        
        $comment = new Comment ();
        if ($this->getUser() !== null) {
            $comment->setUser($this->getUser());
            $comment->setAdvertisement();
        } else {
            $comment->setUser();
            $comment->setAdvertisement();
        }

        $form = $this->createFormBuilder($comment)
                ->setAction($this->generateUrl("comment_add"))
                ->setMethod("POST")
                ->add("comment", "textarea", ['label' => 'Wpisz komentarz', 'attr' => ['class' => 'form-control']])
                ->add("advertisement", EntityType::class, ["label" => "Advertisement", "class" => "BoardBundle:Advertisement", "choice_label" => "id", 'attr' => ['class' => 'form-control']])
                ->add("Dodaj", "submit", ['attr' => ['class' => 'btn btn-primary']])
                ->getForm();
        return $form;
    }

    /**
     * @Route("/commtest/")
     * 
     * 
     */
    public function newCommentAction() {

        $form = $this->createNewComment();

        return $this->render("BoardBundle:Comment:newComment.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/createcomm/", name="comment_add")
     * @Method("POST")
     */
    public function addNewCommentAction(Request $req) {
        
        $form = $this->createNewComment();
        $form->handleRequest($req);

        if ($form->isSubmitted()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($req->headers->get('referer'));
        } else {
            return $this->render("BoardBundle:Comment:newComment.html.twig", ["form" => $form->createView()]);
        }
    }

    /**
     * @Route("/allcoms")
     * @Template
     */
    public function showAllCommentsAction() {
        $repo = $this->getDoctrine()->getRepository('BoardBundle:Comment');
        $comments = $repo->findAll();
        return ["comments" => $comments];
    }

}
