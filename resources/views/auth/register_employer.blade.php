<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" value="empleador">

            <div>
                <x-label for="name_company" value="{{ __('Nombre Empresa') }}" />
                <x-input id="name_company" class="block mt-1 w-full" type="text" name="name_company" :value="old('name_company')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="address" value="{{ __('dirección') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>

            <div class="mt-4">
                <x-label for="name" value="{{ __('Nombre representante') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-label for="last_name" value="{{ __('Apellido representante') }}" />
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Teléfono') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- <div class="mt-4">
                <x-label for="profile_photo_path" value="{{ __('Foto de perfil o logo (Opcional)') }}" />
                <x-input id="profile_photo_path" class="block mt-1 w-full" type="file" name="profile_photo_path" />
            </div> -->

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms"/>

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
