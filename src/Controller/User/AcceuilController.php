<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CircuitRepository;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
    	$circuits = $circuitRepository->findCircuitDisponible();
        return $this->render('acceuil/index.html.twig', [
            'circuits' => $circuits,
        ]);
    }
}
