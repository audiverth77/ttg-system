$(document).ready(function () {

    // FUNCIONES PARA EL CRUD MIS OFERTAS PARA EL ROL EMPLEADOR -------------------------------------------------------->

    // +++ apertura y cierre de mis modales propias ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $("#abrirModal").click(function () {
        $('input[name="_method"]').val('POST');
        $('#modalId').removeClass('hidden');
        $('#createJobForm').trigger('reset');
        $('#createJobForm').removeData('id');
    });

    // $("#abrirModalEditar").click(function () {
    //     $('#modalId').remove('hidden');
    // });

    $("#cancelarModal").click(function () {
        $('#modalId').addClass('hidden');
    });

    // +++ datos para modal editar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $('.editar-oferta').click(function () {
        $('input[name="_method"]').val('PUT');
        var idJob = $(this).data('id');
        // console.log($('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `/api/jobs/${idJob}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data[0]);
                $('#jobId').val(data[0].id);
                $('#tittle').val(data[0].tittle);
                $('#description').val(data[0].description);
                $('#state').val(data[0].state);
                $('#location').val(data[0].location);
                $('#salary').val(data[0].salary);
                $('#modalId').removeClass('hidden');
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });

    // +++ Función para la creación y edición de ofertas ++++++++++++++++++++++++++

    $('#createJobForm').submit(function (e) {
        e.preventDefault();

        var isUpdate = !!$('#jobId').val();
        var jobId = $('#jobId').val();
        var url = isUpdate ? `/jobs/${jobId}` : '/jobs';
        var formData = $(this).serialize();

        // Agregar el campo _method a formData si isUpdate es true
        if (isUpdate) {
            formData += '&_method=PUT';
        }

        console.log("id trabajo = " + isUpdate);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            method: 'POST', // Usa POST pero sobrescribe el método con _method para PUT
            data: formData,
            success: function (response) {
                console.log("Se ejecutó correctamente la acción amiwo!");
                $('#modalId').addClass('hidden');
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.borrar-oferta').click(function () {
        var jobId = $(this).data('id');
        swal.fire({
            title: '¿Seguro que desea eliminar el registro?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, eliminar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/jobs/' + jobId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);                       
                    }
                });
            }
        });

    });
});
