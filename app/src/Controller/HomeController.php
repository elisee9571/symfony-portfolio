<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    public function __construct(ProjectRepository $projectRepository, CategoryRepository $categoryRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    #[Route(name: 'index')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findThree();

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
