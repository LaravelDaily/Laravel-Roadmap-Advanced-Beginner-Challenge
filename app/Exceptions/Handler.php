<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

        $this->renderable(function (Throwable $e, $request) {
            $response = null;

            if ($request->is('api/*')) {
                switch (get_class($e)) {
                    case NotFoundHttpException::class:
                        {
                            $response = response()->json(['message' => 'Object not found'], 404);
                        }
                        break;

                    case QueryException::class:
                        {
                            if ($e->getCode() === '23000') {
                                $response = response()->json(['message' => 'Constraint error'], 500);
                            } else {
                                $response = response()->json(['message' => 'Sql error'], 500);
                            }
                        }
                        break;
                }
            }

            return $response;
        });
    }


}
