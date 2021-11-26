<x-guest-layout>

    @if(Route::has('login'))  
        @auth
            <x-auth-card>
                <x-slot name="logo">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>

                <div>
                    <p style="text-align: center;"> Você já está logado!
                </div>
                
                <div class="flex items-center justify-center mt-4">
                    <x-button class="ml-3" >
                        <a href="{{ url('/dashboard') }}" class="text-lg">Entrar</a>
                    </x-button>
                </div>
            </x-auth-card>
        @else
            <x-auth-card>
                <x-slot name="logo">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Senha')" />

                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Entrar') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>

            @if (Route::has('register'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <a href="{{ route('register') }}" class="ml-4 text-lg text-gray-700 dark:text-gray-500 underline">Registrar</a>
            </div>
            @endif
        @endauth       
    @endif
</x-guest-layout>
