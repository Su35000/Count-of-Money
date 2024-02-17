<?php

namespace App\Controller;

use App\Entity\FluxRss;
use App\Entity\User;
use App\Repository\FluxRssRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Encoder\EncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/api')]
class ApiFluxRssController extends AbstractController
{
    #[Route('/fluxrss', name: 'api_fluxrss', methods: ['GET'], priority: 10)]
    public function index(FluxRssRepository $fluxRssRepository): Response
    {
        $fluxrss = $fluxRssRepository->findAll();
        return $this->json($fluxrss, Response::HTTP_OK);
    }

    #[Route('/fluxrss', name: 'api_fluxrss_create', methods: ['POST'], priority: 10)]
    #[IsGranted("ROLE_ADMIN")]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $fluxrss = new FluxRss();

        $fluxrss->setUrl($data['url']);
        $fluxrss->setSite($data['site']);
        $fluxrss->setTopique($data['topique']);
        $fluxrss->setCategorie($data['categorie']);
        $fluxrss->setLangue($data['langue']);

        $entityManager->persist($fluxrss);
        $entityManager->flush();

        return $this->json([
            "message" => "Flux RSS have been created",
            "flux_rss" => $fluxrss
        ], Response::HTTP_CREATED);
    }

    #[Route('/fluxrss/{id}', name: 'api_fluxrss_update', methods: ['PUT'], priority: 10)]
    public function update(Request $request, FluxRss $fluxrss, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $fluxrss->setUrl($data['url']);
        $fluxrss->setSite($data['site']);
        $fluxrss->setTopique($data['topique']);
        $fluxrss->setCategorie($data['categorie']);
        $fluxrss->setLangue($data['langue']);

        $entityManager->persist($fluxrss);
        $entityManager->flush();

        return $this->json([
            "message" => "Flux RSS have been updated",
            "flux_rss" => $fluxrss
        ], Response::HTTP_OK);
    }

    #[Route('/fluxrss/{id}', name: 'api_fluxrss_delete', methods: ['DELETE'], priority: 10)]
    public function delete(FluxRss $fluxrss, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($fluxrss);
        $entityManager->flush();

        return $this->json([
            "message" => "Fluxrss have been deleted",
        ], Response::HTTP_OK);
    }

    #[Route('/fluxrss/{id}', name: 'api_fluxrss_show', methods: ['GET'], priority: 10)]
    public function show(FluxRss $fluxrss): Response
    {
        return $this->json([
            "flux_rss" => $fluxrss
        ], Response::HTTP_OK);
    }
}