<?php
    require_once __DIR__ . '/../app/Controller/ErrorController.php';
    require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';
class Router
{
    private array $routes = [];

    public function get( string $path, callable|array $handler, bool $auth = false ): void
    {
        $this->addRoute('GET', $path, $handler, $auth);
    }

    // Register a POST route
    public function post(string $path, callable|array $handler, bool $auth = false ): void
    {
        $this->addRoute('POST', $path, $handler, $auth);
    }

    private function addRoute(string $method, string $path, callable|array $handler, bool $auth): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'auth' => $auth,
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        return $path === '' ? '/' : '/' . $path;
    }

    public function dispatch(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestUri = str_replace(
            '/PHP_Review/Public',
            '',
            $requestUri
        );

        $requestUri = $this->normalizePath($requestUri);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $routePath = preg_replace(
                '#\{[^}]+\}#',
                '([^/]+)',
                $route['path']
            );

            $pattern = '#^' . $routePath . '$#';

            if ( $route['method'] === $requestMethod &&
                preg_match($pattern, $requestUri, $matches)
            ){
                if ($route['auth']) {
                    AuthMiddleware::handle();
                }

                $handler = $route['handler'];

                if (is_callable($handler)) {
                    $handler();
                    return;
                }

                if (is_array($handler)) {
                    [$controller, $method] = $handler;
                    $controllerInstance = new $controller();
                    if(isset($matches[1])){
                        $controllerInstance->$method($matches[1]);
                    }
                    else
                    {
                        $controllerInstance->$method();
                    }

                    return;
                }
            }
        }
        abort(404);
    }



}


