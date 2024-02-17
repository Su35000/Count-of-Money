<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use DateTime;

#[Route('/api')]
class ApiArticleController extends AbstractController
{
    #[Route('/articles', name: 'api_articles', methods: ['GET'], priority: 10)]
    public function index(ArticleRepository $articleRepository): Response
    {
        $user = $this->getUser();
        $articles = $articleRepository->findAllByUserId($user->getId());

        return $this->json([
            'articles' => $articles,
        ], Response::HTTP_OK);
    }

    #[Route('/article', name: 'api_article_create', methods: ['POST'], priority: 10)]
    public function create(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // every article created is linked to the user who created it
        $user = $security->getUser();

        $data = json_decode($request->getContent(), true);

        $article = new Article();
        $article->setTitle($data['title']);
        $article->setUrlPage($data['urlArticle']);
        if (array_key_exists('urlImage', $data)) {
            $article->setUrlImage($data['urlImage']);
        }
        $article->setSummary($data['summary']);
        $article->setSource($data['source']);
        $dateTime = new DateTime($data['date']);
        $article->setDate($dateTime);
        $article->setUser($user);

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json([
            "message" => "Article have been created",
            "article" => $article
        ], Response::HTTP_CREATED);
    }

    #[Route('/article/{id}', name: 'api_article_update', methods: ['PUT'], priority: 10)]
    public function update(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $article->setTitle($data['title']);
        $article->setUrlPage($data['urlArticle']);
        $article->setUrlImage($data['urlImage']);
        $article->setSummary($data['summary']);
        $article->setSource($data['source']);
        $dateTime = new DateTime($data['date']);
        $article->setDate($dateTime);

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json([
            "message" => "Article have been updated",
            "article" => [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "urlArticle" => $article->getUrlPage(),
                "urlImage" => $article->getUrlImage(),
                "summary" => $article->getSummary(),
                "source" => $article->getSource(),
                "date" => $article->getDate()
            ]
        ], Response::HTTP_OK);
    }

    #[Route('/article/{id}', name: 'api_article_delete', methods: ['DELETE'], priority: 10)]
    public function delete(Article $article, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->json([
            "message" => "Article have been deleted",
        ], Response::HTTP_OK);
    }

    #[Route('/article/{id}', name: 'api_article_show', methods: ['GET'], priority: 10)]
    public function show(Article $article): Response
    {
        return $this->json([
            'article' => $article,
        ], Response::HTTP_OK);
    }
}