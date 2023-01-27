<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;

class AgendaController extends Controller {
    public function render() {
        $contatos = session()->get('usuario')->listarContatos();
        return view('agenda', compact('contatos'));
    }

    public function novoContato(Request $request) {
        $contato = new Contato([
            "nome" => $request->nome,
            "ddd" => $request->ddd,
            "telefone" => $request->telefone
        ]);

        session()->get('usuario')->adicionarContato($contato);

        return redirect('/agenda/minha');
    }
}
