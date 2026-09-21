const form = document.getElementById("formulaire");
  form.addEventListener("submit", (event) => {

    event.preventDefault();
    
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const errorText = document.getElementById("formError");

    if (email === "" || password === "") {
        errorText.textContent = "Please fill in all fields.";
    } else{
        errorText.textContent = "";
        form.submit()
    }
});