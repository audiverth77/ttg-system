<div>
    <div class="py-12" id="cont-ofertas">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @unless(count($candidates))
                    <h2>POR EL MOMENTO NO TIENES CANDIDATOS POSTULADOS</h2>
                @endunless

                @foreach ($candidates as $candidate)
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8 mb-4">
                        <div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                    {{ $candidate->name }} {{ $candidate->lastname }}
                                </h2>
                            </div>

                            <p class="mt-2 text-gray-500 text-sm">
                                Número Contacto: {{ $candidate->phone }}
                            </p>
                            <p class="text-gray-500 text-sm">
                                Email: {{ $candidate->email }}
                            </p>
                            <p class="text-gray-500 text-sm">
                                Direccion: {{ $candidate->address }}
                            </p>
                        </div>
                        <div class="flex gap-4 mt-4 justify-end">

                            <button class="abrir-modal-referencias inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-id="{{ $id }}">
                                Ver Referencias
                            </button>
                            <a target="_blank" href="{{ Storage::url( $candidate->cv ) }}">
                                <button class=" inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-id="{{ $id }}">
                                    Ver CV
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <!-- modal referencias ------------------------------------------------------------------------- -->
    <div id="modalReferencias" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Referencias
                        </h3>

                        <div id="user-info">

                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cerrarModalReferencias" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>