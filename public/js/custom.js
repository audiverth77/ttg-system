$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // FUNCIONES PARA EL CRUD MIS OFERTAS PARA EL ROL EMPLEADOR -------------------------------------------------------->

    /**
     * Apertura y cierre de mis modales propias
     */
    $("#abrirModal").click(function () {
        $('input[name="_method"]').val('POST');
        $('#modalId').removeClass('hidden');
        $('#createJobForm').trigger('reset');
        $('#createJobForm').removeData('id');
    });

    $("#cancelarModal").click(function () {
        $('#modalId').addClass('hidden');
    });

    /**
     * Cargar datos para la moodal de edición de oferta
     */
    $('.editar-oferta').click(function () {
        const jobId = $(this).data('id');
        
        $.ajax({
            url: `/jobs/${jobId}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                for (const field in data) {
                    $(`#${field}`).val(data[field]);
                }
                
                $('#modalId').removeClass('hidden');
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });

    
    /**
     * Función para la creación y edición de ofertas
     */
    $('#createJobForm').submit(function (e) {
        e.preventDefault();

        var isUpdate = !!$('#jobId').val();
        var jobId = $('#jobId').val();
        var url = isUpdate ? `/jobs/${jobId}` : '/jobs';
        var formData = $(this).serialize();

        if (isUpdate) {
            formData += '&_method=PUT';
        }

        console.log("id trabajo = " + isUpdate);

        $.ajax({
            url: url,
            method: 'POST', 
            data: formData,
            success: function (response) {
                console.log("Se ejecutó correctamente la acción");
                $('#modalId').addClass('hidden');
                Swal.fire({
                    title: 'Guardado',
                    text: 'Se ejecutó correctamente la acción',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    /**
     * Eliminar oferta seleccionada
     * Nota: Se manejo asincronismo para el envio de datos pero no para la actualización de las cards 
     * debido a la falta de tiempo.
     */
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
                    url: `/jobs/${jobId}`,
                    type: 'DELETE',
                    success: function (response) {
                        console.log(response.message);
                        Swal.fire({
                            title: 'Guardado',
                            text: 'Se ejecutó correctamente la acción',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });

    /**
     * Abrir modal referencias para observar als referencias traidas de la api
     */
    $(".abrir-modal-referencias").click(function () {
        $.ajax({
            url: "https://reqres.in/api/users/",
            type: "GET",
            success: function (response) {
                // {id: 1, email: 'george.bluth@reqres.in', first_name: 'George', last_name: 'Bluth', avatar: 'https://reqres.in/img/faces/1-image.jpg'}
                var referenciasHtml = '';
                for (var i = 0; i < 2; i++) {
                    var a = Math.floor(Math.random() * 6) + 1;
                    var user = response.data[a];
                    referenciasHtml += `
                            <div class="mt-4">
                                <div class="flex justify-center mb-4">
                                    <img src="${user.avatar}" alt="Imagen del Usuario" class="rounded-full border-4 border-gray-300 h-32 w-32 object-cover">
                                </div>

                                <div class="text-sm text-gray-500">
                                    <p class="mb-2" id="nombreReferencia"><strong>Nombre:</strong> ${user.first_name}</p>
                                    <p class="mb-2" id="apellidoReferencia"><strong>Apellido:</strong> ${user.last_name}</p>
                                    <p id="emailReferencia"><strong>Email:</strong> ${user.email}</p>
                                </div>
                            </div>`;
                    console.log(referenciasHtml);
                }

                $('#user-info').html(referenciasHtml);

                $('#modalReferencias').removeClass('hidden');
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });

    $("#cerrarModalReferencias").click(function () {
        $('#modalReferencias').addClass('hidden');
    });


    // FUNCIONES PARA EL CRUD MIS OFERTAS PARA EL ROL CANDIDATO -------------------------------------------------------->
    // +++ mostrar ofertas  ++++++++++++++++++++++++++++++++++++++++++
    $('.ver-oferta').click(function () {
        const jobId = $(this).data('id');

        $.ajax({
            url: `/jobs/${jobId}`,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data[0]);
                var html = `<h2 class="text-2xl font-semibold mb-2"> ${data.tittle} </h2>` +
                    `<p class="mb-4"><strong>Descripción:</strong> ${data.description}</p>` +
                    `<p class="mb-4"><strong>Ubicación:</strong> ${data.location}</p>` +
                    `<p class="mb-4"><strong>Salario:</strong> $${data.salary}</p>`;

                $('.detalles').html(html);
                $('.aplica-candidato').attr('data-id', data.id);
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });

    // +++ aplicar a oferta +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $('.aplica-candidato').click(function () {
        const jobId = $(this).attr('data-id');

        $.ajax({
            url: `/apply/${jobId}`,
            type: 'POST',
            success: function (data) {
                console.log(data);
                Swal.fire({
                    icon: data.status,
                    title: data.message,
                    text: 'El reclutador podra ver tu CV y pronto se pondra en contacto contigo.',
                    confirmButtonText: 'Aceptar'
                });
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });


    // +++ eliminar mi postulación como candidato +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    $('.eliminar-postulacion').click(function () {
        var aplicationId = $(this).data('id');
        console.log(aplicationId);
        swal.fire({
            title: '¿Seguro que desea eliminar la postulación?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, eliminar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/withdraw-application/${aplicationId}`,
                    type: 'DELETE',
                    success: function (response) {
                        console.log(response.message);
                        Swal.fire({
                            title: 'Eliminado',
                            text: 'Se ejecutó correctamente la acción',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

    });
});
