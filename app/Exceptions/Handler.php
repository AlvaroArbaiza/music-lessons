<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($this->isApi($request)) {
                return response()->json([
                    'message' => 'method not allowed'
                ], 405);
            }

            return null;
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($this->isApi($request)) {
                return response()->json([
                    'message' => 'validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }

            return null;
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($this->isApi($request)) {
                return response()->json([
                    'message' => 'not found',
                ], 404);
            }

            return null;
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $this->isApi($request)) {
            return response()->json([
                'message' => 'missing token',
            ], 401);
        }

        return redirect()->guest(route('login'));
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*') || $request->is('v1/*');
    }

}
