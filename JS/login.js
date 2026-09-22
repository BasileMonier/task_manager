const form = document.getElementById("loginForm");
form.addEventListener("submit", (event) => {
    
    event.preventDefault();
    
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const errorTexte = document.getElementById("formError");

    if (email === "" || password === "") {
        errorTexte.textContent = "Please fill in all fields.";
    } else {
        errorTexte.textContent = "";
        form.submit();
    }
});