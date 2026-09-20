const form = document.getElementById("formulaire");
  form.addEventListener("submit", (event) => {

    event.preventDefault();
    
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const errorText = document.getElementById("formError");

    if (email === "" || password === "") {
        errorText.textContent = "Merci de remplir tous les champs.";
    } else{
        errorText.textContent = "";
        form.submit()
    }
});