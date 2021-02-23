<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Candidato;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    public function cadastro(Request $request)
    {
      $data = $request->all();

      $validacao = Validator::make($data, [
        'nome' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'idade' => 'required',
        'linkedin' => 'required',
    ]);

      if($validacao->fails()){
        return $validacao->errors();
      }

      $candidato = Candidato::create([
          'nome' => $data['nome'],
          'email' => $data['email'],
          'idade' => $data['idade'],
          'linkedin' => $data['linkedin'],
          'tecnologias' => $data['tecnologias'],
      ]);

      return $candidato;
    }

    public function lista(){
      $candidatos = Candidato::all();
      return $candidatos->toArray();
    }

    public function candidato(Request $request){      
      $candidato = Candidato::whereId($request->id)->first();
      return $candidato;
    }

    public function atualizar(Request $request){  
      $candidato = Candidato::find($request->id);

      $candidato->nome = $request->nome;
      $candidato->email = $request->email;
      $candidato->idade = $request->idade;
      $candidato->linkedin = $request->linkedin;
      $candidato->tecnologias = $request->tecnologias;

      $candidato->save();    
    }

    public function deletar(Request $request){

      $candidato = Candidato::find($request->id);
      $candidato->delete();

    }
}
