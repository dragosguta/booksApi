<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        //Always return the current object from method when chaining
        return $this;
    }

    public function respondNotFound($message = 'Not Found!') {
        return $this->setStatusCode(HTTPResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!') {
        return $this->setStatusCode(HTTPResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    public function respondCreated($message) {
        return $this->setStatusCode(HTTPResponse::HTTP_CREATED)->respond([
            'message' => $message
        ]);
    }

    public function respondWithError($message) {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respond($data, $headers = []) {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
}
