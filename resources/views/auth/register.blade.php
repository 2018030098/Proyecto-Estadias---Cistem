<x-guest-layout>
    <x-jet-authentication-card>
    <x-slot name="logo"> <!-- Esto resuelve el problema que se genera en authentication card, ya que solicita un logo y dicho logo esta en vendor --> </x-slot>

        <div class="middle-box text-center loginscreen gray-bg rounded shadow-lg">
            <div class="text-center">
                <img src="{{ asset('img/Logo.png') }}" alt="Imagen del logo">
            </div>
            <div class="p-3">
                <div class="text-center p-2">
                    <h4>Crear Cuenta</h4>
                </div>
                <form method="POST" action="{{ route('register') }}" class="text-muted">
                    @csrf

                    <div class="mb-3">
                        <!-- username -->
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre de Usuario" :value="old('name')" required autofocus autocomplete="name"/>
                    </div>
                    <div class="mb-3">
                        <!-- email -->
                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo electronico" :value="old('email')" required/>
                    </div>
                    
                    <div class="mb-3">
                        <!-- password -->
                        <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" required autocomplete="new-password"/>
                    </div>
                    <div class="mb-3">
                        <!-- confirmacion del password -->
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirmar Contraseña" required autocomplete="new-password"/>
                    </div>

                    <!-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif -->
                    <div class="pb-1 d-grid g-0">
                        <x-jet-button class="btn bg-success">
                            {{ __('Registrar') }}
                        </x-jet-button>
                    </div>
                </form>
                <hr>
                <a href="{{ route('login') }}" class="text-muted text-center text-decoration-none">Ya tengo cuenta</a>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-dismissible animated d-none shadow-sm {{ session('class') }}" role="alert" aria-live="assertive" aria-atomic="true" id="loadToast" style="position: absolute; top: 20px; right: 20px;">
                <div class="alert-heading row">
                    <div class="col-10">
                        <i class="{{ session('icon') }}"></i>
                        <strong class="mr-auto m-l-sm">   {{ session('title') }}   </strong>
                    </div>
                    <div class="col-2">
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="closeToast()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <hr>
                <div>
                    {{ session('message') }}
                </div>
            </div>
        @endif
    </x-jet-authentication-card>
</x-guest-layout>