const checkButtons = document.querySelectorAll(".task-check");

checkButtons.forEach((buttons) => {
    buttons.addEventListener("click", (event) => {
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
                buttons.classList.toggle("checked");
                const texteSpan = buttons.parentElement.querySelector(".task-text");
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