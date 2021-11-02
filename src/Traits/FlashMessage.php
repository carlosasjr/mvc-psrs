<?php

namespace Alura\Cursos\Traits;

trait FlashMessage
{
    public function flashMessage(string $message, ?string $type = 'success')
    {
        $_SESSION['message'] = $message;
        $_SESSION['type_message'] = $type;
    }
}
