<?php

namespace BoardBundle\Controller;

use BoardBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentController extends Controller {

    public function createNewComment() {
        $comment = new Comment ();

        $form = $this->createFormBuilder($comment)
                ->setAction($this->generateUrl("comment_add"))
                ->setMethod("POST")
                ->add("comment", "text")
                ->add("user", EntityType::class, ["label"=>"User", "class" => "BoardBundle:User", "choice_label" => "username"])
                ->add("advertisement", EntityType::class, ["label"=>"Advertisement", "class" => "BoardBundle:Advertisement", "choice_label" => "id"])
                ->add("Dodaj", "submit")
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
            return new Response("<html><body>OK</body></html>");
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
