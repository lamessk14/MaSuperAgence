<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/option")
 */
class OptionController extends AbstractController
{
    /**
     * @var OptionRepository
     */
    private $property_repository;

    public function __construct(OptionRepository $option_repository)
    {
        $this->property_repository = $option_repository;
    }

    /**
     * @Route("/", name="option_index", methods={"GET"})
     * @param OptionRepository $option_repository
     * @return Response
     */
    public function index(OptionRepository $option_repository): Response
    {
        return $this->render('option/index.html.twig', [
            'options' => $this->property_repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="option_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('option_index');
        }

        return $this->render('option/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="option_show", methods={"GET"})
     * @param Option $option
     * @return Response
     */
    public function show(Option $option): Response
    {
        return $this->render('option/show.html.twig', [
            'option' => $option,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="option_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Option $option
     * @return Response
     */
    public function edit(Request $request, Option $option): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('option_index');
        }

        return $this->render('option/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="option_delete", methods={"DELETE"})
     * @param Request $request
     * @param Option $option
     * @return Response
     */
    public function delete(Request $request, Option $option): Response
    {
        if ($this->isCsrfTokenValid('delete' . $option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
        }

        return $this->redirectToRoute('option_index');
    }
}
