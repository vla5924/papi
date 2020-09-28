<?php

namespace PAPI;

class Output
{
    protected static function status(int $status): void
    {
        http_response_code($status);
    }

    protected static function json(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function success(int $status, array $data = []): void
    {
        self::status($status);
        $data['ok'] = true;
        self::json($data);
    }

    public static function failure(int $status, int $errorCode, string $errorMessage = ''): void
    {
        self::status($status);
        self::json(['ok' => false, 'error_code' => $errorCode, 'error_message' => $errorMessage]);
    }
}
