const modal = document.getElementById('delete');
const modal2 = document.getElementById("create")
const modal3 = document.getElementById("edit")
const columnsContainer = document.querySelector(".columns");
const columns = columnsContainer.querySelectorAll(".column");
let state;
var id;

let currentTask = null;

//* functions
//#region  DRAGABLE
const handleDragover = (event) => {
  event.preventDefault(); // allow drop

  const draggedTask = document.querySelector(".dragging");
  const target = event.target.closest(".task, .tasks");

  if (!target || target === draggedTask) return;

  if (target.classList.contains("tasks")) {
    // target is the tasks element
    const lastTask = target.lastElementChild;
    if (!lastTask) {
      // tasks is empty
      target.appendChild(draggedTask);
    } else {
      const { bottom } = lastTask.getBoundingClientRect();
      event.clientY > bottom && target.appendChild(draggedTask);
    }
  } else {
    // target is another
    const { top, height } = target.getBoundingClientRect();
    const distance = top + height / 2;

    if (event.clientY < distance) {
      target.before(draggedTask);
    } else {
      target.after(draggedTask);
    }
  }
};

const handleDrop = (event) => {
  event.preventDefault();
};

const handleDragend = (event) => {
  event.target.classList.remove("dragging");
  id = event.target.closest(".task").querySelector("div").getAttribute('id');
  state = event.target.closest(".column").dataset.status;
  dragTask(id, state, event);
};

const handleDragstart = (event) => {
  event.dataTransfer.effectsAllowed = "move";
  event.dataTransfer.setData("text/plain", "");
  requestAnimationFrame(() => event.target.classList.add("dragging"));
};

//#region CRUD
const handleDelete = (event) => {
  currentTask = event.target.closest(".task");
  id = event.target.closest(".task").querySelector("div").getAttribute('id');
  // show preview
  modal.querySelector(".preview").innerText = currentTask.innerText.substring(
    0,
    100
  );

  modal.showModal();
};

const handleCreate = (event) => {
  const tasksEl = event.target.closest(".column").lastElementChild;
  state = event.target.closest(".column").dataset.status;
  document.getElementById("title").value = "";
  document.getElementById("createContent").value = "";
  modal2.classList.remove('hidden');
};

const handleEdit = (event) => {
  id = event.target.closest(".task").querySelector("div").getAttribute('id');

  fetch(`/tareas/getData`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      id: id
    }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        let title = event.target.closest(".task").querySelector("div").innerHTML;
        state = event.target.closest(".column").dataset.status;
        document.getElementById('titleEdit').value = title;
        document.getElementById("editContent").value = data.task.content;
        modal3.classList.remove('hidden');
      } else {
        console.error("Error al actualizar");
      }
    })
    .catch(error => console.error("Error en fetch:", error));
};

const handleBlur = (event) => {
  const input = event.target;
  const content = input.innerText.trim() || "Untitled";
  const task = createTask(content.replace(/\n/g, "<br>"));
  input.replaceWith(task);
};


const updateTaskCount = (column) => {
  const tasks = column.querySelector(".tasks").children;
  const taskCount = tasks.length;
  column.querySelector(".column-title h3").dataset.tasks = taskCount;
};

const observeTaskChanges = () => {
  for (const column of columns) {
    const observer = new MutationObserver(() => updateTaskCount(column));
    observer.observe(column.querySelector(".tasks"), { childList: true });
  }
};

observeTaskChanges();

//#region PETICIONES

const createTask = (content, event) => {
  let title = document.getElementById("title").value;
  console.log(title)
  let content2 = document.getElementById("createContent").value;
  let asignFor = document.getElementById("asignFor").value;
  fetch(`/tareas/create`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      title: title,
      content: content2,
      status: state,
      asignFor: asignFor
    }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        if (asignFor == data.user_id) {
          const taskElement = document.createElement('div');
          taskElement.className = 'task';
          taskElement.draggable = true;
          taskElement.innerHTML = `
        <div id="${data.id}">${content}</div>
        <menu>
          <button data-edit>✏️</button>
          <button data-delete>🗑️</button>
        </menu>
        `;

          // Añadir eventos drag si necesitas
          taskElement.addEventListener('dragstart', handleDragstart);
          taskElement.addEventListener('dragend', handleDragend);

          // Buscar la columna correcta
          const column = document.getElementById(state);
          column.appendChild(taskElement);
        }

        // Cerrar el modal
        modal2.classList.add('hidden');
      } else {
        console.error("Error al actualizar");
      }
    })
    .catch(error => console.error("Error en fetch:", error));
};

const editTask = (id, content, event) => {
  let content2 = document.getElementById("editContent").value;
  fetch(`/tareas/edit`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      id: id,
      title: content,
      content: content2,
      status: state
    }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById(`${id}`).innerHTML = content;
        // Cerrar el modal
        modal3.classList.add('hidden');
      } else {
        console.error("Error al actualizar");
      }
    })
    .catch(error => console.error("Error en fetch:", error));
}

const deleteTask = (id) => {
  fetch(`/tareas/delete`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      id: id,
    }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Cerrar el modal
        modal.classList.add('hidden');
      } else {
        console.error("Error al actualizar");
      }
    })
    .catch(error => console.error("Error en fetch:", error));
}

const dragTask = (id, state) => {
  fetch(`/tareas/edit`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      id: id,
      state: state
    }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Cerrar el modal
      } else {
        console.error("Error al actualizar");
      }
    })
    .catch(error => console.error("Error en fetch:", error));
}

// dragover and drop
tasksElements = columnsContainer.querySelectorAll(".tasks");
for (const tasksEl of tasksElements) {
  tasksEl.addEventListener("dragover", handleDragover);
  tasksEl.addEventListener("drop", handleDrop);
}
// #region BOTONES
// add, edit and delete task
columnsContainer.addEventListener("click", (event) => {
  if (event.target.closest("button[data-add]")) {
    handleCreate(event);
  } else if (event.target.closest("button[data-edit]")) {
    handleEdit(event);
  } else if (event.target.closest("button[data-delete]")) {
    handleDelete(event);
  }
});
//BORRAR
// confirm deletion
modal.addEventListener("submit", () => {
  currentTask && currentTask.remove();
  deleteTask(id);
});

// cancel deletion
modal.querySelector(".cancel").addEventListener("click", () => modal.close());

// clear current task
modal.addEventListener("close", () => (currentTask = null));

//CREAR

modal2.addEventListener("submit", (event) => {
  const content = document.getElementById("title").value;
  const task = createTask(content.replace(/\n/g, "<br>"), event);
  // input.replaceWith(task);
});

// cancel deletion
modal2.querySelector(".cancel").addEventListener("click", () => modal2.classList.add('hidden'));

// clear current task
modal2.addEventListener("close", () => (currentTask = null));

//EDITAR

modal3.addEventListener("submit", (event) => {
  const content = document.getElementById("titleEdit").value;
  const task = editTask(id, content.replace(/\n/g, "<br>"), event);
});

// cancel deletion
modal3.querySelector(".cancel").addEventListener("click", () => modal3.classList.add('hidden'));

// clear current task
modal3.addEventListener("close", () => (currentTask = null));