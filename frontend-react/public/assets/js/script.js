const eye = document.getElementById('eye');
const password = document.getElementById('password');
const nome = document.getElementById('nome');
const cognome = document.getElementById('cognome');
const email = document.getElementById('email');

let loginPwdStatus = false;


eye.addEventListener('click', function(){

    if(loginPwdStatus === false){
        password.setAttribute("type","text");
        loginPwdStatus = true;
        console.log(loginPwdStatus)
    } else if (loginPwdStatus === true){
        password.setAttribute("type","password");
        loginPwdStatus = false;
        console.log(loginPwdStatus);
    }
    console.log(password.value.length);
})

function validate(){
    if(password.value.length < 8){
        password.value = "";
        password.setAttribute("placeholder","la password deve contenere almeno 8 caratteri");
        return false;
    }
}