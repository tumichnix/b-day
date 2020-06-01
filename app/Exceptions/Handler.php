<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isJsonApiCall($request)) {
            $errors = [];
            $error = [
                'id' => Uuid::uuid4()->toString(),
                'status' => $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500,
                'title' => $exception->getMessage(),
            ];
            if ($exception instanceof NotFoundHttpException) {
                $error['title'] = 'Not found';
                $error['detail'] = 'The resource you are requesting does not exist';
            }
            if ($exception instanceof ModelNotFoundException) {
                $error['title'] = 'Model not found';
                $error['detail'] = $exception->getMessage();
                $error['status'] = $status = 404;
            }
            $errors['errors'][] = $error;

            return new JsonResponse($errors, $status);
        }

        return parent::render($request, $exception);
    }

    protected function isJsonApiCall(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
