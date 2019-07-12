<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ExceptionTrait
{
    public function apiException($request, $e) {
        if ($this->isModel($e)) {
            return $this->modelResponse($e);
        }

        return $this->httpResponse($e);
        if ($this->isHttp($e)) {
        }

        return parent::render($request, $e);
    }

    protected function isModel($e) {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e) {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse($e) {
        return response()->json([
            "error" => "Product Not Found"
        ], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse($e) {
        return response()->json([
            "error" => "Wrong Route"
        ], Response::HTTP_NOT_FOUND);
    }
}
