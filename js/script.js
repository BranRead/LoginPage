const passwordToggle = document.querySelector("#showPass");
const passwordEntry = document.querySelector("#password");
const showPasswordLabel = document.querySelector("#showPassLabel");

passwordToggle.addEventListener("click", function () {
    console.log("CLICK")
    if(this.checked === true) {
        passwordEntry.setAttribute("type", "text");
        showPasswordLabel.innerHTML = "Hide password";
    } else {
        passwordEntry.setAttribute("type", "password");
        showPasswordLabel.innerHTML = "Show password";
    }
})