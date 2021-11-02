<?php


use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

$url = $_SERVER['PATH_INFO'];

$rotas = require __DIR__ . '/../routes/web.php';

if (!array_key_exists($url, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$logins = [
    '/login',
    '/autenticar'
];

if (!isset($_SESSION['user_logado']) && !in_array($url, $logins)) {
    header('Location: /login', true, 302);
}

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();

$classController = $rotas[$url];


/**
 * @var \Psr\Container\ContainerInterface $container
 */
$container = require __DIR__ . '/../config/di.php';

/**
 * @var \Psr\Http\Server\RequestHandlerInterface $controller
 */
$controller = $container->get($classController);
$response = $controller->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
