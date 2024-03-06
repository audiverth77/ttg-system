<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- Asumiendo que estás iterando sobre los trabajos aquí -->
            @foreach ($jobs as $job)
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8 mb-4">
                <div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        <h2 class="ml-3 text-xl font-semibold text-gray-900">
                            {{ $job->title }}
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        {{ $job->description }}
                    </p>
                    <p class="mt-2 text-gray-500 text-sm">
                        Estado: {{ $job->state }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        Ubicación: {{ $job->location }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        Salario: {{ $job->salary }}
                    </p>
                </div>
                <div class="flex gap-4 mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-700 transition ease-in-out duration-150">
                        Editar
                    </button>
                    <button class="px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-700 transition ease-in-out duration-150">
                        Eliminar
                    </button>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>