<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PreventExamNavigation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('exam_running'))
        {
            $exam_id = Session::get('exam_running');
            $allowedRoutes = [
                'exams.show',
                'exam.submit',
            ];
              if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('exams.show', $exam_id);
            }
        }

        return $next($request);
    }
}
