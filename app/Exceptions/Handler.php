<?php

namespace App\Exceptions;

use App\Models\LogError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
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


            $user = auth()->user();
            LogError::create([
                'user_id' => $user->id ?? 0,
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'line' => $e->getLine(),
                'trace' => array_map(function ($trace){
                    unset($trace['args']);
                    return $trace;
                },$e->getTrace()),
                'method' => request()->getMethod(),
                'params' => request()->all(),
                'url' => request()->getPathInfo(),
                'user_agent' => request()->userAgent(),
                'header' => request()->headers->all(),
            ]);
        });

        $this->renderable(function (NotFoundHttpException $e){
            return response()->view('errors.404', [], 404);
        });

        $this->renderable(function (Throwable $e){
            return response()->view('error', [], 500);
        });
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response('授權失敗',401);
//      return parent::unauthenticated($request, $exception); // TODO: Change the autogenerated stub
    }
}
