<?php
    if(isset($_GET['pagina'])){
        $pg = $_GET['pagina'];
    }else{
        $pg = 1;
    }
    include_once('paginas/cabecalho.php');

    require_once ("db/DAO/funcionarioDAO.class.php");
    $funcionarioDAO = new FuncionarioDAO();

    $qntporpag = 10;

    $numFuncionarios = $funcionarioDAO->numeroFuncionarios();

    $numpags = ceil($numFuncionarios/$qntporpag);

    $inicio = ($qntporpag*$pg)-$qntporpag;

    $funcionarios = $funcionarioDAO->consultarTodosFuncionarios($inicio, $qntporpag);

?>

<h1>Funcionários</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr class="bg-info text-light">
            <th class="align-middle" scope="col">Código</th>
            <th class="align-middle" scope="col">Nome</th>
            <th class="align-middle" scope="col">Data de nascimento</th>
            <th class="align-middle" scope="col">Data de admissão</th>
            <th class="align-middle" scope="col">Cargo</th>
            <th class="align-middle" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(is_array($funcionarios)){
            foreach ($funcionarios as $func) {
        ?>
            <tr>
                <td class="align-middle" scope="row"><?php echo $func['func_cod']; ?></td>
                <td class="align-middle text-capitalize"><?php echo $func['func_nome']; ?></td>
                <td class="align-middle"><?php echo $func['func_dataNasc']; ?></td>
                <td class="align-middle"><?php echo $func['func_dataAdmissao']; ?></td>
                <td class="align-middle text-capitalize"><?php echo $func['func_cargo']; ?></td>
                <td class="align-middle">
                    <button type="button" class="btn btn-danger mb-2" name="excluir" onclick="confirmarExclusao(<?php echo $func['func_cod']; ?>)">Excluir</button>
                    <br>
                    <a href="editarfuncionario.php?cod=<?php echo $func['func_cod']; ?>" class="btn btn-info">Editar</a></td>
            </tr>
        <?php
            }
        }else{
        ?>
            <tr><td colspan="6">Por favor, <a href="cadastrofuncionario.php">adicione funcionários</a> para acessar essa página</td></tr>
        <?php } ?>
        
    </tbody>
</table>
<?php
	$pagina_anterior = $pg - 1;
	$pagina_posterior = $pg + 1;
?>
<nav aria-label="Navigação de páginas" class="mt-3">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <?php
					if($pagina_anterior != 0){ ?>
            <a href="index.php?&pg=funcionarios&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous"
                class="page-link">
                <span aria-hidden="true">&laquo;</span>
            </a>
            <?php }else{ ?>
            <span aria-hidden="true" class="page-link">&laquo;</span>
            <?php }  ?>
        </li>
        <?php 
				for($i = 1; $i < $numpags + 1; $i++){ ?>
        <li class="page-item"><a href="index.php?&pg=funcionarios&pagina=<?php echo $i; ?>"
                class="page-link"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item">
            <?php
					if($pagina_posterior <= $numpags){ ?>
            <a href="index.php?&pg=funcionarios&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous"
                class="page-link">
                <span aria-hidden="true">&raquo;</span>
            </a>
            <?php }else{ ?>
            <span aria-hidden="true" class="page-link">&raquo;</span>
            <?php }  ?>
        </li>
    </ul>
</nav>

<a href="index.php">Voltar</a>

<?php include_once('paginas/rodape.php'); ?>