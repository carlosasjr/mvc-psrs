<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AlterarCurso extends ViewController implements RequestHandlerInterface
{

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dados = $request->getQueryParams();

        if (!$id = filter_var($dados['id'], FILTER_VALIDATE_INT)) {
            return new Response(302, ['Location' => '/listar-cursos']);
        }

        /**
         * @var Curso $curso
         */
        $curso = $this->repository->find($id);
        $title = 'Alterar Curso ' . $curso->getDescricao();

        $view = $this->view('cursos/formulario.php', compact('title', 'curso'));

        return new Response(200, [], $view);
    }
}
