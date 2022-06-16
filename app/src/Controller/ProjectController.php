<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/realisations', name: 'project_')]
class ProjectController extends AbstractController
{

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    #[Route(name: 'index')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/{slug}', name: 'show')]
    public function show(Project $project): Response
    {
        $categories = $project->getCategory();

        return $this->render('project/show/show.html.twig', [
            'project' => $project,
            'categories' => $categories
        ]);
    }
}
