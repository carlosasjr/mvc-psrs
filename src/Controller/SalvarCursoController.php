<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Traits\FlashMessage;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarCursoController implements RequestHandlerInterface
{
    use FlashMessage;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dados = $request->getParsedBody();

        $curso = new Curso();
        $curso->setDescricao(filter_var($dados['descricao'], FILTER_SANITIZE_STRING));

        $id = filter_var($dados['id'], FILTER_VALIDATE_INT);

        if (!is_null($id) && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->flashMessage('Curso atualizado com sucesso');
        } else {
            $this->entityManager->persist($curso);
            $this->flashMessage('Curso inserido com sucesso');
        }
        $_SESSION['type_message'] = 'success';

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}
