$(function () {
    mostrarCombo();
    enviar();
});

function mostrarCombo() {
    let parametros = {
        'func': 'editar'
    };

    $.ajax({
        url: 'php/cargar_listas.php',
        method: 'post',
        data: parametros,
        success: function (data) {
            data = $.parseJSON(data);
            muestraResultados(data);
        },
        error: function (xhr, status) {
            alert('Disculpe, existio un problema');
        }
    });

    $('#lista_reproduccion').on('change', function () {
        let id = $('#lista_reproduccion').val();
        // alert(id);
        let parametros = {
            'func': 'video',
            'busc': id
        };
        $.ajax({
            url: 'php/cargar_listas.php',
            method: 'post',
            data: parametros,
            success: function (videos) {
                videos = $.parseJSON(videos);
                if (videos) {
                    muestraVideos(videos);
                } else {
                    let resultado = '<option value="0">No hay videos</option>';
                    $('#videos').html(resultado);
                }
            },
            error: function (xhr, status) {
                alert("Disculpe existio un problema");
            }
        });
    });
}


function muestraVideos(videos) {
    let resultado = '<option value="0">Elige un video</option>';
    videos.forEach(function (element) {
        resultado += '<option value=' + element.id + '>' + element.nombre + '</option>';
    })
    $('#videos').html(resultado);
}

function muestraResultados(data) {
    let resultado = '<option value="0">Elige una opción</option>';
    data.forEach(function (element) {
        resultado += '<option value=' + element.id + '>' + element.nombre + '</option>';
    });
    $('#lista_reproduccion').html(resultado);
}

function enviar() {
   
    $('#enviar').on('click', function () {
        let resultado = ""
        let la_lista = $('#lista_reproduccion').val();
        let el_video = $('#videos').val();

        if (la_lista == 0 || el_video == null || el_video == 0) {
            resultado += "Falta datos en el combox";
            $('#resultadoEs').text(resultado);

        } else {
            resultado += 'El resultado es: ';
            resultado += $('#lista_reproduccion option:selected').text();
            resultado += ' - ';
            resultado += $('#videos option:selected').text();
            $('#resultadoEs').text(resultado);

        }




    })


}