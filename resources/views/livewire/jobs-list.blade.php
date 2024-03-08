<div>
    <div class="py-12" id="cont-ofertas">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end">
                    <button id="abrirModal" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        + Crear Oferta
                    </button>
                </div>

                @foreach ($jobs as $job)
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8 mb-4">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                {{ $job->tittle }}
                            </h2>
                        </div>

                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            {{ $job->description }}
                        </p>
                        <p class="mt-2 text-gray-500 text-sm">
                            Estado: {{ $job->state == 1 ? 'Disponible' : 'Cerrado' }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            Ubicación: {{ $job->location }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            Salario: ${{ $job->salary }}
                        </p>
                    </div>
                    <div class="flex gap-4 mt-4 justify-end">
                        <a href="{{ route('applications.list', ['jobId' => $job->id]) }}">
                            <button class=" ver-candidatos inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                                Ver Candidatos
                            </button>
                        </a>
                        <div>
                        <button id="abrirModalEditar" class="editar-oferta inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-id="{{ $job->id }}">
                            Editar
                        </button>
                        </div>
                        <div>
                        <button class="borrar-oferta inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-id="{{ $job->id }}">
                            Eliminar
                        </button>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Modal de crear ofertas -->

    <div id="modalId" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>


            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Gestión Ofertas
                        </h3>


                        <form id="createJobForm" class="mt-8" method="POST">
                            @csrf

                            <input type="hidden" name="_method" id="formMethod" value="PUT">
                            <input type="hidden" name="jobId" id="jobId">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                <input type="text" name="tittle" id="tittle" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Descripcion</label>
                                <input type="text" name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select name="state" id="state" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="" disabled="disabled" selected="selected">Seleccione...</option>
                                    <option value="1">Disponible</option>
                                    <option value="0">Cerrado</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="state" class="block text-sm font-medium text-gray-700">Ubicación</label>
                                <select name="location" id="location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="" disabled="disabled" selected="selected">Seleccione...</option>
                                    <option value="remoto">Remoto</option>
                                    <option value="presencial">Presencial</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="salary" class="block text-sm font-medium text-gray-700">Salario</label>
                                <input type="number" name="salary" id="salary" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <!-- <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"> -->
                            <div class="mb-4">
                                <button type="submit" id="CrearOferta" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Guardar
                                </button>
                                <button type="button" id="cancelarModal" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Cancelar
                                </button>
                            </div>

                        </form>
                    </div>
                    <!-- </div> -->
                </div>

            </div>
        </div>
    </div>


</div>