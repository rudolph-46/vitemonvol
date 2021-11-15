<?php

namespace App\Controller\Admin;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Form\Circuit1Type;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/circuits")
 */
class CircuitController extends AbstractController
{
    /**
     * @Route("/", name="admin_circuit_index", methods={"GET"})
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        return $this->render('admin/circuit/index.html.twig', [
            'circuits' => $circuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($circuit);
            $entityManager->flush();

            return $this->redirectToRoute('admin_circuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_circuit_show", methods={"GET"})
     */
    public function show(Circuit $circuit): Response
    {
        return $this->render('admin/circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        dump($circuit);

        $form = $this->createForm(Circuit1Type::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->persist($circuit);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_circuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_circuit_delete", methods={"POST"})
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            dump($circuit);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($circuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_circuit_index', [], Response::HTTP_SEE_OTHER);
    }
}
