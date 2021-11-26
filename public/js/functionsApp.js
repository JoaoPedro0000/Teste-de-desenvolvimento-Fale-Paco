$(document).ready( function () {
    $('#tabela').DataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ registros por página",
            "info": "Mostrando página <strong style='font-size:13pt;'>_PAGE_</strong> de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de MAX registros no total)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
} );

function invert(){
    var select1 = document.getElementById('selectMoeda1').value;
    var select2 = document.getElementById('selectMoeda2').value;

    document.getElementById('selectMoeda1').value = select2;

    document.getElementById('selectMoeda2').value = select1;
}