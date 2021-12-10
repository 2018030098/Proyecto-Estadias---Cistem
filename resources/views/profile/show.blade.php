<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())

            <!-- modificacion de informacion -->
                @livewire('profile.update-profile-information-form')
            <!--  -->

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">

                <!-- modificacion de Contraseña -->
                @livewire('profile.update-password-form')
                <!--  -->
                
                </div>

                @endif
                
            @if(auth()->user()->kind_Id == 1)
                <x-jet-section-border />
                    <div class="container">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1 flex justify-between">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Creacion de usuario') }}</h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('Seccion para crear un nuevo usuario de tipo "user"') }}
                                        </p>
                                </div>
                                <div class="px-4 sm:px-0"></div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="row">
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="Create_username" class="form-label block font-medium text-sm text-gray-700">Nombre de usuario</label>
                                                <input type="text" id="Create_username" name="Create_username" onchange="pass()" class="mt-1 block w-full form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full form-control" autocomplete="off" require>
                                            </div>
                                            <div class="mt-3 col-span-6 sm:col-span-4">
                                                <label for="Create_email" class="form-label block font-medium text-sm text-gray-700">Correo Electronico</label>
                                                <input type="email" id="Create_email" name="Create_email" onchange="pass()" class="border animated mt-1 block w-full form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full form-control" autocomplete="off" require>
                                                <div class="d-none" id="messageP0">
                                                    <span class="text-danger blockquote-footer">El email no es valido</span>
                                                </div>
                                            </div>
                                            <div class="mt-3 col-span-6 sm:col-span-4">
                                                <label for="Create_password" class="form-label block font-medium text-sm text-gray-700">Contraseña</label>
                                                <input type="password" id="Create_password" name="Create_password" onchange="pass()" class="border animated mt-1 block w-full form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full form-control" require>
                                                <div class="d-none" id="messageP1">
                                                    <span class="text-danger blockquote-footer">Las contraseñas no coinciden</span>
                                                </div>
                                                <div class="d-none" id="messageP3">
                                                    <span class="text-danger blockquote-footer">La contraseña debe de tener un minimo de 8 caracteres</span>
                                                </div>
                                            </div>
                                            <div class="mt-3 col-span-6 sm:col-span-4">
                                                <label for="Create_confirmPassword" class="form-label block font-medium text-sm text-gray-700">Confirmar Contraseña</label>
                                                <input type="password" id="Create_confirmPassword" name="Create_confirmPassword" onchange="pass()" class="border animated mt-1 block w-full form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full form-control" require>
                                                <div class="d-none" id="messageP2">
                                                    <span class="text-danger blockquote-footer">Las contraseñas no coinciden</span>
                                                </div>
                                                <div class="d-none" id="messageP4">
                                                    <span class="text-danger blockquote-footer">La contraseña debe de tener un minimo de 8 caracteres</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                        <div class="text-sm text-gray-600 mr-3">
                                            <button id="userBtn" data-bs-toggle="modal" data-bs-target="#CreateUser" onclick="infomodal()" disabled class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="CreateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Creando un nuevo usuario</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                    <div class="modal-body px-4 bg-white sm:p-6 sm:rounded-tl-md sm:rounded-tr-md">
                                        <div>
                                            <label for="modal_username" class="form-label">Nombre de usuario</label>
                                            <input type="text" name="modal_username" id="modal_username" class="form-control" readonly>
                                        </div>
                                        <div class="mt-3">
                                            <label for="modal_email" class="form-label">Correo electronico</label>
                                            <input type="text" name="modal_email" id="modal_email" class="form-control" readonly>
                                        </div>
                                        <div class="mt-3" hidden>
                                            <label for="modal_password" class="form-label">Contraseña</label>
                                            <input type="password" name="modal_password" id="modal_password" class="form-control" readonly>
                                        </div>
                                        <hr>
                                        <div class="mt-3">
                                            <label for="modal_adminPassword" class="form-label">Contraseña de administrador</label>
                                            <input type="password" name="modal_adminPassword" id="modal_adminPassword" class="form-control" require>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearUser()">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        
                        function pass(){
                            let user = document.getElementById('Create_username');
                            let email = document.getElementById('Create_email');
                            let password = document.getElementById('Create_password');
                            let confPass = document.getElementById('Create_confirmPassword');
                            let btn = document.getElementById('userBtn');

                            let msg0 = document.getElementById('messageP0'); // email no valido
                            let msg1 = document.getElementById('messageP1'); // contraseña incorrecta
                            let msg2 = document.getElementById('messageP2'); // contraseña incorrecta
                            let msg3 = document.getElementById('messageP3'); // contraseña menor a 8 caracteres
                            let msg4 = document.getElementById('messageP4'); // contraseña menor a 8 caracteres

                            if (!validar_email(email.value) && email.value != '') { // validacion de email
                                email.classList.add('border-danger');
                                email.classList.add('shake');
                                msg0.classList.remove('d-none');
                            }else{
                                email.classList.remove('border-danger');
                                email.classList.remove('shake');
                                msg0.classList.add('d-none');
                            }

                            if(password.value != '' && confPass.value != ''){ // Validacion de las contraseñas
                                if (password.value == confPass.value) {
                                    if (user.value != '' && validar_email(email.value) ) { // activar boton en caso de estar todo listo
                                        btn.removeAttribute('disabled');
                                    }
                                    password.classList.remove('border-danger');
                                    confPass.classList.remove('border-danger');
                                    msg1.classList.add('d-none');
                                    msg2.classList.add('d-none');
                                    password.classList.remove('shake');
                                    confPass.classList.remove('shake');
                                } else {
                                    password.classList.add('shake');
                                    confPass.classList.add('shake');
                                    if (!password.classList.contains('border-danger')) {
                                        password.classList.add('border-danger');
                                        confPass.classList.add('border-danger');
                                    }
                                    if (!btn.hasAttribute('disabled')) {
                                        btn.setAttribute('disabled');
                                    }
                                    if(msg1.classList.contains('d-none')){
                                        msg1.classList.remove('d-none');
                                        msg2.classList.remove('d-none');
                                    }
                                }
                            }
                            if ((password.value).length > 8 || password.value != '') { // minimo de caracteres
                                password.classList.remove('border-danger');
                                password.classList.remove('shake');
                                msg3.classList.add('d-none');
                            }else{
                                password.classList.add('border-danger');
                                password.classList.add('shake');
                                msg3.classList.remove('d-none');
                            }
                            if ((confPass.value).length > 8 || confPass.value != '') {
                                confPass.classList.remove('border-danger');
                                confPass.classList.remove('shake');
                                msg4.classList.add('d-none');
                            }else{
                                confPass.classList.add('border-danger');
                                confPass.classList.add('shake');
                                msg4.classList.remove('d-none');
                            }
                        }

                        function validar_email( email ){
                            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            return regex.test(email) ? true : false;
                        }

                        function infomodal(){
                            let username = document.getElementById('Create_username').value;
                            let email = document.getElementById('Create_email').value;
                            let password = document.getElementById('Create_password').value;
                            let confirmPassword = document.getElementById('Create_confirmPassword').value;

                            let M_user = document.getElementById('modal_username');
                            let M_email = document.getElementById('modal_email');
                            let M_pass = document.getElementById('modal_password');
                            let M_Apass = document.getElementById('modal_adminPassword');


                            if (M_user.hasAttribute('value')) {
                                M_user.removeAttribute('value');
                            }
                            M_user.setAttribute("value",username);
                            if (M_email.hasAttribute('value')) {
                                M_email.removeAttribute('value');
                            }
                            M_email.setAttribute("value",email);
                            if (M_pass.hasAttribute('value')) {
                                M_pass.removeAttribute('value');
                            }
                            M_pass.setAttribute("value",password);

                        }

                        function clearUser() {
                            let username = document.getElementById('Create_username');
                            let email = document.getElementById('Create_email');
                            let password = document.getElementById('Create_password');
                            let confirmPassword = document.getElementById('Create_confirmPassword');
                            
                            username.value = "";
                            email.value = "";
                            password.value = "";
                            confirmPassword.value = "";
                        }

                    </script>
            @endif

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">

                <!-- Eliminar Cuenta -->
                    @livewire('profile.delete-user-form')
                <!--  -->

                </div>
            @endif
        </div>
    </div>
</x-app-layout>
