<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @auth
                    @if(auth()->user()->hasRole('empleador'))
                        <x-welcome_employer />
                    @elseif(auth()->user()->hasRole('candidato'))
                        <x-welcome_candidate />
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>