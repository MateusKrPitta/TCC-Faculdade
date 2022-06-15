<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use App\Importarcasadalavoura;

class ImportarcasadalavouraController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function listarclientes() {
		return view('admin.importarcasadalavoura.listarclientes');
	}

	public function importarclientes() {
		$clientes = Importarcasadalavoura::all()->sort();
		//DB::reconnect('baseorigem');
		//$cliente = DB::connection('firebird')->table('TRANSAC')->get();
		return view('admin.importarcasadalavoura.listarclientes')->with('clientes', $clientes);
	}

}
