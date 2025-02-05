<?php
use Illuminate\Http\JsonResponse;

if (! function_exists('showInternalError')) {
    /**
    * Return the default error for internal error
    * 
    * @return JsonResponse
    */

    function showInternalError() {
        $response = new JsonResponse([
            'error' => 'Ocorreu um erro interno no servidor.'
        ], 500);
        return $response;
    }
}