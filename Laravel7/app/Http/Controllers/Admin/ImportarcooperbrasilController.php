<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use App\Cliente;
use App\Fornecedor;
use App\Usuario;
use App\Veiculo;

class ImportarcooperbrasilController extends Controller {

    public function listarclientes() {
        $clientes = DB::connection('cooperbrasil')
                ->table('CLIENTES')
                ->orderBy('ID_CLIENTE')
                ->get();
        $clientescadastrados = DB::table('clientes')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($clientes as $cliente) {
            $cliente->importar = 1;
            foreach ($clientescadastrados as $cc) {
                if ($cliente->CPF == $cc->cpfcnpj || $cliente->CNPJ == $cc->cpfcnpj)
                    $cliente->importar = 0;
            }
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'RAZAO', 'width' => 2],
            ['label' => 'FANTASIA', 'width' => 2],
            ['label' => 'CPF', 'width' => 2],
            ['label' => 'CNPJ', 'width' => 2],
            ['label' => 'Data', 'width' => 1],
            ['label' => 'Ação', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null],
        ];
        return view('admin.importarcooperbrasil.listarclientes', compact('clientes', 'clientescadastrados', 'cabecalho', 'config'));
    }

    public function importarclientes() {
        $clientes = DB::connection('cooperbrasil')
                ->table('CLIENTES')
                ->orderBy('ID_CLIENTE')
                ->get();
        foreach ($clientes as $cliente) {
            DB::connection('basesistema')
                    ->table('clientes')
                    ->updateOrInsert(
                            ["id" => $cliente->ID_CLIENTE],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "nome" => e($cliente->FANTASIA ? $cliente->FANTASIA : ($cliente->RAZAO ? $cliente->RAZAO : ($cliente->CPF ? $cliente->CPF : $cliente->CNPJ))),
                                "razaosocial" => e($cliente->RAZAO),
                                "cpfcnpj" => e($cliente->CPF ? $cliente->CPF : $cliente->CNPJ),
                                "rgie" => e($cliente->RG ? $cliente->RG : $cliente->IE),
                                "nascimento" => $cliente->DATA_NASCIMENTO ? $cliente->DATA_NASCIMENTO : $cliente->DATA_ABERTURA,
                                "tel1" => e($cliente->FONE1),
                                "tel2" => e($cliente->FONE2),
                                "sexo" => 'M',
                                "logradouro" => e($cliente->END_TIPO . " " . $cliente->END_LOGRADOURO),
                                "numero" => e($cliente->END_NUMERO),
                                "bairro" => e($cliente->END_BAIRRO),
                                "complemento" => e($cliente->END_COMPL),
                                "cidade" => e($cliente->END_CIDADE),
                                "estado" => e($cliente->END_ESTADO),
                                "cep" => e($cliente->END_CEP),
                                "observacoes" => e($cliente->OBSERVACAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                                "created_at" => $cliente->DATA_CADASTRO,
                                "updated_at" => date('Y-m-d'),
                                "email" => e($cliente->EMAIL1),
                                "contatonome" => e($cliente->CONTATO),
                                "contatotelefone" => e($cliente->FONE3),
                                "contatoemail" => e($cliente->EMAIL2)
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('clientes')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE clientes_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);
        
        return redirect('importarcooperbrasil/listarclientes')->withInput();
    }

    public function listarfornecedores() {
        $fornecedores = DB::connection('cooperbrasil')
                ->table('FORNECEDORES')
                ->orderBy('RAZAO')
                ->get();
        $fornecedorescadastrados = DB::table('fornecedores')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($fornecedores as $fornecedor) {
            $fornecedor->importar = 1;
            foreach ($fornecedorescadastrados as $fc) {
                if ($fornecedor->CPF == $fc->cpfcnpj || $fornecedor->CNPJ == $fc->cpfcnpj)
                    $fornecedor->importar = 0;
            }
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'RAZAO', 'width' => 2],
            ['label' => 'CIDADE', 'width' => 2],
            ['label' => 'CPF', 'width' => 2],
            ['label' => 'CNPJ', 'width' => 2],
            ['label' => 'Data', 'width' => 1],
            ['label' => 'Ação', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null],
        ];
        return view('admin.importarcooperbrasil.listarfornecedores', compact('fornecedores', 'fornecedorescadastrados', 'cabecalho', 'config'));
    }

    public function importarfornecedores() {
        $fornecedores = DB::connection('cooperbrasil')
                ->table('FORNECEDORES')
                ->orderBy('ID_FORNECEDOR')
                ->get();
        foreach ($fornecedores as $fornecedor) {
            DB::connection('basesistema')
                    ->table('fornecedores')
                    ->updateOrInsert(
                            ["id" => $fornecedor->ID_FORNECEDOR],
                            [
                                "empresa_id" => Usuario::empresa(),
                                //"nome" => e($cliente->FANTASIA ? $cliente->FANTASIA : ($cliente->RAZAO ? $cliente->RAZAO : ($cliente->CPF ? $cliente->CPF : $cliente->CNPJ))),
                                "nome" => e($fornecedor->RAZAO),
                                "razaosocial" => e($fornecedor->RAZAO),
                                "cpfcnpj" => e($fornecedor->CPF ? $fornecedor->CPF : $fornecedor->CNPJ),
                                "rgie" => e($fornecedor->RG ? $fornecedor->RG : $fornecedor->IE),
                                "nascimento" => null,
                                "tel1" => e($fornecedor->FONE1),
                                "tel2" => e($fornecedor->FONE2),
                                "logradouro" => e($fornecedor->END_TIPO . " " . $fornecedor->END_LOGRADOURO),
                                "numero" => e($fornecedor->END_NUMERO),
                                "bairro" => e($fornecedor->END_BAIRRO),
                                "complemento" => e($fornecedor->END_COMPL),
                                "cidade" => e($fornecedor->END_CIDADE),
                                "estado" => e($fornecedor->END_ESTADO),
                                "cep" => e($fornecedor->END_CEP),
                                "observacoes" => null,
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                                "created_at" => $fornecedor->DATA_CADASTRO,
                                "updated_at" => date('Y-m-d'),
                                "email" => e($fornecedor->EMAIL),
                                "contatonome" => e($fornecedor->CONTATO),
                                "contatotelefone" => e($fornecedor->FONE3),
                                "contatoemail" => e($fornecedor->EMAIL),
                            ]
            );
        }

        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('fornecedores')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE fornecedores_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);
        
        return redirect('importarcooperbrasil/listarfornecedores')->withInput();
    }

    public function listarveiculos() {
        $veiculos = DB::connection('cooperbrasil')
                ->table('VEICULOS')
                ->get();
        $veiculoscadastrados = DB::table('veiculos')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($veiculos as $veiculo) {
            $veiculo->importar = 1;
            foreach ($veiculoscadastrados as $vc) {
                if ($veiculo->PLACA == $vc->placa || $veiculo->PLACA == "")
                    $veiculo->importar = 0;
            }
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Placa', 'width' => 2],
            ['label' => 'Nome do Proprietário', 'width' => 5],
            ['label' => 'Cidade / Estado', 'width' => 3],
            ['label' => 'CNPJ / CPF', 'width' => 1],
            ['label' => 'Data Cadastro', 'width' => 1],
            ['label' => 'Ações', 'width' => 2],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null],
        ];
        return view('admin.importarcooperbrasil.listarveiculos', compact('veiculos', 'veiculoscadastrados', 'cabecalho', 'config'));
    }

    public function importarveiculos() {
        $marcas = DB::connection('cooperbrasil')
                ->table('VEIC_MARCA')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($marcas as $marca) {
            DB::connection('basesistema')
                    ->table('veiculosmarca')
                    ->updateOrInsert(
                            ["id" => $marca->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "marca" => e($marca->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculosmarca')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculosmarca_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculostipos = DB::connection('cooperbrasil')
                ->table('VEIC_TIPOVEICULO')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculostipos as $veiculostipo) {
            DB::connection('basesistema')
                    ->table('veiculostipo')
                    ->updateOrInsert(
                            ["id" => $veiculostipo->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "tipo" => e($veiculostipo->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculostipo')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculostipo_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculospropriedades = DB::connection('cooperbrasil')
                ->table('VEIC_PROPRIEDADE')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculospropriedades as $veiculospropriedade) {
            DB::connection('basesistema')
                    ->table('veiculospropriedade')
                    ->updateOrInsert(
                            ["id" => $veiculospropriedade->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "propriedade" => e($veiculospropriedade->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculospropriedade')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculospropriedade_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoscores = DB::connection('cooperbrasil')
                ->table('VEIC_COR')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoscores as $veiculoscor) {
            DB::connection('basesistema')
                    ->table('veiculoscor')
                    ->updateOrInsert(
                            ["id" => $veiculoscor->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "cor" => e($veiculoscor->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoscor')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoscor_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoscategorias = DB::connection('cooperbrasil')
                ->table('VEIC_CATEGORIA')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoscategorias as $veiculoscategoria) {
            DB::connection('basesistema')
                    ->table('veiculoscategoria')
                    ->updateOrInsert(
                            ["id" => $veiculoscategoria->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "categoria" => e($veiculoscategoria->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoscategoria')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoscategoria_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoscombustivels = DB::connection('cooperbrasil')
                ->table('VEIC_COMBUSTIVEL')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoscombustivels as $veiculoscombustivel) {
            DB::connection('basesistema')
                    ->table('veiculoscombustivel')
                    ->updateOrInsert(
                            ["id" => $veiculoscombustivel->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "combustivel" => e($veiculoscombustivel->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoscombustivel')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoscombustivel_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculosespecies = DB::connection('cooperbrasil')
                ->table('VEIC_ESPECIE')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculosespecies as $veiculosespecie) {
            DB::connection('basesistema')
                    ->table('veiculosespecie')
                    ->updateOrInsert(
                            ["id" => $veiculosespecie->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "especie" => e($veiculosespecie->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculosespecie')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculosespecie_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculosrodados = DB::connection('cooperbrasil')
                ->table('VEIC_TIPORODADO')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculosrodados as $veiculosrodado) {
            DB::connection('basesistema')
                    ->table('veiculosrodado')
                    ->updateOrInsert(
                            ["id" => $veiculosrodado->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "rodado" => e($veiculosrodado->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculosrodado')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculosrodado_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoscarrocerias = DB::connection('cooperbrasil')
                ->table('VEIC_TIPOCARROCERIA')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoscarrocerias as $veiculoscarroceria) {
            DB::connection('basesistema')
                    ->table('veiculoscarroceria')
                    ->updateOrInsert(
                            ["id" => $veiculoscarroceria->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "carroceria" => e($veiculoscarroceria->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoscarroceria')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoscarroceria_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoseixos = DB::connection('cooperbrasil')
                ->table('VEIC_3EIXO')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoseixos as $veiculoseixo) {
            DB::connection('basesistema')
                    ->table('veiculoseixo')
                    ->updateOrInsert(
                            ["id" => $veiculoseixo->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "eixo" => e($veiculoseixo->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoseixo')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoseixo_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculoslinhas = DB::connection('cooperbrasil')
                ->table('VEIC_TIPOVEICULO2')
                ->where('ID_EMPRESA', 9)
                ->get();
        foreach ($veiculoslinhas as $veiculoslinha) {
            DB::connection('basesistema')
                    ->table('veiculoslinha')
                    ->updateOrInsert(
                            ["id" => $veiculoslinha->ID_CODIGO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "linha" => e($veiculoslinha->DESCRICAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculoslinha')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculoslinha_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);

        $veiculos = DB::connection('cooperbrasil')
                ->table('VEICULOS')
                ->get();
        $veiculoscadastrados = DB::table('veiculos')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($veiculos as $veiculo) {
            DB::connection('basesistema')
                    ->table('veiculos')
                    ->updateOrInsert(
                            ["id" => $veiculo->ID_VEICULOS],
                            [
                                "empresa_id" => Usuario::empresa(),
                                //"nome" => e($cliente->FANTASIA ? $cliente->FANTASIA : ($cliente->RAZAO ? $cliente->RAZAO : ($cliente->CPF ? $cliente->CPF : $cliente->CNPJ))),
                                "nome" => e($veiculo->PLACA),
                                "marcamodelo" => e($veiculo->MODELO ? $veiculo->MODELO : ""),
                                "placa" => e($veiculo->PLACA ? $veiculo->PLACA : ''),
                                "acentos" => '1',
                                "desenho" => '1',
                                "imagem" => '1',
                                "observacoes" => e($veiculo->OBS ? $veiculo->OBS : ''),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => '1',
                                "created_at" => $veiculo->DT_CAD ? $veiculo->DT_CAD : null,
                                "updated_at" => date('Y-m-d'),
                                "renavam" => e($veiculo->RENAVAM ? $veiculo->RENAVAM : ''),
                                "chassi" => e($veiculo->CHASSI ? $veiculo->CHASSI : ''),
                                "motor" => e($veiculo->MOTOR ? $veiculo->MOTOR : ''),
                                "anofabricacao" => e($veiculo->ANOFAB ? $veiculo->ANOFAB : ''),
                                "anomodelo" => e($veiculo->ANOMOD ? $veiculo->ANOMOD : ''),
                                "cidade" => e($veiculo->CIDADE ? $veiculo->CIDADE : ''),
                                "uf" => e($veiculo->UF ? $veiculo->UF : ''),
                                "antt" => e($veiculo->ANTT ? $veiculo->ANTT : ''),
                                "tara" => e($veiculo->TARA_KG ? $veiculo->TARA_KG : ''),
                                "capacidade" => e($veiculo->CAPACIDADE_KG ? $veiculo->CAPACIDADE_KG : ''),
                                "volume" => e($veiculo->CAPACIDADE_M3 ? $veiculo->CAPACIDADE_M3 : ''),
                                "cor_id" => $veiculo->ID_COR ? $veiculo->ID_COR : 1,
                                "marca_id" => $veiculo->ID_MARCA ? $veiculo->ID_MARCA : 1,
                                "especie_id" => $veiculo->ID_ESPECIE ? $veiculo->ID_ESPECIE : 1,
                                "categoria_id" => $veiculo->ID_CATEGORIA ? $veiculo->ID_CATEGORIA : 1,
                                "combustivel_id" => $veiculo->ID_COMBUSTIVEL ? $veiculo->ID_COMBUSTIVEL : 1,
                                "carroceria_id" => $veiculo->ID_TIPOCARROCERIA ? $veiculo->ID_TIPOCARROCERIA : 1,
                                "rodado_id" => $veiculo->ID_TIPORODADO ? $veiculo->ID_TIPORODADO : 1,
                                "linha_id" => $veiculo->ID_TIPOVEIC2 ? $veiculo->ID_TIPOVEIC2 : 1,
                                "propriedade_id" => $veiculo->ID_PROPRIEDADE ? $veiculo->ID_PROPRIEDADE : 1,
                                "tipo_id" => $veiculo->ID_TIPOVEICULO ? $veiculo->ID_TIPOVEICULO : 1,
                                "eixo_id" => $veiculo->ID_3EIXO ? $veiculo->ID_3EIXO : 1,
                                "cilindrada" => e($veiculo->CILINDRADA ? $veiculo->CILINDRADA : 0),
                                "valordobem" => e($veiculo->VALOR_BEM ? $veiculo->VALOR_BEM : 0),
                                "valorcompensado" => e($veiculo->VALOR_COMPENSADO ? $veiculo->VALOR_COMPENSADO : 0),
                                "porcentagem" => e($veiculo->PORCENTAGEM ? $veiculo->PORCENTAGEM : 0),
                                "franquia" => e($veiculo->FRANQUIA ? $veiculo->FRANQUIA : 0),
                                "quotaparticipacao" => e($veiculo->QUOTA_PARTICIPACAO ? $veiculo->QUOTA_PARTICIPACAO : 0),
                                "codigofipe" => e($veiculo->CODIGO_FIPE ? $veiculo->CODIGO_FIPE : ''),
                                "valorfipe" => e($veiculo->VALOR_FIPE ? $veiculo->VALOR_FIPE : 0),
                                "cliente_id" => $veiculo->ID_CLIENTE,
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('veiculos')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE veiculos_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);
        return redirect('importarcooperbrasil/listarveiculos')->withInput();
    }

    public function listarcontratos() {
        $contratos = DB::connection('cooperbrasil')
                ->table('TERMOCONTRATUAL')
                ->leftJoin('CLIENTES', 'TERMOCONTRATUAL.ID_CLIENTE', '=', 'CLIENTES.ID_CLIENTE')
                ->get();
        $contratoscadastrados = DB::table('contratoassociacaos')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($contratos as $contrato) {
            $contrato->importar = 1;
            foreach ($contratoscadastrados as $cc) {
                if ($contrato->ID_CONTRATO == $cc->id)
                    $contrato->importar = 0;
            }
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'RAZAO', 'width' => 5],
            ['label' => 'v1', 'width' => 1],
            ['label' => 'v2', 'width' => 1],
            ['label' => 'v3', 'width' => 1],
            ['label' => 'v4', 'width' => 1],
            ['label' => 'Data', 'width' => 1],
            ['label' => 'Status', 'width' => 1],
            ['label' => 'Ação', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null],
        ];
        return view('admin.importarcooperbrasil.listarcontratos', compact('contratos', 'contratoscadastrados', 'cabecalho', 'config'));
    }

    public function importarcontratos() {
        $contratos = DB::connection('cooperbrasil')
                ->table('TERMOCONTRATUAL')
                ->orderBy('ID_CONTRATO')
                ->get();
        foreach ($contratos as $contrato) {
            DB::connection('basesistema')
                    ->table('contratoassociacaos')
                    ->updateOrInsert(
                            ["id" => $contrato->ID_CONTRATO],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "cliente_id" => $contrato->ID_CLIENTE,
                                "veiculo_id1" => $contrato->ID_VEICULO1 ? $contrato->ID_VEICULO1 : null,
                                "veiculo_id2" => $contrato->ID_VEICULO2 ? $contrato->ID_VEICULO2 : null,
                                "veiculo_id3" => $contrato->ID_VEICULO3 ? $contrato->ID_VEICULO3 : null,
                                "veiculo_id4" => $contrato->ID_VEICULO4 ? $contrato->ID_VEICULO4 : null,
                                "data" => E($contrato->DATA),
                                "termo_id" => $contrato->ID_TERMO,
                                "valormensalidade" => $contrato->VALOR_MENSALIDADE,
                                "valorfundocaixa" => $contrato->VALOR_FUNDOCAIXA,
                                "valortotal" => $contrato->VALOR_TOTAL,
                                "valorterceiro" => $contrato->VALOR_TERCEIRO,
                                "nome" => e($contrato->NOME),
                                "formadepagamento_id" => 1,
                                "observacao" => e($contrato->OBSERVACAO),
                                "usuario_id" => \Illuminate\Support\Facades\Auth::user()->id,
                                "status" => ($contrato->ATIVO == 'A') ? '1' : '0',
                                "created_at" => date('Y-m-d'),
                                "updated_at" => date('Y-m-d')
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('contratoassociacaos')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE contratoassociacaos_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);
        return redirect('importarcooperbrasil/listarcontratos')->withInput();
    }

    public function listarfinanceiros() {
        $financeiros = DB::connection('cooperbrasil')
                ->table('RECEBER_CABECALHO')
                ->leftJoin('CLIENTES', 'RECEBER_CABECALHO.ID_CLIENTE', '=', 'CLIENTES.ID_CLIENTE')
                ->get();
        $financeiroscadastrados = DB::table('contasarecebers')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        foreach ($financeiros as $financeiro) {
            $financeiro->importar = 1;
            foreach ($financeiroscadastrados as $cc) {
                if ($financeiro->ID_RECEBER == $cc->id)
                    $financeiro->importar = 0;
            }
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'RAZAO', 'width' => 5],
            ['label' => 'VALOR', 'width' => 1],
            ['label' => 'PAGO', 'width' => 1],
            ['label' => 'EMISSAO', 'width' => 1],
            ['label' => 'VENCIMENTO', 'width' => 1],
            ['label' => 'PAGAMENTO', 'width' => 1],
            ['label' => 'Status', 'width' => 1],
            ['label' => 'Ação', 'width' => 1],
        ];
        $config = [
            'order' => [[3, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null],
        ];
        return view('admin.importarcooperbrasil.listarfinanceiros', compact('financeiros', 'financeiroscadastrados', 'cabecalho', 'config'));
    }

    public function importarfinanceiros() {
        $financeiros = DB::connection('cooperbrasil')
                ->table('RECEBER_CABECALHO')
                ->leftJoin('ORDEM_FORMAPAGTO', 'RECEBER_CABECALHO.ID_CLIENTE', '=', 'ORDEM_FORMAPAGTO.ID_ORDEM')
                ->orderBy('RECEBER_CABECALHO.ID_RECEBER')
                //->where('RECEBER_CABECALHO.ID_RECEBER', '>', 3500)
                //->where('RECEBER_CABECALHO.ID_RECEBER', '<', 4000)
                ->get();
        //dd($financeiros);
        foreach ($financeiros as $financeiro) {
            DB::connection('basesistema')
                    ->table('contasarecebers')
                    ->updateOrInsert(
                            ["id" => $financeiro->ID_RECEBER],
                            [
                                "empresa_id" => Usuario::empresa(),
                                "cliente_id" => $financeiro->ID_CLIENTE ? $financeiro->ID_CLIENTE : 1,
                                "descricao" => $financeiro->HISTORICO ? mb_substr(e($financeiro->HISTORICO), 0, 250, 'UTF-8') : null,
                                "valor" => $financeiro->VR_BRUTO ? $financeiro->VR_BRUTO : null,
                                "valordesconto" => $financeiro->VR_DESCTO ? $financeiro->VR_DESCTO : null,
                                "valoracrescimo" => $financeiro->VR_ACRESC ? $financeiro->VR_ACRESC : null,
                                "vencimento" => $financeiro->DT_VENCTO ? $financeiro->DT_VENCTO : null,
                                "pagamento" => $financeiro->DT_PAGTO ? $financeiro->DT_PAGTO : null,
                                "formadepagamento_id" => $financeiro->ID_ESPECIE ? $financeiro->ID_ESPECIE : null,
                                "observacao" => 'Ordem: ' . e($financeiro->ID_ORDEM) . ' - Parcela: ' . e($financeiro->PARCELA) . ' - Status: ' . e($financeiro->STATUS),
                                "usuario_id" => Usuario::id(),
                                "status" => $financeiro->STATUS='P' || $financeiro->DT_VENCTO ? 2 : 1,
                                "created_at" => $financeiro->DT_EMISSAO ? $financeiro->DT_EMISSAO : null,
                                "updated_at" => date('Y-m-d')
                            ]
            );
        }
        //Corrige sequencia do indice
        $ultimoid = DB::connection('basesistema')->table('contasarecebers')->max('id');
        $ultimoid = $ultimoid+1; $comando = "ALTER SEQUENCE contasarecebers_id_seq RESTART WITH $ultimoid";
        DB::connection('basesistema')->unprepared($comando);
        return redirect('importarcooperbrasil/listarfinanceiros')->withInput();
    }

}
