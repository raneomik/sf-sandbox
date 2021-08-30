<?php

namespace App\Controller;

use App\Form\DefaultType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: 'default')]
class DefaultController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(DefaultType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('button', 'clicked ' . $form->getClickedButton()?->getName());
        }

        return $this->render('default.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}