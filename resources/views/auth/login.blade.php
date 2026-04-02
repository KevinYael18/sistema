<x-guest-layout>

    <!-- Título -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">
            Sistema UPTex
        </h1>
        <p class="text-gray-600">Universidad Politécnica de Texcoco</p>
    </div>

    <!-- Estado de sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex justify-center mt-4">
            <x-primary-button class="bg-green-600 hover:bg-green-800">
                Iniciar sesión
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>