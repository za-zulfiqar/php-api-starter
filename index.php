<?php

declare(strict_types=1);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function response(array $data, int $status = 200): never
{
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

if ($method === 'GET' && $uri === '/api/health') {
    response([
        'success' => true,
        'message' => 'API is running',
        'timestamp' => date('c'),
    ]);
}

if ($method === 'GET' && $uri === '/api/users') {
    response([
        'success' => true,
        'data' => [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            [
                'id' => 2,
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
            ],
        ],
    ]);
}

response([
    'success' => false,
    'message' => 'Route not found',
], 404);
