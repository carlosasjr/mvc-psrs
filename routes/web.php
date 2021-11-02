<?php

use Alura\Cursos\Controller\{AlterarCurso,
    Api\CursosJSONController,
    Api\CursosXMLController,
    AutenticarController,
    ExcluirCursoController,
    FormularioInsercaoController,
    ListarCursoController,
    LoginController,
    LogoutController,
    SalvarCursoController};

return [
    '/listar-cursos' => ListarCursoController::class,
    '/novo-curso' => FormularioInsercaoController::class,
    '/salvar-curso' => SalvarCursoController::class,
    '/excluir-curso' => ExcluirCursoController::class,
    '/alterar-curso' => AlterarCurso::class,
    '/login' => LoginController::class,
    '/autenticar' => AutenticarController::class,
    '/logout'=> LogoutController::class,
    '/api/cursos-json' => CursosJSONController::class,
    '/api/cursos-xml' => CursosXMLController::class
];
