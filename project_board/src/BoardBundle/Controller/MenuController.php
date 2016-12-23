<?php

namespace BoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class MenuController extends Controller
{
    /**
     * @Route("/")
     *
     */
    public function menuAction()
    {

        $categories = $this->getDoctrine()->getRepository("BoardBundle:Category")->findAll();


        return $this->render("BoardBundle:Menu:menu.html.twig", ["categories" => $categories]);
    }
}
