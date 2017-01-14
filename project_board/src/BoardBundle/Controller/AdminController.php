<?php

namespace BoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @Template
     */
    public function adminAction () {
        $repoComm = $this->getDoctrine()->getRepository('BoardBundle:Comment');
        $repoAdvert = $this->getDoctrine()->getRepository('BoardBundle:Advertisement');
        $repoCategory = $this->getDoctrine()->getRepository('BoardBundle:Category');
        $comments = $repoComm->findAll();
        $advertisements = $repoAdvert->findAll();
        $categories = $repoCategory->findAll();
        
        return ["comments" => $comments, "advertisements" => $advertisements, "categories" => $categories];
    }
}
