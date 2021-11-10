<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo"> <!-- Esto resuelve el problema que se genera en authentication card, ya que solicita un logo y dicho logo esta en vendor --> </x-slot>
        
        <div class="middle-box text-center loginscreen gray-bg rounded shadow-lg">
            <div class="p-3">
                <div class="text-center">
                    <img src="{{ asset('img/Logo.png') }}" alt="Imagen del logo">
                </div>
                <div class="my-3">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem aliquam molestias unde doloremque minima optio?
                </div>
                <!-- Formulario del login -->
                <div>
                    <div class="text-center p-2">
                        <h4>Iniciar Sesion</h4>
                    </div>
                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="text-muted gray-bg">
                        @csrf
                        
                            <div class="mb-3">
                                <!-- input del username -->
                                <x-jet-input id="email" name="email" type="email" class="form-control" placeholder="Correo Electronico" autocomplete="off" :value="old('email')" required autofocus />
                            </div>
                            <div class="mb-3">
                                <!-- input del password -->
                                <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" required autocomplete="current-password">
                            </div>

                        <!-- 
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif
                            </div> 
                        -->

                        <div class="pb-1 d-grid g-0">
                            <x-jet-button class="btn bg-success">
                                {{ __('Ingresar') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <div class="gray-bg "> <!-- d-none --> 
                        <hr>
                        <a href="{{ route('register') }}" class="text-decoration-none text-muted text-center"> crea una cuenta </a>
                    </div>
                </div>
            </div>
        </div>
    
    </x-jet-authentication-card>
</x-guest-layout>

<x-jet-validation-errors class="mb-4"/>