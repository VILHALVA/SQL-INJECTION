$(document).ready(function() {
    $('#sqlForm').submit(function(event) {
        event.preventDefault(); 
        var comandos = $('#comandos').val(); 
        var injecaoAtivada = document.getElementById("toggle-btn").classList.contains('active');
        $.ajax({
            type: 'POST',
            url: 'CODIGO.php', 
            data: { comandos: comandos, injection_toggle: injecaoAtivada ? 'on' : '' },
            success: function(response) {
                $('#resultado').val(response); 
            }
        });
    });
});

function toggleInjection() {
    const checkBox = document.getElementById("toggle-btn");
    const textArea = document.querySelector('.resultado textarea');
    const fab = document.querySelector('.fab');
    fab.classList.toggle('active'); 

    if (checkBox.checked || fab.classList.contains('active')) {
        textArea.value = "Injeção ativada. Aguarde o resultado após enviar o formulário.";
    } 
    else {
        textArea.value = "Injeção desativada. Por favor, ative para ver o resultado.";
    }
}
