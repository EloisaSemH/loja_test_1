<?php
include_once('paginas/cabecalho.php');

if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
} else {
?>
    <script type="text/javascript">
        alert('Selecione um funcionário para excluir!')
        document.location.href = "funcionarios.php?pagina=1";
    </script>
<?php
}
require_once('db/DAO/funcionarioDAO.class.php');
$funcionarioDAO = new FuncionarioDAO();

$resultado = $funcionarioDAO->ExcluirFuncionario($cod);

include_once('paginas/rodape.php');
if ($resultado == '1') {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Excluído com sucesso!',
            html: '<a class="btn btn-info" href="funcionarios.php">Clique aqui para continuar</a>',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: false,
            showConfirmButton: false
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
            html: '<a class="btn btn-info" href="editarfuncionario.php?cod=<?php echo $cod; ?>">Clique aqui para continuar</a>',
            footer: `Se o erro persistir, entre em contato com um desenvolvedor!<br><?php echo $resultado; ?>`,
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: false,
            showConfirmButton: false
        })
        // 
    </script>
<?php
}

?>
<script>
        window.addEventListener('load', () =>{
            document.getElementById('todoConteudo').removeAttribute('class')
        })
</script>