<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CircuitRepository;

/**
 * @Route("/admin")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/reservations", name="admin_reservations", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        dump($reservationRepository->findAll());
        return $this->render('admin/reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
 }