<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Administrador::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->contrasena)) {
            session(['user_id' => $admin->id, 'user_role' => 'admin', 'user_name' => $admin->nombre]);
            return redirect()->intended('/');
        }

        $cliente = Cliente::where('email', $request->email)->first();

        if ($cliente && Hash::check($request->password, $cliente->contrasena)) {
            session(['user_id' => $cliente->id, 'user_role' => 'user', 'user_name' => $cliente->nombre]);
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Credenciales inválidas.'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clientes,email',
            'password' => 'required|min:6|confirmed',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        $admin = Administrador::first();
        if (! $admin) {
            $admin = Administrador::create([
                'nombre' => 'Admin',
                'email' => 'admin@example.com',
                'contrasena' => Hash::make('password'),
                'nivelPermiso' => 'super',
            ]);
        }

        $cliente = Cliente::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'contrasena' => Hash::make($request->password),
            'direccionEnvio' => $request->direccion,
            'telefono' => $request->telefono,
            'administrador_id' => $admin->id,
        ]);

        session(['user_id' => $cliente->id, 'user_role' => 'user', 'user_name' => $cliente->nombre]);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
