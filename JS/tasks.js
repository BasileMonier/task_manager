function attachCheckListener(button) {
  button.addEventListener("click", (event) => {
    const taskId = event.currentTarget.dataset.taskId;

    fetch("update-task.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ task_id: taskId })
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          button.classList.toggle("checked");
          const textSpan = button.parentElement.querySelector(".task-text");
          textSpan.classList.toggle("done");
        } else {
          console.error(data.error);
        }
      })
      .catch((error) => console.error("Request failed:", error));
  });
}

document.querySelectorAll(".task-check").forEach(attachCheckListener);



const createForm = document.getElementById("createForm");
const taskList = document.querySelector(".task-list");
const titleInput = document.getElementById("newTaskTitle");

createForm.addEventListener("submit", (event) => {
  event.preventDefault();

  const titre = titleInput.value.trim();
  if (titre === "") return; 

  fetch("create-task.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ titre: titre })
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        addTaskToPage(data.task);
        titleInput.value = ""; 
      } else {
        console.error(data.error);
      }
    })
    .catch((error) => console.error("Request failed:", error));
});

function addTaskToPage(task) {
  const emptyMsg = document.querySelector(".task-empty");
  if (emptyMsg) emptyMsg.remove();

  const angle = ((task.id % 5) - 2) * 0.5;

  const row = document.createElement("div");
  row.className = "task-row";

  const button = document.createElement("button");
  button.type = "button";
  button.className = "task-check";
  button.dataset.taskId = task.id;
  button.innerHTML = `<svg viewBox="0 0 24 24"><path d="M4 12l5 5L20 6"/></svg>`;

  const span = document.createElement("span");
  span.className = "task-text";
  span.style.transform = `rotate(${angle}deg)`;
  span.textContent = task.titre;

  const deleteBtn = document.createElement("button");
  deleteBtn.type = "button";
  deleteBtn.className = "task-delete";
  deleteBtn.dataset.taskId = task.id;
  deleteBtn.textContent = "×";

  row.appendChild(button);
  row.appendChild(span);
  row.appendChild(deleteBtn);
  taskList.appendChild(row);

  attachCheckListener(button);
  attachCheckListener(deleteBtn);
}

function attachDeleteListener(button) {
  button.addEventListener("click", (event) => {
    const taskId = event.currentTarget.dataset.taskId;
    const row = event.currentTarget.closest(".task-row");

    fetch("delete-task.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ task_id: taskId })
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          row.remove();
        } else {
          console.error(data.error);
        }
      })
      .catch((error) => console.error("Request failed:", error));
  });
}
document.querySelectorAll(".task-delete").forEach(attachDeleteListener);