<?php
include_once('paginas/cabecalho.php');

require_once('db/Entidades/funcionario.class.php');
require_once('db/DAO/funcionarioDAO.class.php');
$funcionario = new Funcionario();
$funcionarioDAO = new FuncionarioDAO();

?>

<h1>Cadastrar funcionário</h1>
<form method="POST" class="text-left">
    <div class="form-group">
        <label for="Nome">Nome</label>
        <input type="text" class="form-control" placeholder="Digite aqui o nome..." id="inputNome" name="nome" maxlength="128" required>
        <p id="retornoNome" class="m-0 mt-1 text-muted text-center">Total de caracteres restantes: 128</p>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="Data de nascimento">Data de nascimento</label>
            <input type="date" class="form-control" id="dataNasc" name="dataNasc" required>
        </div>
        <div class="form-group col-md-6">
            <label for="Cargo">Cargo</label>
            <select id="cargo" name="cargo" class="form-control" required>
                <option selected value="desenvolvedor">Desenvolvedor</option>
                <option value="gestor">Gestor</option>
                <option value="auxiliar">Auxiliar</option>
            </select>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-info" name="cadastrar">Cadastrar</button>
    </div>
</form>
<a href="index.php">Voltar</a>
<?php
include_once('paginas/rodape.php');

if (isset($_POST['cadastrar'])) {
    extract($_POST);

    $funcionario->setFunc_nome($nome);
    $funcionario->setFunc_dataNasc($dataNasc);
    $funcionario->setFunc_dataAdmissao(date('Y-m-d'));
    $funcionario->setFunc_cargo($cargo);
    $resultado = $funcionarioDAO->CadastrarFuncionario($funcionario);

    if ($resultado == '1') {
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cadastrado com sucesso!',
                text: 'Você pode cadastrar mais funcionários',
                footer: '<a href="funcionarios.php">Ou visualizar todos os cadastrados</a>'
            })
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