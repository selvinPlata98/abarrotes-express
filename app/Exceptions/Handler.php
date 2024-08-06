<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];
     
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
    
    
    
    
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            
                return response()->view('Livewire.error-page', [], 404);
        }
        if ($exception instanceof NotFoundHttpException) {
            
         return response()->view('error.403', [], 403);
 }
     if ($exception instanceof NotFoundHttpException) {
            
     return response()->view('error.500', [], 403);
 }
 
     }
 }