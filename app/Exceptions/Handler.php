<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                "responseCode" => 401,
                "responseStatus" => "Unauthorized",
                "responseMassage" => "Unauthenticated",
                'errors' => 'Unauthenticated'
            ], 401);
        }
        // return redirect()->guest(route('login'));
    }

    protected function invalidJson($request, ValidationException $exception) {
        return response()->json([
            "responseCode" => 422,
            "responseStatus" => "Unprocessable Entity",
            "responseMassage" => "The given data was invalid.",
            'errors' => $exception->errors(),
        ], $exception->status);
    }
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (NotFoundHttpException $e, $request){
            return response()->json([
                "responseCode" => 404,
                "responseStatus" => "Not Found",
                "responseMassage" => "Not Found",
            ]);
        });
    }
}
