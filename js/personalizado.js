particlesJS.load('particles-container', 'js/particlesjs-config.json');

function confirmarExclusao (codigo) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Não será possível reverter essa ação!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#17a2b8',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            document.location.href = "deletarfuncionario.php?cod=" + codigo;

        }
    })
}

inputNome.addEventListener('keyup', () => {
    document.getElementById('retornoNome').innerHTML = 'Total de caracteres restantes: ' + (128 - inputNome.value.length);

    if (inputNome.value.length == 128) {
        document.getElementById('retornoNome').innerHTML = 'Você chegou no limite';
        inputNome.style.borderColor = 'orange';
    } else if (inputNome.value.length != 0) {
        inputNome.style.borderColor = 'green';
    } else {
        inputNome.style.borderColor = '#ced4da';
    }
})

// excluir.addEventListener('click', confirmarExclusao(cod.value))
