<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    
    #[Route(name: 'index')]
    public function index(): Response
    {
        $path = $this->getParameter('realisation_image');
        $projects = $this->projectRepository->findProjectHome();

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'path' => $path
        ]);
    }
}
