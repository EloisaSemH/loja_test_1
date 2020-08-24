<?php
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
} else {
?>
    <script type="text/javascript">
        alert('Selecione um funcionário para editar!')
        document.location.href = "funcionarios.php?pagina=1";
    </script>
<?php
}

include_once('paginas/cabecalho.php');

require_once('db/Entidades/funcionario.class.php');
require_once('db/DAO/funcionarioDAO.class.php');
$funcionario = new Funcionario();
$funcionarioDAO = new FuncionarioDAO();

$dados = $funcionarioDAO->consultarDadosFuncionario($cod);
?>
<h1>Atualizar funcionário</h1>
<form method="POST" class="text-left">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="Código">Código</label>
            <input type="number" class="form-control" name="cod" id="cod" required readonly value="<?php echo $dados['func_cod']; ?>">
        </div>
        <div class="form-group col-md-10">
            <label for="Nome">Nome</label>
            <input type="text" class="form-control" placeholder="Digite aqui o nome..." id="inputNome" name="nome" maxlength="128" required value="<?php echo $dados['func_nome']; ?>">
            <p id="retornoNome" class="m-0 mt-1 text-muted text-center">Total de caracteres restantes: <?php echo (128 - strlen($dados['func_nome'])); ?></p>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="Data de nascimento">Data de nascimento</label>
            <input type="date" class="form-control" id="dataNasc" name="dataNasc" required value="<?php echo date('Y-m-d', strtotime($dados['func_dataNasc'])); ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="Data de nascimento">Data de admissão</label>
            <input type="date" class="form-control" id="dataAdmissao" name="dataAdmissao" required value="<?php echo date('Y-m-d', strtotime($dados['func_dataAdmissao'])); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="Cargo">Cargo</label>
        <select id="cargo" name="cargo" class="form-control" required>
            <option selected value="desenvolvedor">Desenvolvedor</option>
            <option value="gestor">Gestor</option>
            <option value="auxiliar">Auxiliar</option>
        </select>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-danger mr-2" name="excluir" id="excluir"  onclick="confirmarExclusao(<?php echo $dados['func_cod']; ?>)">Excluir</button>
        <button type="submit" class="btn btn-info" name="atualizar">Atualizar</button>
    </div>
</form>
<a href="funcionarios.php">Voltar</a>
<?php
include_once('paginas/rodape.php');

if (isset($_POST['atualizar'])) {
    extract($_POST);

    $funcionario->setFunc_nome($nome);
    $funcionario->setFunc_dataNasc($dataNasc);
    $funcionario->setFunc_dataAdmissao($dataAdmissao);
    $funcionario->setFunc_cargo($cargo);
    $funcionario->setFunc_cod($cod);
    $resultado = $funcionarioDAO->AtualizarFuncionario($funcionario);

    if ($resultado == '1') {
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Atualizado com sucesso!',
                footer: '<a href="funcionarios.php">Visualizar todos os cadastrados</a>'
            })
            window.reload();
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Aconteceu algum erro. Por favor tente novamente!',
                footer: `Se o erro persistir, entre em contato com um desenvolvedor!<br><?php echo $resultado; ?>`
            })
        </script>
<?php
    }
}
?>