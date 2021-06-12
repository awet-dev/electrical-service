const btnLogin = document.getElementById("tab-login");
const btnRegister = document.getElementById("tab-register");

const formLogin = document.getElementById("pills-login");
const formRegister = document.getElementById("pills-register");


function switchForm(btnOne, btnTwo, formOne, formTwo) {
    btnOne.addEventListener("click", function () {
        formTwo.classList.remove("show", "active");
        formOne.classList.add("show", "active");

        btnOne.classList.add("active");
        btnTwo.classList.remove("active");
    })
}

switchForm(btnRegister, btnLogin, formRegister, formLogin);
switchForm(btnLogin, btnRegister, formLogin, formRegister);

