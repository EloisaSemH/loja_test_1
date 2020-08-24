<?php

class Funcionario {
    private $func_cod;
    private $func_nome;
    private $func_dataNasc;
    private $func_dataAdmissao;
    private $func_cargo;

    function getFunc_cod () {
        return $this->func_cod;
    }

    function getFunc_nome () {
        return $this->func_nome;
    }

    function getFunc_dataNasc () {
        return $this->func_dataNasc;
    }

    function getFunc_dataAdmissao () {
        return $this->func_dataAdmissao;
    }

    function getFunc_cargo () {
        return $this->func_cargo;
    }

    function setFunc_cod ($func_cod) {
        $this->func_cod = $func_cod;
    }

    function setFunc_nome ($func_nome) {
        $this->func_nome = $func_nome;
    }

    function setFunc_dataNasc ($func_dataNasc) {
        $this->func_dataNasc = $func_dataNasc;
    }

    function setFunc_dataAdmissao ($func_dataAdmissao) {
        $this->func_dataAdmissao = $func_dataAdmissao;
    }

    function setFunc_cargo ($func_cargo) {
        $this->func_cargo = $func_cargo;
    }
}
?>