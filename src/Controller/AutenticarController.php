<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Traits\FlashMessage;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AutenticarController implements RequestHandlerInterface
{
    use FlashMessage;

    /**
     * @var \Doctrine\ORM\EntityRepository|\Doctrine\Persistence\ObjectRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Usuario::class);
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formData = $request->getParsedBody();

        if (!$email = filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flashMessage('Email inválido', 'danger');

            return new Response(200, ['Location: /login']);
        }

        /**
         * @var Usuario $usuario
         */
        $usuario = $this->repository->findOneBy(['email' => $email]);

        $senha = filter_var($formData['password'], FILTER_SANITIZE_STRING);

        if (!$usuario || !$usuario->senhaEstaCorreta($senha)) {
            $this->flashMessage('Senha ou e-mail inválidos', 'danger');
            return new Response(302, ['Location' => 'login']);
        }

        $_SESSION['user_logado'] = $usuario;

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}
