const checkButtons = document.querySelectorAll ('.task-check');
checkButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        const taskId = event.currentTarget.dataset.taskId;
        console.log("Task cliquée : ", taskId);
    });
});