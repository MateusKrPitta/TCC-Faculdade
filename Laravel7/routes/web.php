<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('admin', 'AdminController@index')->name('admin.home');
    Route::get('home', 'AdminController@index')->name('admin.home');

    Route::get('/aluno/cadastrar', 'AlunoController@cadastrar');
    Route::post('/aluno/gravar', 'AlunoController@gravar');
    Route::get('/aluno/listar', 'AlunoController@listar');
    Route::get('/aluno/ativar/{id}', 'AlunoController@ativar');
    Route::get('/aluno/bloquear/{id}', 'AlunoController@bloquear');
    Route::get('/aluno/apagar/{id}', 'AlunoController@apagar');
    Route::get('/aluno/ficha/{id}', 'AlunoController@ficha');
    Route::get('/aluno/editar/{id}', 'AlunoController@editar');
    Route::post('/aluno/atualizar', 'AlunoController@atualizar');

    Route::get('/turma/cadastrar', 'TurmaController@cadastrar');
    Route::post('/turma/gravar', 'TurmaController@gravar');
    Route::get('/turma/listar', 'TurmaController@listar');
    Route::get('/turma/ativar/{id}', 'TurmaController@ativar');
    Route::get('/turma/bloquear/{id}', 'TurmaController@bloquear');
    Route::get('/turma/apagar/{id}', 'TurmaController@apagar');
    Route::get('/turma/ficha/{id}', 'TurmaController@ficha');
    Route::get('/turma/editar/{id}', 'TurmaController@editar');
    Route::post('/turma/atualizar', 'TurmaController@atualizar');

    Route::get('/matricula/cadastrar', 'MatriculaController@cadastrar');
    Route::post('/matricula/gravar', 'MatriculaController@gravar');
    Route::any('/matricula/listar', 'MatriculaController@listar')->name('matricula.listar'); //Verificar se funciona
    Route::get('/matricula/ativar/{id}', 'MatriculaController@ativar');
    Route::get('/matricula/bloquear/{id}', 'MatriculaController@bloquear');
    Route::get('/matricula/apagar/{id}', 'MatriculaController@apagar');
    Route::get('/matricula/ficha/{id}', 'MatriculaController@ficha');
    Route::get('/matricula/editar/{id}', 'MatriculaController@editar');
    Route::post('/matricula/atualizar', 'MatriculaController@atualizar');

    Route::get('/contratoescola/cadastrar', 'ContratoescolaController@cadastrar');
    Route::post('/contratoescola/cadastrar', 'ContratoescolaController@cadastrar');
    Route::post('/contratoescola/gravar', 'ContratoescolaController@gravar');
    Route::post('/contratoescola/atualizar', 'ContratoescolaController@atualizar');
    Route::get('/contratoescola/listar', 'ContratoescolaController@listar');
    Route::get('/contratoescola/editar/{id}', 'ContratoescolaController@editar');
    Route::get('/contratoescola/imprimircontrato/{id}', 'ContratoescolaController@imprimircontrato');
    Route::get('/contratoescola/config', 'ContratoescolaController@config');
    Route::post('/contratoescola/atualizarconfig', 'ContratoescolaController@atualizarconfig');
    Route::get('/contratoescola/ativar/{id}', 'ContratoescolaController@ativar');
    Route::get('/contratoescola/bloquear/{id}', 'ContratoescolaController@bloquear');
    Route::get('/contratoescola/apagar/{id}', 'ContratoescolaController@apagar');

    Route::get('/diario/cadastrar', 'DiarioController@cadastrar');
    Route::post('/diario/gravar', 'DiarioController@gravar');
    Route::get('/diario/listar', 'DiarioController@listar');
    Route::get('/diario/ativar/{id}', 'DiarioController@ativar');
    Route::get('/diario/bloquear/{id}', 'DiarioController@bloquear');
    Route::get('/diario/apagar/{id}', 'DiarioController@apagar');
    Route::get('/diario/ficha/{id}', 'DiarioController@ficha');
    Route::get('/diario/editar/{id}', 'DiarioController@editar');
    Route::post('/diario/atualizar', 'DiarioController@atualizar');

    Route::get('/especialidade/cadastrar', 'EspecialidadeController@cadastrar');
    Route::post('/especialidade/cadastrar', 'EspecialidadeController@cadastrar');
    Route::post('/especialidade/gravar', 'EspecialidadeController@gravar');
    Route::get('/especialidade/listar', 'EspecialidadeController@listar');
    Route::get('/especialidade/listarfiltro', 'EspecialidadeController@listarfiltro');
    Route::post('/especialidade/listarfiltro', 'EspecialidadeController@listarfiltro');
    Route::get('/especialidade/editar/{id}', 'EspecialidadeController@editar');
    Route::post('/especialidade/atualizar', 'EspecialidadeController@atualizar');
    Route::get('/especialidade/ativar/{id}', 'EspecialidadeController@ativar');
    Route::get('/especialidade/bloquear/{id}', 'EspecialidadeController@bloquear');
    Route::get('/especialidade/apagar/{id}', 'EspecialidadeController@apagar');

    Route::get('/exameexecutado/cadastrar', 'ExameexecutadoController@cadastrar');
    Route::post('/exameexecutado/cadastrar', 'ExameexecutadoController@cadastrar');
    Route::post('/exameexecutado/gravar', 'ExameexecutadoController@gravar');
    Route::get('/exameexecutado/listar', 'ExameexecutadoController@listar');
    Route::get('/exameexecutado/listarfiltro', 'ExameexecutadoController@listarfiltro');
    Route::post('/exameexecutado/listarfiltro', 'ExameexecutadoController@listarfiltro');
    Route::get('/exameexecutado/editar/{id}', 'ExameexecutadoController@editar');
    Route::post('/exameexecutado/atualizar', 'ExameexecutadoController@atualizar');
    Route::get('/exameexecutado/ativar/{id}', 'ExameexecutadoController@ativar');
    Route::get('/exameexecutado/bloquear/{id}', 'ExameexecutadoController@bloquear');
    Route::get('/exameexecutado/apagar/{id}', 'ExameexecutadoController@apagar');

    Route::get('/exame/cadastrar', 'ExameController@cadastrar');
    Route::post('/exame/cadastrar', 'ExameController@cadastrar');
    Route::post('/exame/gravar', 'ExameController@gravar');
    Route::get('/exame/listar', 'ExameController@listar');
    Route::get('/exame/listarfiltro', 'ExameController@listarfiltro');
    Route::post('/exame/listarfiltro', 'ExameController@listarfiltro');
    Route::get('/exame/editar/{id}', 'ExameController@editar');
    Route::post('/exame/atualizar', 'ExameController@atualizar');
    Route::get('/exame/ativar/{id}', 'ExameController@ativar');
    Route::get('/exame/bloquear/{id}', 'ExameController@bloquear');
    Route::get('/exame/apagar/{id}', 'ExameController@apagar');

    Route::get('/procedimentoexecutado/cadastrar', 'ProcedimentoexecutadoController@cadastrar');
    Route::post('/procedimentoexecutado/gravar', 'ProcedimentoexecutadoController@gravar');
    Route::get('/procedimentoexecutado/listar', 'ProcedimentoexecutadoController@listar');
    Route::get('/procedimentoexecutado/listarfiltro', 'ProcedimentoexecutadoController@listarfiltro');
    Route::post('/procedimentoexecutado/listarfiltro', 'ProcedimentoexecutadoController@listarfiltro');
    Route::get('/procedimentoexecutado/editar/{id}', 'ProcedimentoexecutadoController@editar');
    Route::post('/procedimentoexecutado/atualizar', 'ProcedimentoexecutadoController@atualizar');
    Route::get('/procedimentoexecutado/ativar/{id}', 'ProcedimentoexecutadoController@ativar');
    Route::get('/procedimentoexecutado/bloquear/{id}', 'ProcedimentoexecutadoController@bloquear');
    Route::get('/procedimentoexecutado/apagar/{id}', 'ProcedimentoexecutadoController@apagar');

    Route::get('/procedimento/cadastrar', 'ProcedimentoController@cadastrar');
    Route::post('/procedimento/gravar', 'ProcedimentoController@gravar');
    Route::get('/procedimento/listar', 'ProcedimentoController@listar');
    Route::get('/procedimento/listarfiltro', 'ProcedimentoController@listarfiltro');
    Route::post('/procedimento/listarfiltro', 'ProcedimentoController@listarfiltro');
    Route::get('/procedimento/editar/{id}', 'ProcedimentoController@editar');
    Route::post('/procedimento/atualizar', 'ProcedimentoController@atualizar');
    Route::get('/procedimento/ativar/{id}', 'ProcedimentoController@ativar');
    Route::get('/procedimento/bloquear/{id}', 'ProcedimentoController@bloquear');
    Route::get('/procedimento/apagar/{id}', 'ProcedimentoController@apagar');

    Route::get('/consulta/cadastrar', 'ConsultaController@cadastrar');
    Route::post('/consulta/gravar', 'ConsultaController@gravar');
    Route::get('/consulta/listar', 'ConsultaController@listar');
    Route::get('/consulta/listarfiltro', 'ConsultaController@listarfiltro');
    Route::post('/consulta/listarfiltro', 'ConsultaController@listarfiltro');
    Route::get('/consulta/editar/{id}', 'ConsultaController@editar');
    Route::post('/consulta/atualizar', 'ConsultaController@atualizar');
    Route::get('/consulta/ativar/{id}', 'ConsultaController@ativar');
    Route::get('/consulta/bloquear/{id}', 'ConsultaController@bloquear');
    Route::get('/consulta/apagar/{id}', 'ConsultaController@apagar');

    Route::get('/medico/cadastrar', 'MedicoController@cadastrar');
    Route::post('/medico/cadastrar', 'MedicoController@cadastrar');
    Route::post('/medico/gravar', 'MedicoController@gravar');
    Route::get('/medico/listarfiltro', 'MedicoController@listarfiltro');
    Route::post('/medico/listarfiltro', 'MedicoController@listarfiltro');
    Route::get('/medico/listar', 'MedicoController@listar');
    Route::get('/medico/editar/{id}', 'MedicoController@editar');
    Route::get('/medico/atualizar/{id}', 'MedicoController@atualizar');
    Route::post('/medico/atualizar', 'MedicoController@atualizar');
    Route::get('/medico/ativar/{id}', 'MedicoController@ativar');
    Route::get('/medico/bloquear/{id}', 'MedicoController@bloquear');
    Route::get('/medico/apagar/{id}', 'MedicoController@apagar');

    Route::get('/cliente/cadastrar', 'ClienteController@cadastrar');
    Route::post('/cliente/cadastrar', 'ClienteController@cadastrar');
    Route::post('/cliente/gravar', 'ClienteController@gravar');
    Route::post('/cliente/atualizar', 'ClienteController@atualizar');
    Route::get('/cliente/listar', 'ClienteController@listar');
    Route::get('/cliente/listarfiltro', 'ClienteController@listarfiltro');
    Route::post('/cliente/listarfiltro', 'ClienteController@listarfiltro');
    Route::get('/cliente/editar/{id}', 'ClienteController@editar');
    Route::get('/cliente/ativar/{id}', 'ClienteController@ativar');
    Route::get('/cliente/bloquear/{id}', 'ClienteController@bloquear');
    Route::get('/cliente/importaraluno', 'ClienteController@importaraluno');
    Route::get('/cliente/apagar/{id}', 'ClienteController@apagar');

    Route::get('/orcamento/cadastrar', 'OrcamentoController@cadastrar');
    Route::post('/orcamento/cadastrar', 'OrcamentoController@cadastrar');
    Route::post('/orcamento/gravar', 'OrcamentoController@gravar');
    Route::post('/orcamento/atualizar', 'OrcamentoController@atualizar');
    Route::get('/orcamento/listar', 'OrcamentoController@listar');
    Route::get('/orcamento/listarfiltro', 'OrcamentoController@listarfiltro');
    Route::post('/orcamento/listarfiltro', 'OrcamentoController@listarfiltro');
    Route::get('/orcamento/editar/{id}', 'OrcamentoController@editar');
    Route::get('/orcamento/ativar/{id}', 'OrcamentoController@ativar');
    Route::get('/orcamento/bloquear/{id}', 'OrcamentoController@bloquear');
    Route::get('/orcamento/importaraluno', 'OrcamentoController@importaraluno');
    Route::get('/orcamento/apagar/{id}', 'OrcamentoController@apagar');

    Route::get('/orcamentodeservico/cadastrar', 'OrcamentodeservicoController@cadastrar');
    Route::post('/orcamentodeservico/cadastrar', 'OrcamentodeservicoController@cadastrar');
    Route::post('/orcamentodeservico/gravar', 'OrcamentodeservicoController@gravar');
    Route::post('/orcamentodeservico/atualizar', 'OrcamentodeservicoController@atualizar');
    Route::get('/orcamentodeservico/listar', 'OrcamentodeservicoController@listar');
    Route::get('/orcamentodeservico/listarfiltro', 'OrcamentodeservicoController@listarfiltro');
    Route::post('/orcamentodeservico/listarfiltro', 'OrcamentodeservicoController@listarfiltro');
    Route::get('/orcamentodeservico/editar/{id}', 'OrcamentodeservicoController@editar');
    Route::get('/orcamentodeservico/ativar/{id}', 'OrcamentodeservicoController@ativar');
    Route::get('/orcamentodeservico/bloquear/{id}', 'OrcamentodeservicoController@bloquear');
    Route::get('/orcamentodeservico/importaraluno', 'OrcamentodeservicoController@importaraluno');
    Route::get('/orcamentodeservico/apagar/{id}', 'OrcamentodeservicoController@apagar');

    Route::get('/ordemdeservico/cadastrar', 'OrdemdeservicoController@cadastrar');
    Route::post('/ordemdeservico/cadastrar', 'OrdemdeservicoController@cadastrar');
    Route::post('/ordemdeservico/gravar', 'OrdemdeservicoController@gravar');
    Route::post('/ordemdeservico/atualizar', 'OrdemdeservicoController@atualizar');
    Route::get('/ordemdeservico/listar', 'OrdemdeservicoController@listar');
    Route::get('/ordemdeservico/listarfiltro', 'OrdemdeservicoController@listarfiltro');
    Route::post('/ordemdeservico/listarfiltro', 'OrdemdeservicoController@listarfiltro');
    Route::get('/ordemdeservico/editar/{id}', 'OrdemdeservicoController@editar');
    Route::get('/ordemdeservico/ativar/{id}', 'OrdemdeservicoController@ativar');
    Route::get('/ordemdeservico/bloquear/{id}', 'OrdemdeservicoController@bloquear');
    Route::get('/ordemdeservico/importaraluno', 'OrdemdeservicoController@importaraluno');
    Route::get('/ordemdeservico/apagar/{id}', 'OrdemdeservicoController@apagar');

    Route::get('/servico/cadastrar', 'ServicoController@cadastrar');
    Route::post('/servico/cadastrar', 'ServicoController@cadastrar');
    Route::post('/servico/gravar', 'ServicoController@gravar');
    Route::post('/servico/atualizar', 'ServicoController@atualizar');
    Route::get('/servico/listar', 'ServicoController@listar');
    Route::get('/servico/listarfiltro', 'ServicoController@listarfiltro');
    Route::post('/servico/listarfiltro', 'ServicoController@listarfiltro');
    Route::get('/servico/editar/{id}', 'ServicoController@editar');
    Route::get('/servico/ativar/{id}', 'ServicoController@ativar');
    Route::get('/servico/bloquear/{id}', 'ServicoController@bloquear');
    Route::get('/servico/importaraluno', 'ServicoController@importaraluno');
    Route::get('/servico/apagar/{id}', 'ServicoController@apagar');

    Route::get('/telemarketingtransporte/cadastrar', 'TelemarketingtransporteController@cadastrar');
    Route::post('/telemarketingtransporte/cadastrar', 'TelemarketingtransporteController@cadastrar');
    Route::get('/telemarketingtransporte/cadastrar1/{id}', 'TelemarketingtransporteController@cadastrar1');
    Route::post('/telemarketingtransporte/gravar', 'TelemarketingtransporteController@gravar');
    Route::post('/telemarketingtransporte/atualizar', 'TelemarketingtransporteController@atualizar');
    Route::get('/telemarketingtransporte/listar', 'TelemarketingtransporteController@listar');
    Route::get('/telemarketingtransporte/listarfiltro', 'TelemarketingtransporteController@listarfiltro');
    Route::post('/telemarketingtransporte/listarfiltro', 'TelemarketingtransporteController@listarfiltro');
    Route::get('/telemarketingtransporte/editar/{id}', 'TelemarketingtransporteController@editar');
    Route::get('/telemarketingtransporte/ativar/{id}', 'TelemarketingtransporteController@ativar');
    Route::get('/telemarketingtransporte/bloquear/{id}', 'TelemarketingtransporteController@bloquear');
    Route::get('/telemarketingtransporte/apagar/{id}', 'TelemarketingtransporteController@apagar');

    Route::get('/fornecedor/cadastrar', 'FornecedorController@cadastrar');
    Route::post('/fornecedor/cadastrar', 'FornecedorController@cadastrar');
    Route::post('/fornecedor/gravar', 'FornecedorController@gravar');
    Route::post('/fornecedor/atualizar', 'FornecedorController@atualizar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar');
    Route::post('/fornecedor/listar', 'FornecedorController@listar');
    Route::get('/fornecedor/listarfiltro', 'FornecedorController@listarfiltro');
    Route::post('/fornecedor/listarfiltro', 'FornecedorController@listarfiltro');
    Route::get('/fornecedor/editar/{id}', 'FornecedorController@editar');
    Route::get('/fornecedor/ativar/{id}', 'FornecedorController@ativar');
    Route::get('/fornecedor/bloquear/{id}', 'FornecedorController@bloquear');
    Route::get('/fornecedor/apagar/{id}', 'FornecedorController@apagar');

    Route::get('/clientefin/cadastrar', 'ClienteController@cadastrar');
    Route::post('/clientefin/cadastrar', 'ClienteController@cadastrar');
    Route::post('/clientefin/gravar', 'ClienteController@gravar');
    Route::post('/clientefin/atualizar', 'ClienteController@atualizar');
    Route::get('/clientefin/listar', 'ClienteController@listar');
    Route::get('/clientefin/editar/{id}', 'ClienteController@editar');
    Route::get('/clientefin/ativar/{id}', 'ClienteController@ativar');
    Route::get('/clientefin/bloquear/{id}', 'ClienteController@bloquear');
    Route::get('/clientefin/importaraluno', 'ClienteController@importaraluno');

    Route::get('/fornecedorfin/cadastrar', 'FornecedorController@cadastrar');
    Route::post('/fornecedorfin/cadastrar', 'FornecedorController@cadastrar');
    Route::post('/fornecedorfin/gravar', 'FornecedorController@gravar');
    Route::post('/fornecedorfin/atualizar', 'FornecedorController@atualizar');
    Route::get('/fornecedorfin/listar', 'FornecedorController@listar');
    Route::get('/fornecedorfin/editar/{id}', 'FornecedorController@editar');
    Route::get('/fornecedorfin/ativar/{id}', 'FornecedorController@ativar');
    Route::get('/fornecedorfin/bloquear/{id}', 'FornecedorController@bloquear');

    Route::get('/produto/cadastrar', 'ProdutoController@cadastrar');
    Route::post('/produto/cadastrar', 'ProdutoController@cadastrar');
    Route::post('/produto/gravar', 'ProdutoController@gravar');
    Route::post('/produto/atualizar', 'ProdutoController@atualizar');
    Route::get('/produto/listar', 'ProdutoController@listar');
    Route::get('/produto/editar/{id}', 'ProdutoController@editar');
    Route::get('/produto/ativar/{id}', 'ProdutoController@ativar');
    Route::get('/produto/bloquear/{id}', 'ProdutoController@bloquear');
    Route::get('/produto/apagar/{id}', 'ProdutoController@apagar');

    Route::get('/contasapagar/cadastrar', 'ContasapagarController@cadastrar');
    Route::post('/contasapagar/cadastrar', 'ContasapagarController@cadastrar');
    Route::post('/contasapagar/gravar', 'ContasapagarController@gravar');
    Route::post('/contasapagar/atualizar', 'ContasapagarController@atualizar');
    Route::get('/contasapagar/listar', 'ContasapagarController@listar');
    Route::get('/contasapagar/editar/{id}', 'ContasapagarController@editar');
    Route::get('/contasapagar/ativar/{id}', 'ContasapagarController@ativar');
    Route::get('/contasapagar/bloquear/{id}', 'ContasapagarController@bloquear');
    Route::get('/contasapagar/receber/{id}', 'ContasapagarController@receber');
    Route::get('/contasapagar/apagar/{id}', 'ContasapagarController@apagar');

    Route::get('/contasareceber/cadastrar', 'ContasareceberController@cadastrar');
    Route::get('/contasareceber/gerarmensalidade', 'ContasareceberController@gerarmensalidade');
    Route::post('/contasareceber/gerarmensalidade', 'ContasareceberController@gerarmensalidade');
    Route::post('/contasareceber/processarmensalidade', 'ContasareceberController@processarmensalidade');
    Route::post('/contasareceber/cadastrar', 'ContasareceberController@cadastrar');
    Route::post('/contasareceber/gravar', 'ContasareceberController@gravar');
    Route::post('/contasareceber/atualizar', 'ContasareceberController@atualizar');
    Route::get('/contasareceber/listar', 'ContasareceberController@listar');
    Route::get('/contasareceber/editar/{id}', 'ContasareceberController@editar');
    Route::get('/contasareceber/ativar/{id}', 'ContasareceberController@ativar');
    Route::get('/contasareceber/bloquear/{id}', 'ContasareceberController@bloquear');
    Route::get('/contasareceber/receber/{id}', 'ContasareceberController@receber');
    Route::get('/contasareceber/apagar/{id}', 'ContasareceberController@apagar');

    Route::get('/formadepagamento/cadastrar', 'FormadepagamentoController@cadastrar');
    Route::post('/formadepagamento/cadastrar', 'FormadepagamentoController@cadastrar');
    Route::post('/formadepagamento/gravar', 'FormadepagamentoController@gravar');
    Route::post('/formadepagamento/atualizar', 'FormadepagamentoController@atualizar');
    Route::get('/formadepagamento/listar', 'FormadepagamentoController@listar');
    Route::get('/formadepagamento/editar/{id}', 'FormadepagamentoController@editar');
    Route::get('/formadepagamento/ativar/{id}', 'FormadepagamentoController@ativar');
    Route::get('/formadepagamento/bloquear/{id}', 'FormadepagamentoController@bloquear');
    Route::get('/formadepagamento/receber/{id}', 'FormadepagamentoController@receber');
    Route::get('/formadepagamento/apagar/{id}', 'FormadepagamentoController@apagar');

    Route::get('/boleto/cadastrar', 'BoletoController@cadastrar');
    Route::post('/boleto/cadastrar', 'BoletoController@cadastrar');
    Route::post('/boleto/gravar', 'BoletoController@gravar');
    Route::post('/boleto/atualizar', 'BoletoController@atualizar');
    Route::get('/boleto/listar', 'BoletoController@listar');
    Route::get('/boleto/editar/{id}', 'BoletoController@editar');
    Route::get('/boleto/ativar/{id}', 'BoletoController@ativar');
    Route::get('/boleto/bloquear/{id}', 'BoletoController@bloquear');
    Route::get('/boleto/receber/{id}', 'BoletoController@receber');
    Route::get('/boleto/apagar/{id}', 'BoletoController@apagar');

    Route::get('/carne/cadastrar', 'CarneController@cadastrar');
    Route::post('/carne/cadastrar', 'CarneController@cadastrar');
    Route::post('/carne/gravar', 'CarneController@gravar');
    Route::post('/carne/atualizar', 'CarneController@atualizar');
    Route::get('/carne/listar', 'CarneController@listar');
    Route::get('/carne/editar/{id}', 'CarneController@editar');
    Route::get('/carne/ativar/{id}', 'CarneController@ativar');
    Route::get('/carne/bloquear/{id}', 'CarneController@bloquear');
    Route::get('/carne/receber/{id}', 'CarneController@receber');
    Route::get('/carne/apagar/{id}', 'CarneController@apagar');

    Route::get('/projetos/cadastrar', 'ProjetosController@cadastrar');
    Route::post('/projetos/cadastrar', 'ProjetosController@cadastrar');
    Route::post('/projetos/gravar', 'ProjetosController@gravar');
    Route::post('/projetos/atualizar', 'ProjetosController@atualizar');
    Route::get('/projetos/listar', 'ProjetosController@listar');
    Route::get('/projetos/editar/{id}', 'ProjetosController@editar');
    Route::get('/projetos/ativar/{id}', 'ProjetosController@ativar');
    Route::get('/projetos/bloquear/{id}', 'ProjetosController@bloquear');
    Route::get('/projetos/receber/{id}', 'ProjetosController@receber');
    Route::get('/projetos/apagar/{id}', 'ProjetosController@apagar');

    Route::get('/tarefas/cadastrar', 'TarefasController@cadastrar');
    Route::post('/tarefas/cadastrar', 'TarefasController@cadastrar');
    Route::post('/tarefas/gravar', 'TarefasController@gravar');
    Route::post('/tarefas/atualizar', 'TarefasController@atualizar');
    Route::get('/tarefas/listar', 'TarefasController@listar');
    Route::get('/tarefas/editar/{id}', 'TarefasController@editar');
    Route::get('/tarefas/ativar/{id}', 'TarefasController@ativar');
    Route::get('/tarefas/bloquear/{id}', 'TarefasController@bloquear');
    Route::get('/tarefas/receber/{id}', 'TarefasController@receber');
    Route::get('/tarefas/apagar/{id}', 'TarefasController@apagar');

    Route::get('/pessoas/cadastrar', 'PessoasController@cadastrar');
    Route::post('/pessoas/cadastrar', 'PessoasController@cadastrar');
    Route::post('/pessoas/gravar', 'PessoasController@gravar');
    Route::post('/pessoas/atualizar', 'PessoasController@atualizar');
    Route::get('/pessoas/listar', 'PessoasController@listar');
    Route::get('/pessoas/editar/{id}', 'PessoasController@editar');
    Route::get('/pessoas/ativar/{id}', 'PessoasController@ativar');
    Route::get('/pessoas/bloquear/{id}', 'PessoasController@bloquear');
    Route::get('/pessoas/receber/{id}', 'PessoasController@receber');
    Route::get('/pessoas/apagar/{id}', 'PessoasController@apagar');

    Route::get('/contratoassociacao/cadastrar', 'ContratoassociacaoController@cadastrar');
    Route::post('/contratoassociacao/cadastrar', 'ContratoassociacaoController@cadastrar');
    Route::post('/contratoassociacao/gravar', 'ContratoassociacaoController@gravar');
    Route::post('/contratoassociacao/atualizar', 'ContratoassociacaoController@atualizar');
    Route::get('/contratoassociacao/listar', 'ContratoassociacaoController@listar');
    Route::get('/contratoassociacao/editar/{id}', 'ContratoassociacaoController@editar');
    Route::get('/contratoassociacao/ativar/{id}', 'ContratoassociacaoController@ativar');
    Route::get('/contratoassociacao/bloquear/{id}', 'ContratoassociacaoController@bloquear');
    Route::get('/contratoassociacao/receber/{id}', 'ContratoassociacaoController@receber');
    Route::get('/contratoassociacao/apagar/{id}', 'ContratoassociacaoController@apagar');

    Route::get('/rateio/cadastrar', 'RateioController@cadastrar');
    Route::post('/rateio/cadastrar', 'RateioController@cadastrar');
    Route::post('/rateio/gravar', 'RateioController@gravar');
    Route::post('/rateio/atualizar', 'RateioController@atualizar');
    Route::get('/rateio/listar', 'RateioController@listar');
    Route::get('/rateio/editar/{id}', 'RateioController@editar');
    Route::get('/rateio/ativar/{id}', 'RateioController@ativar');
    Route::get('/rateio/bloquear/{id}', 'RateioController@bloquear');
    Route::get('/rateio/receber/{id}', 'RateioController@receber');
    Route::get('/rateio/apagar/{id}', 'RateioController@apagar');

    Route::get('/quota/cadastrar', 'QuotaController@cadastrar');
    Route::post('/quota/cadastrar', 'QuotaController@cadastrar');
    Route::post('/quota/gravar', 'QuotaController@gravar');
    Route::post('/quota/atualizar', 'QuotaController@atualizar');
    Route::get('/quota/listar', 'QuotaController@listar');
    Route::get('/quota/editar/{id}', 'QuotaController@editar');
    Route::get('/quota/ativar/{id}', 'QuotaController@ativar');
    Route::get('/quota/bloquear/{id}', 'QuotaController@bloquear');
    Route::get('/quota/receber/{id}', 'QuotaController@receber');
    Route::get('/quota/apagar/{id}', 'QuotaController@apagar');

    Route::get('/fundodecaixa/cadastrar', 'FundodecaixaController@cadastrar');
    Route::post('/fundodecaixa/cadastrar', 'FundodecaixaController@cadastrar');
    Route::post('/fundodecaixa/gravar', 'FundodecaixaController@gravar');
    Route::post('/fundodecaixa/atualizar', 'FundodecaixaController@atualizar');
    Route::get('/fundodecaixa/listar', 'FundodecaixaController@listar');
    Route::get('/fundodecaixa/editar/{id}', 'FundodecaixaController@editar');
    Route::get('/fundodecaixa/ativar/{id}', 'FundodecaixaController@ativar');
    Route::get('/fundodecaixa/bloquear/{id}', 'FundodecaixaController@bloquear');
    Route::get('/fundodecaixa/receber/{id}', 'FundodecaixaController@receber');
    Route::get('/fundodecaixa/apagar/{id}', 'FundodecaixaController@apagar');

    Route::get('/importarcasadalavoura/listarclientes', 'ImportarcasadalavouraController@listarclientes');
    Route::get('/importarcasadalavoura/importarclientes', 'ImportarcasadalavouraController@importarclientes');
    Route::get('/importarcasadalavoura/listarfornecedores', 'ImportarcasadalavouraController@listarfornecedores');

    Route::get('/importarcooperbrasil/listarclientes', 'ImportarcooperbrasilController@listarclientes');
    Route::get('/importarcooperbrasil/importarclientes', 'ImportarcooperbrasilController@importarclientes');
    Route::get('/importarcooperbrasil/listarfornecedores', 'ImportarcooperbrasilController@listarfornecedores');
    Route::get('/importarcooperbrasil/importarfornecedores', 'ImportarcooperbrasilController@importarfornecedores');
    Route::get('/importarcooperbrasil/listarveiculos', 'ImportarcooperbrasilController@listarveiculos');
    Route::get('/importarcooperbrasil/importarveiculos', 'ImportarcooperbrasilController@importarveiculos');
    Route::get('/importarcooperbrasil/listarcontratos', 'ImportarcooperbrasilController@listarcontratos');
    Route::get('/importarcooperbrasil/importarcontratos', 'ImportarcooperbrasilController@importarcontratos');
    Route::get('/importarcooperbrasil/listarfinanceiros', 'ImportarcooperbrasilController@listarfinanceiros');
    Route::get('/importarcooperbrasil/importarfinanceiros', 'ImportarcooperbrasilController@importarfinanceiros');

    Route::get('/configuracao/editar', 'ConfiguracaoController@editar');
    Route::post('/configuracao/atualizar', 'ConfiguracaoController@atualizar');

    Route::get('/permissaousuario/listarusuarios', 'PermissaoUsuarioController@listarusuarios');
    Route::get('/permissaousuario/listar/{id}', 'PermissaoUsuarioController@listar');
    Route::get('/permissaousuario/listarfiltro', 'PermissaoUsuarioController@listarfiltro');
    Route::post('/permissaousuario/listarfiltro', 'PermissaoUsuarioController@listarfiltro');
    Route::get('/permissaousuario/ativar/{id}', 'PermissaoUsuarioController@ativar');
    Route::get('/permissaousuario/bloquear/{id}', 'PermissaoUsuarioController@bloquear');

    Route::get('/usuarios/cadastrar', 'UsuarioController@cadastrar');
    Route::post('/usuarios/cadastrar', 'UsuarioController@cadastrar');
    Route::post('/usuarios/gravar', 'UsuarioController@gravar');
    Route::get('/usuarios/listar', 'UsuarioController@listar');
    Route::any('/usuarios/atualizarsenha', 'UsuarioController@atualizarsenha');
    Route::post('/usuarios/atualizar', 'UsuarioController@atualizar');
    Route::get('/usuarios/editar/{id}', 'UsuarioController@editar');
    Route::get('/usuarios/bloquear/{id}', 'UsuarioController@bloquear');
    Route::get('/usuarios/perfil', 'UsuarioController@perfil');
    Route::get('/usuarios/alterarsenha', 'UsuarioController@alterarsenha');
    Route::get('/usuarios/ativar/{id}', 'UsuarioController@ativar');
    Route::get('/usuarios/apagar/{id}', 'UsuarioController@apagar');

    Route::get('/empresa/cadastrar', 'EmpresaController@cadastrar');
    Route::get('/empresa/editar/{id}', 'EmpresaController@editar');
    Route::get('/empresa/listar', 'EmpresaController@listar');
    Route::post('/empresa/gravar', 'EmpresaController@gravar');
    Route::post('/empresa/atualizar', 'EmpresaController@atualizar');
    Route::get('/empresa/bloquear/{id}', 'EmpresaController@bloquear');
    Route::get('/empresa/ativar/{id}', 'EmpresaController@ativar');

    Route::get('/veiculo/cadastrar', 'VeiculoController@cadastrar');
    Route::post('/veiculo/cadastrar', 'VeiculoController@cadastrar');
    Route::post('/veiculo/gravar', 'VeiculoController@gravar');
    Route::post('/veiculo/atualizar', 'VeiculoController@atualizar');
    Route::get('/veiculo/listar', 'VeiculoController@listar');
    Route::get('/veiculo/editar/{id}', 'VeiculoController@editar');
    Route::get('/veiculo/ativar/{id}', 'VeiculoController@ativar');
    Route::get('/veiculo/bloquear/{id}', 'VeiculoController@bloquear');
    Route::get('/veiculo/veiculo1', 'VeiculoController@veiculo1');
    Route::get('/veiculo/veiculo2', 'VeiculoController@veiculo2');
    Route::get('/veiculo/veiculo3', 'VeiculoController@veiculo3');
    Route::get('/veiculo/apagar/{id}', 'VeiculoController@apagar');

    Route::get('/veiculotransportadora/cadastrar', 'VeiculotransportadoraController@cadastrar');
    Route::post('/veiculotransportadora/cadastrar', 'VeiculotransportadoraController@cadastrar');
    Route::post('/veiculotransportadora/gravar', 'VeiculotransportadoraController@gravar');
    Route::post('/veiculotransportadora/atualizar', 'VeiculotransportadoraController@atualizar');
    Route::get('/veiculotransportadora/listar', 'VeiculotransportadoraController@listar');
    Route::get('/veiculotransportadora/editar/{id}', 'VeiculotransportadoraController@editar');
    Route::get('/veiculotransportadora/ativar/{id}', 'VeiculotransportadoraController@ativar');
    Route::get('/veiculotransportadora/bloquear/{id}', 'VeiculotransportadoraController@bloquear');
    Route::get('/veiculotransportadora/veiculo1', 'VeiculotransportadoraController@veiculo1');
    Route::get('/veiculotransportadora/veiculo2', 'VeiculotransportadoraController@veiculo2');
    Route::get('/veiculotransportadora/veiculo3', 'VeiculotransportadoraController@veiculo3');
    Route::get('/veiculotransportadora/apagar/{id}', 'VeiculotransportadoraController@apagar');
    
    Route::get('/associacaoveiculo/cadastrar', 'AssociacaoveiculoController@cadastrar');
    Route::post('/associacaoveiculo/cadastrar', 'AssociacaoveiculoController@cadastrar');
    Route::post('/associacaoveiculo/gravar', 'AssociacaoveiculoController@gravar');
    Route::post('/associacaoveiculo/atualizar', 'AssociacaoveiculoController@atualizar');
    Route::get('/associacaoveiculo/listar', 'AssociacaoveiculoController@listar');
    Route::get('/associacaoveiculo/editar/{id}', 'AssociacaoveiculoController@editar');
    Route::get('/associacaoveiculo/ativar/{id}', 'AssociacaoveiculoController@ativar');
    Route::get('/associacaoveiculo/bloquear/{id}', 'AssociacaoveiculoController@bloquear');
    Route::get('/associacaoveiculo/apagar/{id}', 'AssociacaoveiculoController@apagar');
    
    Route::get('/contratoviagem/cadastrar', 'ContratoviagemController@cadastrar');
    Route::post('/contratoviagem/cadastrar', 'ContratoviagemController@cadastrar');
    Route::post('/contratoviagem/gravar', 'ContratoviagemController@gravar');
    Route::post('/contratoviagem/atualizar', 'ContratoviagemController@atualizar');
    Route::get('/contratoviagem/listar', 'ContratoviagemController@listar');
    Route::get('/contratoviagem/editar/{id}', 'ContratoviagemController@editar');
    Route::get('/contratoviagem/imprimircontrato/{id}', 'ContratoviagemController@imprimircontrato');
    Route::get('/contratoviagem/ativar/{id}', 'ContratoviagemController@ativar');
    Route::get('/contratoviagem/bloquear/{id}', 'ContratoviagemController@bloquear');
    Route::get('/contratoviagem/apagar/{id}', 'ContratoviagemController@apagar');

    Route::get('/viagem/cadastrar', 'ViagemController@cadastrar');
    Route::post('/viagem/cadastrar', 'ViagemController@cadastrar');
    Route::post('/viagem/gravar', 'ViagemController@gravar');
    Route::post('/viagem/atualizar', 'ViagemController@atualizar');
    Route::get('/viagem/listar', 'ViagemController@listar');
    Route::get('/viagem/listadepassageiros/{id}', 'ViagemController@listadepassageiros');
    Route::get('/viagem/editar/{id}', 'ViagemController@editar');
    Route::get('/viagem/ativar/{id}', 'ViagemController@ativar');
    Route::get('/viagem/bloquear/{id}', 'ViagemController@bloquear');

    Route::get('/agenda/cadastrar', 'AgendaController@cadastrar');
    Route::post('/agenda/cadastrar', 'AgendaController@cadastrar');
    Route::post('/agenda/gravar', 'AgendaController@gravar');
    Route::post('/agenda/atualizar', 'AgendaController@atualizar');
    Route::get('/agenda/listar', 'AgendaController@listar');
    Route::get('/agenda/editar/{id}', 'AgendaController@editar');
    Route::get('/agenda/ativar/{id}', 'AgendaController@ativar');
    Route::get('/agenda/bloquear/{id}', 'AgendaController@bloquear');
    Route::get('/agenda/apagar/{id}', 'AgendaController@apagar');

    Route::get('/passagem/cadastrar', 'PassagemController@cadastrar');
    Route::post('/passagem/cadastrar', 'PassagemController@cadastrar');
    Route::post('/passagem/gravar', 'PassagemController@gravar');
    Route::post('/passagem/atualizar', 'PassagemController@atualizar');
    Route::get('/passagem/listar', 'PassagemController@listar');
    Route::get('/passagem/editar/{id}', 'PassagemController@editar');
    Route::get('/passagem/comprar/{id}', 'PassagemController@comprar');
    Route::post('/passagem/comprar2', 'PassagemController@comprar2');
    Route::post('/passagem/comprargravar', 'PassagemController@comprargravar');
    Route::get('/passagem/ativar/{id}', 'PassagemController@ativar');
    Route::get('/passagem/bloquear/{id}', 'PassagemController@bloquear');
    Route::get('/passagem/apagar/{id}', 'PassagemController@apagar');

    Route::get('/conveniado/cadastrar/{id}', 'ConveniadoController@cadastrar');
    Route::get('/conveniado/cadastrar', 'ConveniadoController@cadastrar');
    Route::post('/conveniado/cadastrar', 'ConveniadoController@cadastrar');
    Route::post('/conveniado/gravar', 'ConveniadoController@gravar');
    Route::post('/conveniado/cadastrar/gravar', 'ConveniadoController@gravar');
    Route::post('/conveniado/atualizar', 'ConveniadoController@atualizar');
    Route::get('/conveniado/historicoconsultas', 'ConveniadoController@historicoconsultas');
    Route::get('/conveniado/listar', 'ConveniadoController@listar');
    Route::get('/conveniado/listar2', 'ConveniadoController@listar2');
    Route::get('/conveniado/listar3', 'ConveniadoController@listar3');
    Route::post('/conveniado/imprimelista', 'ConveniadoController@imprimelista');
    Route::get('/conveniado/imprimelista', 'ConveniadoController@imprimelista');
    Route::get('/conveniado/exportaXLSX', 'ConveniadoController@exportaXLSX');
    Route::get('/conveniado/exportaPDF', 'ConveniadoController@exportaPDF');
    Route::get('/conveniado/listarfiltro', 'ConveniadoController@listarfiltro');
    Route::post('/conveniado/listarfiltro', 'ConveniadoController@listarfiltro');
    Route::get('/conveniado/editar/{id}', 'ConveniadoController@editar');
    Route::get('/conveniado/ativar/{id}', 'ConveniadoController@ativar');
    Route::get('/conveniado/bloquear/{id}', 'ConveniadoController@bloquear');
    Route::get('/conveniado/apagar/{id}', 'ConveniadoController@apagar');
    Route::post('/conveniado/utilizarbeneficio', 'ConveniadoController@utilizarbeneficio');
    Route::post('/conveniado/consultarcartao', 'ConveniadoController@consultarcartao');
    Route::get('/conveniado/consultarficha', 'ConveniadoController@consultarficha');
    Route::get('/conveniado/ficha/{id}', 'ConveniadoController@ficha');
    Route::get('/conveniado/confirmarpagamento/{id}', 'ConveniadoController@confirmarpagamento');
    Route::get('/conveniado/cadastrosnovos', 'ConveniadoController@cadastrosnovos');
    Route::get('/conveniado/cadastrospendentes', 'ConveniadoController@cadastrospendentes');
    Route::get('/conveniado/cadastrosvencidos', 'ConveniadoController@cadastrosvencidos');
        
    Route::get('/convenioatendimento/cadastrar', 'ConvenioatendimentoController@cadastrar');
    Route::post('/convenioatendimento/gravar', 'ConvenioatendimentoController@gravar');
    Route::post('/convenioatendimento/atualizar', 'ConvenioatendimentoController@atualizar');
    Route::get('/convenioatendimento/listar', 'ConvenioatendimentoController@listar');
    Route::get('/convenioatendimento/relatorio', 'ConvenioatendimentoController@relatorio');
    Route::get('/convenioatendimento/editar/{id}', 'ConvenioatendimentoController@editar');
    Route::get('/convenioatendimento/ativar/{id}', 'ConvenioatendimentoController@ativar');
    Route::get('/convenioatendimento/bloquear/{id}', 'ConvenioatendimentoController@bloquear');
    Route::get('/convenioatendimento/apagar/{id}', 'ConvenioatendimentoController@apagar');

    Route::get('/credenciado/cadastrar', 'CredenciadoController@cadastrar');
    Route::post('/credenciado/cadastrar', 'CredenciadoController@cadastrar');
    Route::post('/credenciado/gravar', 'CredenciadoController@gravar');
    Route::post('/credenciado/atualizar', 'CredenciadoController@atualizar');
    Route::get('/credenciado/listar', 'CredenciadoController@listar');
    Route::get('/credenciado/editar/{id}', 'CredenciadoController@editar');
    Route::get('/credenciado/listarusuarios/{id}', 'CredenciadoController@listarusuarios');
    Route::post('/credenciado/listarusuarios/gravar', 'CredenciadoController@gravarusuarios');
    Route::get('/credenciado/apagarusuario/{id}/{credenciado_id}', 'CredenciadoController@apagarusuario');
    Route::get('/credenciado/bloquearusuario/{id}/{credenciado_id}', 'CredenciadoController@bloquearusuario');
    Route::get('/credenciado/ativarusuario/{id}/{credenciado_id}', 'CredenciadoController@ativarusuario');
    Route::get('/credenciado/ativar/{id}', 'CredenciadoController@ativar');
    Route::get('/credenciado/bloquear/{id}', 'CredenciadoController@bloquear');
    Route::get('/credenciado/apagar/{id}', 'CredenciadoController@apagar');

    Route::get('/cartao/visualizar/{id}', 'CartaoController@visualizar');
    Route::get('/cartao/cadastrar', 'CartaoController@cadastrar');
    Route::post('/cartao/gravar', 'CartaoController@gravar');
    Route::post('/cartao/atualizar', 'CartaoController@atualizar');
    Route::get('/cartao/listar', 'CartaoController@listar');
    Route::get('/cartao/listaraguardandoentrega', 'CartaoController@listaraguardandoentrega');
    Route::get('/cartao/listaraguardandopedido', 'CartaoController@listaraguardandopedido');
    Route::get('/cartao/listarvencido', 'CartaoController@listarvencido');
    Route::get('/cartao/controle', 'CartaoController@controle');
    Route::get('/cartao/editar/{id}', 'CartaoController@editar');
    Route::get('/cartao/pdf/{id}', 'CartaoController@pdf');
    Route::get('/cartao/ativar/{id}', 'CartaoController@ativar');
    Route::get('/cartao/bloquear/{id}', 'CartaoController@bloquear');
    Route::get('/cartao/produzir/{id}', 'CartaoController@produzir');
    Route::get('/cartao/desproduzir/{id}', 'CartaoController@desproduzir');
    Route::get('/cartao/entregar/{id}', 'CartaoController@entregar');
    Route::get('/cartao/desentregar/{id}', 'CartaoController@desentregar');
    Route::get('/cartao/cartoesentregues', 'CartaoController@cartoesentregues');
    Route::get('/cartao/cartoesparaentregar', 'CartaoController@cartoesparaentregar');
    Route::get('/cartao/cartoesaguardandopedido', 'CartaoController@cartoesaguardandopedido');

    Route::get('/plano/visualizar/{id}', 'PlanoController@visualizar');
    Route::get('/plano/cadastrar', 'PlanoController@cadastrar');
    Route::post('/plano/gravar', 'PlanoController@gravar');
    Route::post('/plano/atualizar', 'PlanoController@atualizar');
    Route::get('/plano/listar', 'PlanoController@listar');
    Route::get('/plano/editar/{id}', 'PlanoController@editar');
    Route::get('/plano/ativar/{id}', 'PlanoController@ativar');
    Route::get('/plano/bloquear/{id}', 'PlanoController@bloquear');

    Route::get('/contratoconvenio/cadastrar', 'ContratoconvenioController@cadastrar');
    Route::post('/contratoconvenio/cadastrar', 'ContratoconvenioController@cadastrar');
    Route::get('/contratoconvenio/cadastrar2/{id}', 'ContratoconvenioController@cadastrar2');
    Route::get('/contratoconvenio/assinarcontrato/{id}', 'ContratoconvenioController@assinarcontrato');
    Route::post('/contratoconvenio/gravar', 'ContratoconvenioController@gravar');
    Route::post('/contratoconvenio/atualizar', 'ContratoconvenioController@atualizar');
    Route::get('/contratoconvenio/listar', 'ContratoconvenioController@listar');
    Route::get('/contratoconvenio/listar2', 'ContratoconvenioController@listar2');
    Route::get('/contratoconvenio/editar/{id}', 'ContratoconvenioController@editar');
    Route::get('/contratoconvenio/imprimircontrato/{id}', 'ContratoconvenioController@imprimircontrato');
    Route::get('/contratoconvenio/ativar/{id}', 'ContratoconvenioController@ativar');
    Route::get('/contratoconvenio/bloquear/{id}', 'ContratoconvenioController@bloquear');
    Route::get('/contratoconvenio/apagar/{id}', 'ContratoconvenioController@apagar');
    Route::get('/contratoconvenio/novoscontratos', 'ContratoconvenioController@novoscontratos');
    Route::get('/contratoconvenio/contratosvencidos', 'ContratoconvenioController@contratosvencidos');
    
    Route::get('/animal/cadastrar', 'AnimalController@cadastrar');
    Route::post('/animal/gravar', 'AnimalController@gravar');
    Route::post('/animal/atualizar', 'AnimalController@atualizar');
    Route::get('/animal/listar', 'AnimalController@listar');
    Route::get('/animal/listarfiltro', 'AnimalController@listarfiltro');
    Route::post('/animal/listarfiltro', 'AnimalController@listarfiltro');
    Route::get('/animal/editar/{id}', 'AnimalController@editar');
    Route::get('/animal/ativar/{id}', 'AnimalController@ativar');
    Route::get('/animal/bloquear/{id}', 'AnimalController@bloquear');
    Route::get('/animal/ficha/{id}', 'AnimalController@ficha');
    Route::get('/animal/apagar/{id}', 'AnimalController@apagar');

    Route::get('/alimento/cadastrar', 'AlimentoController@cadastrar');
    Route::post('/alimento/gravar', 'AlimentoController@gravar');
    Route::post('/alimento/atualizar', 'AlimentoController@atualizar');
    Route::get('/alimento/listar', 'AlimentoController@listar');
    Route::get('/alimento/listarfiltro', 'AlimentoController@listarfiltro');
    Route::post('/alimento/listarfiltro', 'AlimentoController@listarfiltro');
    Route::get('/alimento/editar/{id}', 'AlimentoController@editar');
    Route::get('/alimento/ativar/{id}', 'AlimentoController@ativar');
    Route::get('/alimento/bloquear/{id}', 'AlimentoController@bloquear');
    Route::get('/alimento/apagar/{id}', 'AlimentoController@apagar');

    Route::get('/alimentacao/cadastrar', 'AlimentacaoController@cadastrar');
    Route::post('/alimentacao/gravar', 'AlimentacaoController@gravar');
    Route::post('/alimentacao/atualizar', 'AlimentacaoController@atualizar');
    Route::get('/alimentacao/listar', 'AlimentacaoController@listar');
    Route::get('/alimentacao/editar/{id}', 'AlimentacaoController@editar');
    Route::get('/alimentacao/ativar/{id}', 'AlimentacaoController@ativar');
    Route::get('/alimentacao/bloquear/{id}', 'AlimentacaoController@bloquear');
    Route::get('/alimentacao/apagar/{id}', 'AlimentacaoController@apagar');

    Route::get('/producao/cadastrar', 'ProducaoController@cadastrar');
    Route::post('/producao/cadastrar', 'ProducaoController@cadastrar');
    Route::get('/producao/cadastrargrupo', 'ProducaoController@cadastrargrupo');
    Route::post('/producao/gravar', 'ProducaoController@gravar');
    Route::post('/producao/gravargrupo', 'ProducaoController@gravargrupo');
    Route::post('/producao/atualizar', 'ProducaoController@atualizar');
    Route::get('/producao/listar', 'ProducaoController@listar');
    Route::get('/producao/listarfiltro', 'ProducaoController@listarfiltro');
    Route::post('/producao/listarfiltro', 'ProducaoController@listarfiltro');
    Route::get('/producao/editar/{id}', 'ProducaoController@editar');
    Route::get('/producao/ativar/{id}', 'ProducaoController@ativar');
    Route::get('/producao/bloquear/{id}', 'ProducaoController@bloquear');
    Route::get('/producao/apagar/{id}', 'ProducaoController@apagar');

    Route::get('/vacina/cadastrar', 'VacinaController@cadastrar');
    Route::get('/vacina/vacinargrupo', 'VacinaController@vacinargrupo');
    Route::get('/vacina/relatorio', 'VacinaController@relatorio');
    Route::post('/vacina/cadastrar', 'VacinaController@cadastrar');
    Route::post('/vacina/gravar', 'VacinaController@gravar');
    Route::post('/vacina/atualizar', 'VacinaController@atualizar');
    Route::get('/vacina/listar', 'VacinaController@listar');
    Route::get('/vacina/listarfiltro', 'VacinaController@listarfiltro');
    Route::post('/vacina/listarfiltro', 'VacinaController@listarfiltro');
    Route::get('/vacina/editar/{id}', 'VacinaController@editar');
    Route::get('/vacina/ativar/{id}', 'VacinaController@ativar');
    Route::get('/vacina/bloquear/{id}', 'VacinaController@bloquear');
    Route::get('/vacina/apagar/{id}', 'VacinaController@apagar');

    Route::get('/vacinacao/cadastrar', 'VacinacaoController@cadastrar');
    Route::get('/vacinacao/cadastrargrupo', 'VacinacaoController@cadastrargrupo');
    Route::get('/vacinacao/listar', 'VacinacaoController@listar');
    Route::get('/vacinacao/relatorio', 'VacinacaoController@relatorio');
    Route::post('/vacinacao/gravar', 'VacinacaoController@gravar');
    Route::post('/vacinacao/gravargrupo', 'VacinacaoController@gravargrupo');
    Route::post('/vacinacao/atualizar', 'VacinacaoController@atualizar');
    Route::get('/vacinacao/editar/{id}', 'VacinacaoController@editar');
    Route::get('/vacinacao/ativar/{id}', 'VacinacaoController@ativar');
    Route::get('/vacinacao/bloquear/{id}', 'VacinacaoController@bloquear');

    Route::get('/inseminacao/cadastrar', 'InseminacaoController@cadastrar');
    Route::get('/inseminacao/cadastrar/{id}', 'InseminacaoController@cadastrar');
    Route::post('/inseminacao/cadastrar', 'InseminacaoController@cadastrar');
    Route::post('/inseminacao/gravar', 'InseminacaoController@gravar');
    Route::post('/inseminacao/atualizar', 'InseminacaoController@atualizar');
    Route::get('/inseminacao/listar', 'InseminacaoController@listar');
    Route::get('/inseminacao/relatorio', 'InseminacaoController@relatorio');
    Route::get('/inseminacao/ficha/{id}', 'InseminacaoController@ficha');
    Route::get('/inseminacao/editar/{id}', 'InseminacaoController@editar');
    Route::get('/inseminacao/ativar/{id}', 'InseminacaoController@ativar');
    Route::get('/inseminacao/bloquear/{id}', 'InseminacaoController@bloquear');
    Route::get('/inseminacao/apagar/{id}', 'InseminacaoController@apagar');

    Route::get('/gestacao/cadastrar', 'GestacaoController@cadastrar');
    Route::post('/gestacao/cadastrar', 'GestacaoController@cadastrar');
    Route::post('/gestacao/gravar', 'GestacaoController@gravar');
    Route::post('/gestacao/atualizar', 'GestacaoController@atualizar');
    Route::get('/gestacao/listar', 'GestacaoController@listar');
    Route::get('/gestacao/editar/{id}', 'GestacaoController@editar');
    Route::get('/gestacao/ativar/{id}', 'GestacaoController@ativar');
    Route::get('/gestacao/bloquear/{id}', 'GestacaoController@bloquear');

    Route::get('/parto/cadastrar', 'PartoController@cadastrar');
    Route::post('/parto/cadastrar', 'PartoController@cadastrar');
    Route::post('/parto/gravar', 'PartoController@gravar');
    Route::post('/parto/atualizar', 'PartoController@atualizar');
    Route::get('/parto/listar', 'PartoController@listar');
    Route::get('/parto/editar/{id}', 'PartoController@editar');
    Route::get('/parto/ativar/{id}', 'PartoController@ativar');
    Route::get('/parto/bloquear/{id}', 'PartoController@bloquear');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/limpar', function () {
    print $exitCode = Artisan::call('cache:clear');
    // return what you want
    return redirect('/login');
});
