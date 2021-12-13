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

        if (user.value != '' || email.value != '' || password.value != '' || confPass.value != '') { // Validar formulario
            if (user.value != '' && validar_email(email.value) && (password.value).length >= 8 && (confPass.value).length >= 8 && password.value == confPass.value) { // validar que el fomulario este llenado correctamente
                btn.removeAttribute('disabled');
            }

            if (user.value == '') {
                btn.setAttribute('disabled');
            }

            if (validar_email(email.value) || email.value == '') { // validacion de email
                email.classList.remove('border-danger');
                email.classList.remove('shake');
                msg0.classList.add('d-none');
                if (email.value == '') {
                    btn.setAttribute('disabled');
                }
            }else{
                btn.setAttribute('disabled');

                email.classList.add('border-danger');
                email.classList.add('shake');
                msg0.classList.remove('d-none');
            }

            if ( (password.value).length >= 8 && (confPass.value).length >= 8 ) {
                password.classList.remove('border-danger');
                password.classList.remove('shake');
                msg3.classList.add('d-none');
                confPass.classList.remove('border-danger');
                confPass.classList.remove('shake');
                msg4.classList.add('d-none');

                if ( password.value == confPass.value ) {
                    password.classList.remove('border-danger');
                    password.classList.remove('shake');
                    msg1.classList.add('d-none');

                    confPass.classList.remove('border-danger');
                    confPass.classList.remove('shake');
                    msg2.classList.add('d-none');
                } else {
                    btn.setAttribute('disabled');
                    
                    password.classList.add('border-danger');
                    password.classList.add('shake');
                    msg1.classList.remove('d-none');

                    confPass.classList.add('border-danger');
                    confPass.classList.add('shake');
                    msg2.classList.remove('d-none');
                }
            } else {
                btn.setAttribute('disabled');

                password.classList.remove('border-danger');
                password.classList.remove('shake');
                msg1.classList.add('d-none');

                confPass.classList.remove('border-danger');
                confPass.classList.remove('shake');
                msg2.classList.add('d-none');

                if ( (password.value).length < 8 &&  (password.value).length > 0) {
                    password.classList.add('border-danger');
                    password.classList.add('shake');
                    msg3.classList.remove('d-none');
                }else{
                    password.classList.remove('border-danger');
                    password.classList.remove('shake');
                    msg3.classList.add('d-none');
                }
                if ( (confPass.value).length < 8 &&  (confPass.value).length > 0) {
                    confPass.classList.add('border-danger');
                    confPass.classList.add('shake');
                    msg4.classList.remove('d-none');
                }else{
                    confPass.classList.remove('border-danger');
                    confPass.classList.remove('shake');
                    msg4.classList.add('d-none');
                }
            }
        } else {
            btn.setAttribute('disabled');
        }

        if (!validar_email(email.value) && email.value != '') { // validacion de email
            email.classList.add('border-danger');
            email.classList.add('shake');
            msg0.classList.remove('d-none');
        }else{
            email.classList.remove('border-danger');
            email.classList.remove('shake');
            msg0.classList.add('d-none');
        }
    }

    function validar_email( email ){ // Validar que un string sea un email 
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email) ? true : false;
    }

    function infomodal(){ // Cargar al modal con informacion 
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

    function clearUser(){ // Resetear el formulario 
        let username = document.getElementById('Create_username');
        let email = document.getElementById('Create_email');
        let password = document.getElementById('Create_password');
        let confirmPassword = document.getElementById('Create_confirmPassword');
        
        username.value = "";
        email.value = "";
        password.value = "";
        confirmPassword.value = "";
    }
