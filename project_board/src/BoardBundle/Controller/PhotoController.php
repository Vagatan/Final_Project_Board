<?php

namespace BoardBundle\Controller;

use BoardBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PhotoController extends Controller {

    /**
     * @Route("/add_photo/{advertId}", name="add_photo")
     */
    public function newPhotoAction(Request $req, $advertId) {

        $photo = new Photo ();

        $form = $this->createFormBuilder($photo)
                ->setAction("/add_photo/{$advertId}")
                ->add("imageFile", "file", ["label" => "Wybierz plik obrazka", 'attr' => ['class' => 'btn btn-default btn-file']])
                ->add("Dodaj", "submit", ['attr' => ['class' => 'btn btn-primary']])
                ->getForm();


        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $photo = $form->getData();
            $photo->setAdvertisement($this->getDoctrine()->getRepository('BoardBundle:Advertisement')->find($advertId));
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();
            return $this->redirect($req->headers->get('referer'));
        }

        return $this->render("BoardBundle:Photo:newPhoto.html.twig", ["advertId" => $advertId, "form" => $form->createView()]);
    }

}
