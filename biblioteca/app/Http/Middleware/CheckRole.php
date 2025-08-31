<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Primeiro, garante que o usuário está logado.
        if (!Auth::check()) {
            return redirect('login');
        }

        // Pega o usuário autenticado.
        $user = Auth::user();

        // Verifica se o cargo do usuário está na lista de cargos permitidos.
        // in_array() verifica se um valor existe dentro de um array.
        if (!in_array($user->role, $roles)) {
            // Se o cargo do usuário não estiver na lista, nega o acesso.
            abort(403, 'ACESSO NÃO AUTORIZADO.');
        }

        // Se o cargo for permitido, a requisição continua.
        return $next($request);
    }
}