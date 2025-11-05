<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PairSession;

class PairSessionController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva sesión de Pair Programming
     */
    public function create()
    {
        return view('pair.create');
    }

    /**
     * Crea una nueva sesión con driver, navigator y duración del turno
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_name'    => 'required|string|max:255',
            'navigator_name' => 'required|string|max:255',
            'turn_duration'  => 'required|integer|min:1',
        ]);

        $session = PairSession::create([
            'driver_name'    => $request->driver_name,
            'navigator_name' => $request->navigator_name,
            'turn_duration'  => $request->turn_duration,
            'session_code'    => rand(100000, 999999), // aquí generas código
            'current_role'   => 'driver', // arranca siempre el driver
        ]);

        return redirect()->route('pair.show', $session->id);
    }

    /**
     * Muestra la sesión con roles y temporizador
     */
    public function show($id)
    {
        $session = PairSession::findOrFail($id);
        return view('pair.show', compact('session'));
    }

    /**
     * Cambia los roles manualmente (si alguien presiona el botón CAMBIAR ROL)
     */
    public function switchRoles($id)
    {
        $session = PairSession::findOrFail($id);

        // Swap simple de rol actual (sin cambiar nombres)
        $session->current_role = $session->current_role === 'driver'
                                ? 'navigator'
                                : 'driver';
        $session->save();

        return redirect()->route('pair.show', $id);
    }

    /**
     * ✅ Switch de roles con swap real en la DB (llamado por AJAX cuando el timer llega a 0)
     * Intercambia los nombres: driver ↔ navigator
     */
    public function switchRolesAjax($id)
    {
        $session = PairSession::findOrFail($id);

        $oldDriver    = $session->driver_name;
        $oldNavigator = $session->navigator_name;

        // Intercambiar nombres
        $session->driver_name    = $oldNavigator;
        $session->navigator_name = $oldDriver;

        // Reiniciar rol para que empiece el nuevo driver
        $session->current_role = 'driver';
        $session->save();

        return response()->json([
            'driver_name'    => $session->driver_name,
            'navigator_name' => $session->navigator_name,
            'current_role'   => $session->current_role,
            'turn_duration'  => $session->turn_duration
        ]);
    }

    /**
     * Finaliza y elimina la sesión (botón "Finalizar sesión")
     */
    public function endSession($id)
    {
        $session = PairSession::findOrFail($id);
        $session->delete();

        return redirect()->route('pair.create')->with('success', 'Sesión finalizada correctamente.');
    }
}
