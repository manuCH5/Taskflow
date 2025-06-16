document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('crud-modal');
  const modalEdit = document.getElementById('crud-modal-edit');
  const abrirModalBtn = document.getElementById('abrir-modal');
  const cerrarModalBtn = document.getElementById('cerrar-modal');
  const nombreInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const roleSelect = document.getElementById('role');
  let abrirModalEditar = document.querySelector(".miembroEquipo");
  let cerrarModalEdit = document.getElementById('cerrar-modal-edit');
  let nombreInput2 = document.getElementById('name2');
  let emailInput2 = document.getElementById('email2');
  let roleSelect2 = document.getElementById('role2');
  let modalDelete = document.getElementById('crud-modal-delete');
  let cerrarModalDelete = document.getElementById('cerrar-modal-delete');


  let idEdit;


  function handleEditTeamMember(event) {
    modalEdit.classList.remove('hidden');
    fetch(`/equipo/getDatos`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        id: idEdit
      }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          nombreInput2.value = data.user.name;
          emailInput2.value = data.user.email;
          roleSelect2.value = data.user.rol;
        }
      })
      .catch(error => console.error("Error en fetch:", error));
  };

  abrirModalBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
  });

  cerrarModalBtn.addEventListener('click', () => {
    nombreInput.value = "";
    emailInput.value = "";
    roleSelect.value = "";
    modal.classList.add('hidden');
  });

  modal.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.classList.add('hidden');
    }
  });

  abrirModalEditar.addEventListener("click", (event) => {
    let id = event.target.closest(".teamMember").dataset.id;
    idEdit = id;
    if (event.target.closest("button[data-edit]")) {
      handleEditTeamMember(event);
    }
    else if (event.target.closest("button[data-delete]")) {
      modalDelete.classList.remove('hidden');
    }
  });

  cerrarModalEdit.addEventListener('click', () => {
    idEdit = "";
    nombreInput2.value = "";
    emailInput2.value = "";
    roleSelect2.value = "";
    modalEdit.classList.add('hidden');
  });

  cerrarModalDelete.addEventListener('click', () => {
    modalDelete.classList.add('hidden');
  });

  modal.addEventListener('submit', function (event) {
    event.preventDefault(); // Previene la recarga de la página

    const nombre = nombreInput.value;
    const email = emailInput.value;
    const role = roleSelect.value;

    console.log('Nombre:', nombre);
    console.log('Email:', email);
    console.log('Categoría:', role);

    fetch('/equipo/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        name: nombre,
        email: email,
        role: role
      })
    })
      .then(response => response.json())
      .then(data => {
        // alert('Miembro añadido correctamente!');
        nombreInput.value = '';
        emailInput.value = '';
        roleSelect.value = 'admin';
        modal.classList.add('hidden');

        let li = document.createElement("li");

        li.className = 'teamMember pb-4 sm:pb-5';
        li.dataset.id = data.user;
        li.innerHTML = `<div class="flex items-center space-x-4 rtl:space-x-reverse">
          <div class="shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/Taskflow.png" alt="Neil image">
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
            ${nombre}
            </p>
          </div>
        </div>
        
        <div class="ml-12">
          <p class="text-sm text-violet-950 truncate">
            ${email}
          </p>
        </div>
        <div class="flex justify-between mt-2">
          <span class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white ml-12"><span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>${roleSelect.value}</span>
          <div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <button data-edit type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Editar</button>
          </div>
          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <button data-delete type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Borrar</button>
          </div>
          </div>
        </div>`;
        document.getElementById("teamList").appendChild(li);
      })
      .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al añadir el miembro.');
      });
  });

  modalEdit.addEventListener("submit", function (event) {
    fetch('/equipo/edit', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        id: idEdit,
        name: nombreInput2.value,
        email: emailInput2.value,
        role: roleSelect2.value
      })
    })
      .then(response => response.json())
      .then(data => {

        // alert(data.message);
        li = document.querySelector(`[data-id="${idEdit}"]`);
        li.innerHTML = `<div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="shrink-0">
              <img class="w-8 h-8 rounded-full" src="img/TaskFlow.png" alt="Neil image">
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                ${nombreInput2.value}
              </p>
            </div>
          </div>

          <div class="ml-12">
            <p class="text-sm text-violet-950 truncate">
              ${emailInput2.value}
            </p>
          </div>

          <div class="flex justify-between mt-2">
            <span class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white ml-12"><span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>${roleSelect2.value}</span>
            <div>
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <button data-edit type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Editar</button>
              </div>
              <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <button data-delete type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Borrar</button>
              </div>

            </div>
          </div>`;
          modalEdit.classList.add('hidden');
      })
      .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al añadir el miembro.');
      });
  });

  modalDelete.addEventListener("submit",function () {
    fetch('/equipo/delete', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        id: idEdit,
      })
    })
      .then(response => response.json())
      .then(data => {
        // alert("borrado");
        let child = document.querySelector(`[data-id="${idEdit}"]`);
        let parent = document.getElementById("teamList");

        parent.removeChild(child);
        modalDelete.classList.add('hidden');
      })
      .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al añadir el miembro.');
      });
  })
});