<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Agenda; //Adicionado por Cezar
use App\Http\Requests\AgendaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class AgendaController extends Controller {

    public function cadastrar() {
        return view('admin.agenda.cadastrar');
    }

    public function gravar(AgendaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Agenda::create($dados);
        return redirect('/agenda/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $agenda = DB::select('select * from agendas where id = ?', [$id]);
        return view('admin.agenda.editar')->with('agenda', $agenda);
    }

    public function atualizar(AgendaRequest $request) {
        $dados = Request::all();
        $agenda = Agenda::find($dados['id']);
        $agenda->nome = $dados['nome'];
        $agenda->evento = $dados['evento'];
        $agenda->data = $dados['data'];
        $agenda->hora = $dados['hora'];
        $agenda->status = $dados['status'];
        $agenda->observacao = $dados['observacao'];
        $agenda->save();
        return redirect('/agenda/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $agenda = Agenda::all()->sortBy('nome')->where('empresa_id', Usuario::empresa());
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Evento', 'width' => 10],
            ['label' => 'Data', 'width' => 3],
            ['label' => 'Hora', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.agenda.listar', compact('agenda', 'cabecalho', 'config'));
    }
    public function listarfiltro(Request $request, Agenda $agenda) {
        $dadosFiltro = Request::all();
        $agendas = $agenda->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.agenda.listar', compact('agendas'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $agenda = Agenda::find($id);
        if ($agenda) {
            $agenda->delete();
        }
        return redirect('/agenda/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('agendas')->where('id', $id)->update(['status' => '0']);
        return redirect('/agenda/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('agendas')->where('id', $id)->update(['status' => '1']);
        return redirect('/agenda/listar')->withInput(); //redireciona por url
    }

    public function calendario() {

        return view('admin.agenda.calendario');
    }

}
