<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversion;

class consumirApiMoedas extends Controller
{
    public function get()
    {
        $response = Http::get('http://api.exchangeratesapi.io/v1/latest', [
            "access_key" => "3657322ea6565a773ef07db094f8ace9",
        ]);

        $responseArray = $response->json();

        $iduser = Auth::user()->id;
        $conversoes = Conversion::where('iduser', $iduser)->get();

        return view('dashboard', compact('responseArray','conversoes'));
    }

    public function convert(Request $request)
    {
        // define qual usuario esta consultando
        $iduser = Auth::user()->id;

        // pega valores dos campos passados pelo usuario
        $selectMoeda1 = $request['selectMoeda1'];
        $selectMoeda2 = $request['selectMoeda2'];
        $valor = $request['valor'];

        // consulta api
        $response = Http::get('http://api.exchangeratesapi.io/v1/latest', [
            "access_key" => "3657322ea6565a773ef07db094f8ace9",
        ]);     

        // pega os resultados
        $responseArray = $response->json();

        if($valor <= 0){
            $conversoes = Conversion::where('iduser', $iduser)->get();

            return view('dashboard', compact('responseArray','conversoes', 'selectMoeda2'));
        }else{
            // pega valor daas cotações
            $valorMoedas = $response['rates'];
    
            foreach ($valorMoedas as $key => $value) {
                if($key == $selectMoeda1){
                    $moeda1 = $value;
                }else if($key == $selectMoeda2){
                    $moeda2 = $value;
                }
            }
    
            // faz o calculo do resultado
            $valorConversao = (($valor*$moeda2)/$moeda1);
            
            
            //adiciona a conversao no BD
            $conversao = new Conversion;
                $conversao->iduser = $iduser;
                $conversao->valor = $valor;
                $conversao->moeda1 = $selectMoeda1;
                $conversao->valorMoeda1 = $moeda1;
                $conversao->moeda2 = $selectMoeda2;
                $conversao->valorMoeda2 = $moeda2;
                $conversao->resultado = $valorConversao;
            $conversao->save();
            
            $conversoes = Conversion::where('iduser', $iduser)->orderBy('created_at', 'desc')->get();

            return view('dashboard', compact('valorConversao','responseArray','conversoes','selectMoeda2'));
        }
    }
}
