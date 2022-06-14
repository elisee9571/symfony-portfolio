<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/realisations', name: 'project_')]
class ProjectController extends AbstractController
{

    public function __construct(ProjectRepository $projectRepository, CategoryRepository $categoryRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->categoryRepository = $categoryRepository;
    }

    #[Route(name: 'index')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findAll();
        // $categories = $projects->getCategory();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
            // 'categories' => $categories,
        ]);
    }

    #[Route('/{slug}', name: 'show')]
    public function show(Project $project): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $project,
        ]);
    }
}
