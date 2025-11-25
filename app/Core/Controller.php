<?php
namespace App\Core;

class Controller {
    protected function view(string $template, array $data = []): void {
        View::render($template, $data);
    }
    protected function csrfField(): string { return '<input type="hidden" name="_token" value="'.htmlspecialchars(CSRF::token()).'">'; }
}
