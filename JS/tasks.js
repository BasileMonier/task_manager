const checkButtons = document.querySelectorAll(".task-check");

checkButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        const taskId = event.currentTarget.dataset.taskId;

        fetch("update-task.php", {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify({ task_id: taskId})
        })
        .then((response) => response.json())
        .then((data) => {
            if(data.success) {
                button.classList.toggle("checked");
                const texteSpan = button.parentElement.querySelector(".task-text");
                texteSpan.classList.toggle("done");
            } else {
                console.error(data.error);
            }
        })
        .catch((error) => {
            console.error("Request failed:", error);
        })
    })
})