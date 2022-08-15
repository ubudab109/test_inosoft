<?php

namespace App\Services;

class AuthService
{

  /**
   * If the user is not authorized, return an array with a status of Unauthorized and an empty token.
   * If the user is authorized, return an array with a status of Authorized and a token.
   * 
   * @param array data An array of the data that you want to pass to the API.
   * 
   * @return array An array with two keys, status and token.
   */
  public function auth(array $data): array
  {
    if (!$token = auth()->attempt($data)) {
      return [
        'status' => 'Unauthorized',
        'token'  => ''
      ];
    }

    return [
      'status' => 'Authorized',
      'token'   => $token
    ];
  }
}
