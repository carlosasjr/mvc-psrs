<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercaoController extends ViewController implements RequestHandlerInterface
{
    private $repository;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->repository = $entityManager->getRepository(Curso::class);
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $title = 'Novo Curso';
        $view = $this->view('cursos/formulario.php', compact('title'));

        return new Response(200, [], $view);
    }
}
