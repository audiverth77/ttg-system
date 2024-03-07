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
                console.log("Se ejecutó correctamente la acción");
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
                    success: function (response) {
                        console.log(response.message);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

    });


    // FUNCIONES PARA EL CRUD MIS OFERTAS PARA EL ROL CANDIDATO -------------------------------------------------------->
    // +++ mostrar ofertas  ++++++++++++++++++++++++++++++++++++++++++
    $('.ver-oferta').click(function () {
        var idJob = $(this).data('id');
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
                var html = `<h2 class="text-2xl font-semibold mb-2"> ${data[0].tittle} </h2>` +
                    `<p class="mb-4"><strong>Descripción:</strong> ${data[0].description}</p>` +
                    `<p class="mb-4"><strong>Ubicación:</strong> ${data[0].location}</p>` +
                    `<p class="mb-4"><strong>Salario:</strong> $${data[0].salary}</p>`;

                $('.detalles').html(html);
                $('.aplica-candidato').attr('data-id', data[0].id);;

            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });

    // +++ aplicar a oferta +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $('.aplica-candidato').click(function () {
        var idJob = $(this).attr('data-id');
        console.log("id trabajo aplicado= " + idJob);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `/application-job`,
            type: 'POST',
            data: {
                job_id: idJob,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                Swal.fire({
                    icon: data.status,
                    title: data.message,
                    text: 'el reclutador podra ver tu CV y pronto se pondra en contacto contigo.',
                    confirmButtonText: 'Aceptar'
                });
            },
            error: function (error) {
                console.error("Ha ocurrido un error: ", error);
            }
        });
    });



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



});
