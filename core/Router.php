<?php
class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    // Register a POST route
    public function post(string $path, callable|array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable|array $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
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
            if ($route['path'] == $requestUri && $route['method'] === $requestMethod) {
                $handler = $route['handler'];

                if (is_callable($handler)) {
                    $handler();
                    return;
                }

                if (is_array($handler)) {
                    [$controller, $method] = $handler;
                    $controllerInstance = new $controller();
                    $controllerInstance->$method();
                    return;
                }
            }
        }
        $this->abort(404);
    }


    private function abort(int $code): void
    {
        http_response_code($code);
        echo "<h1>$code - Page Not Found</h1>";
        exit;
    }
}


