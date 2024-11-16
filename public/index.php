<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Exception\HttpNotFoundException;
require __DIR__ . '/../vendor/autoload.php';

// Instantiate app
$app = AppFactory::create();

class JsonBodyParserMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }

        return $handler->handle($request);
    }

}
$app->add(new JsonBodyParserMiddleware());

// Add route callbacks
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello! Welcome to the Chat-Service");
    return $response;
});


$app->post('/hello', function (Request $request, Response $response, $args): Response {
    $data = $request->getParsedBody();
    
    // Log the parsed body for debugging
    error_log(var_export($data, true));

    $html = var_export($data, true);
    $response->getBody()->write($html);
    
    return $response;
});
require __DIR__ . '/../src/routes.php';


// Run application
$app->run();