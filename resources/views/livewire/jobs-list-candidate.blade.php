<div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex flex-row items-stretch">
        <!-- parte izquierda -->
        <div class="w-2/5 p-4 flex flex-col">
            <div class="pt-6" id="cont-ofertas">

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

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
                            </div>
                            <div class="flex gap-4 mt-4 justify-end">
                                <button  class="ver-oferta inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" data-id="{{ $job->id }}">
                                    Ver detalles de la oferta
                                </button>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- parte derecha -->
        <div class="w-3/5 pt-6 bg-gray-100 flex flex-col">
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="detalles">
                    <h2 class="text-2xl font-semibold mb-2"></h2>
                    <p class="mb-4"><strong>Descripción:</strong> </p>
                    <p class="mb-4"><strong>Ubicación:</strong> </p>
                    <p class="mb-4"><strong>Salario:</strong> </p>
                </div>

                <div class="flex gap-4 mt-4 justify-end">
                    <button class=" aplica-candidato inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                        Aplicar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>