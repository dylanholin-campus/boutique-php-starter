<?php

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['_flash'][$key] = $message;
        return null;
    }

    $msg = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $msg;
}

function view(string $template, array $data = []): void
{
    extract($data);

    $templateFile = __DIR__ . '/../views/' . $template . '.php';
    $layoutFile   = __DIR__ . '/../views/layout.php';

    ob_start();
    require $templateFile;
    $content = ob_get_clean();

    require $layoutFile;
}
