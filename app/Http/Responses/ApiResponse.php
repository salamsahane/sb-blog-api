<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
  public static function send(mixed $result, ?string $message = '', int $code = 200): JsonResponse
  {
    $response = ['data' => $result];

    if (!empty($message)) $response['message'] = $message;

    return response()->json($response, $code);
  }
}