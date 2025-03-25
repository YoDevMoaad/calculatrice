<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function accueil()
    {
        return redirect()->route('calculator.index');
    }
    public function index()
    {
        return view('calculator');
    }

    public function calculate(Request $request)
    {
        $data = $request->all();

        $number1 = $data['number1'] ?? 0;
        $number2 = $data['number2'] ?? 0;
        $operation = $data['operation'] ?? 'add';

        $result = $this->effectuerOperation($number1, $number2, $operation);

        return response()->json(['result' => $result]);
    }

    /**
     * Effectue l'opération mathématique demandée.
     */
    private function effectuerOperation($a, $b, $operation)
    {
        switch ($operation) {
            case 'add':
                return $a + $b;
            case 'subtract':
                return $a - $b;
            case 'multiply':
                return $a * $b;
            case 'divide':
                return ($b != 0) ? $a / $b : 'Erreur : division par zéro';
            default:
                return 'Opération inconnue';
        }
    }
}
