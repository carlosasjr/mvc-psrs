<?php

namespace Alura\Cursos\Controller;

class LogoutController implements ControllerInterface
{

    public function index()
    {
        session_destroy();

        header('Location: /login', true, 302);
    }
}
