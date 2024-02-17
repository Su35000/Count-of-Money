<?php

namespace App\Controller;
use App\Entity\CryptoCurrency;
use App\Entity\User;
use App\Repository\CryptoCurrencyRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/api')]
class ApiCryptoCurrencyController extends AbstractController
{

    #[Route('/crypto-currencies', name: 'api_crypto_currencies', methods: ['GET'], priority: 10)]
    public function index(CryptoCurrencyRepository $cryptoCurrencyRepository): Response
    {
        $user = $this->getUser();
        $cryptoCurrencies = $cryptoCurrencyRepository->findAllByUserId($user->getId());
        $cryptoCurrenciesArray = [];
        foreach ($cryptoCurrencies as $cryptoCurrency) {
            $cryptoCurrenciesArray = [
                'id' => $cryptoCurrency->getId(),
                'name' => $cryptoCurrency->getName(),
            ];
        }
        return $this->json( $cryptoCurrenciesArray
        , Response::HTTP_OK);
    }

    #[Route('/crypto-currency', name: 'api_crypto_currency_create', methods: ['POST'], priority: 10)]
    public function create(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // every cryptoCurrency created is linked to the user who created it
        $user = $security->getUser();

        $data = json_decode($request->getContent(), true);

        $cryptoCurrency = new CryptoCurrency();
        $cryptoCurrency->setName($data['name']);
        $cryptoCurrency->setUser($user);

        $entityManager->persist($cryptoCurrency);
        $entityManager->flush();

        return $this->json([
            "message" => "CryptoCurrency have been created",
            "id" => $cryptoCurrency->getId(),
            "name" => $cryptoCurrency->getName()
        ], Response::HTTP_CREATED);
    }

    #[Route('/crypto-currency/{id}', name: 'api_crypto_currency_delete', methods: ['DELETE'], priority: 10)]
    public function delete(CryptoCurrency $cryptoCurrency, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($cryptoCurrency);
        $entityManager->flush();

        return $this->json([
            "message" => "CryptoCurrency have been deleted"
        ], Response::HTTP_OK);
    }
}