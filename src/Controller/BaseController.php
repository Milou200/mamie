<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AjoutCafeType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cafe;
use Doctrine\ORM\EntityManagerInterface;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_acceuil')]
    public function index(Request $request): Response
    {
        return $this->render('base/index.html.twig', [
            
        ]);
    }
    #[Route('/noscafes', name: 'app_noscafes')]
public function cafes(Request $request, EntityManagerInterface $em): Response
{
    $cafe = new Cafe();
    $form = $this->createForm(AjoutCafeType::class,$cafe);

    if($request->isMethod('POST')){
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($cafe);
            $em->flush();
            $this->addFlash('notice','Message envoyé');
            return $this->redirectToRoute('app_noscafes');
        }
        }
return $this->render('base/noscafes.html.twig', [
    'form' => $form->createView()
]);
}
}
