<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $property_repository;

    public function __construct(PropertyRepository $property_repository)
    {
        $this->property_repository = $property_repository;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $properties = $this->property_repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/{id}", name="admin.property.edit")
     *
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property): Response
    {
        return $this->render('admin/property/edit.html.twig', compact('property'));
    }
}