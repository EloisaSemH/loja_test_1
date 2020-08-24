<?php
require_once ("conexao.class.php");
class FuncionarioDAO {
    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function CadastrarFuncionario (Funcionario $entFuncionario) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO funcionarios VALUES ('', :nome, :dataNasc, :dataAdmissao, :cargo)");
            $parametro = array (
                ":nome" => $entFuncionario->getFunc_nome(),
                ":dataNasc" => $entFuncionario->getFunc_dataNasc(),
                ":dataAdmissao" => $entFuncionario->getFunc_dataAdmissao(),
                ":cargo" => $entFuncionario->getFunc_cargo()
            );
            return $stmt->execute($parametro);
        } catch (PDOException $ex) {
            return "Erro 001: {$ex->getMessage()}";
        }
    }

    function consultarDadosFuncionario ($cod) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM funcionarios WHERE func_cod = :cod");
            $parametro = array (
                ":cod" => $cod
            );
            $stmt->execute($parametro);
        
            if($stmt->rowCount() > 0){
                // $contador = 0;
                return $stmt->fetch(PDO::FETCH_ASSOC);
                   
                // return $consulta;
            }else{
                return '';
            }
            
        }catch (PDOException $ex){
            return "ERRO 002: {$ex->getMessage()}";
        }
    }

    function AtualizarFuncionario (Funcionario $entFuncionario) {
        try {
            $stmt = $this->pdo->prepare("UPDATE funcionarios SET func_nome = :nome, func_dataNasc = :dataNasc, func_dataAdmissao = :dataAdmissao, func_cargo = :cargo WHERE func_cod = :cod");
            $parametro = array (
                ":nome" => $entFuncionario->getFunc_nome(),
                ":dataNasc" => $entFuncionario->getFunc_dataNasc(),
                ":dataAdmissao" => $entFuncionario->getFunc_dataAdmissao(),
                ":cargo" => $entFuncionario->getFunc_cargo(),
                ":cod" => $entFuncionario->getFunc_cod()
            );
            return $stmt->execute($parametro);
        } catch (PDOException $ex) {
            return "Erro 003: {$ex->getMessage()}";
        }
    }

    function ExcluirFuncionario ($cod) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM funcionarios WHERE func_cod = :cod");
            $parametro = array (
                ":cod" => $cod
            );
            return $stmt->execute($parametro);
        } catch (PDOException $ex) {
            return "Erro 004: {$ex->getMessage()}";
        }
    }

    function numeroFuncionarios () {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM funcionarios ORDER BY func_cod DESC LIMIT 100");
            $stmt->execute();
        
            return $stmt->rowCount();
            
        }catch (PDOException $ex){
            return "ERRO 005: {$ex->getMessage()}";
        }
    }

    function consultarTodosFuncionarios ($inicio, $quantpag) {
        try {
            $stmt = $this->pdo->prepare("SELECT func_cod, func_nome, func_dataNasc, func_dataAdmissao, func_cargo FROM funcionarios ORDER BY func_cod DESC LIMIT :inicio, :quantpag");
            $parametro = array(":inicio" => $inicio, ":quantpag" => $quantpag);
        
            $stmt->execute($parametro);

            if($stmt->rowCount() > 0){
                $contador = 0;
                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $consulta[$contador] = [
                        'func_cod' => $dados['func_cod'],
                        'func_nome' => $dados['func_nome'],
                        'func_dataNasc' => $dados['func_dataNasc'],
                        'func_dataAdmissao' => $dados['func_dataAdmissao'],
                        'func_cargo' => $dados['func_cargo']
                        ];
                        $contador++;
                }                    
                return $consulta;
            }else{
                return '';
            }

        }catch (PDOException $ex){
            return "ERRO 006: {$ex->getMessage()}";
        }
    }
}
