<?php

namespace Alura\Cursos\Controller;

abstract class ViewController
{
    public function view(string $pathView, array $dados) : string
    {
        extract($dados);

        ob_clean();
        require  __DIR__ . '/../../view/' . $pathView;
        $html = ob_get_clean();

        return $html;
    }
}
