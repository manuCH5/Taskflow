<x-layout>
  <x-slot:head>
    <link rel="stylesheet" href="{{ asset('css/tareas.css') }}">
  </x-slot:head>
  <x-slot:title>Tareas</x-slot:title>
  <x-slot:h1>Tareas</x-slot:h1>
  <!-- 
  #region NO TAREAS 
  No tienes ninguna tarea -->
  <!-- @if(!$tasks) -->
  <!-- <div class="container columns w-full "> -->
  <!--Proxima tarea -->
  <!-- <div class="column">
      <div class="column-title">
        <h3 data-tasks="0">Próximas Tareas</h3>
        <button data-add><i class="bi bi-plus">➕</i></button>
      </div>
      <div class="tasks" id="next"></div>
    </div> -->
  <!--Por hacer tarea -->
  <!-- <div class="column">
      <div class="column-title">
        <h3 data-tasks="0">Por Hacer</h3>
        <button data-add><i class="bi bi-plus">➕</i></button>
      </div>
      <div class="tasks" id="todo">
      </div>
    </div> -->
  <!--En curso tarea -->
  <!-- <div class="column">
      <div class="column-title">
        <h3 data-tasks="0">En Curso</h3>
        <button data-add><i class="bi bi-plus">➕</i></button>
      </div>
      <div class="tasks" id="progress"></div>
    </div> -->
  <!--Finalizadas-->
  <!-- <div class="column">
      <div class="column-title">
        <h3 data-tasks="0">Finalizadas</h3>
      </div>
      <div class="tasks" id="done"></div>
    </div>
  </div> -->
  <!-- @else -->
  <!-- 
    #region TAREAS 
  -->
  <div class="container columns">
    <!--Proxima tarea -->
    <div class="column" data-status="todo">
      <div class="column-title">
        <h3 data-tasks="{{ $count['todo'] }}">Pendiente</h3>
        <button data-add><i class="bi bi-plus">➕</i></button>
      </div>
      <div class="tasks" id="todo">
        @foreach($tasks as $task)
        @if($task->status=="todo")
        <div class="task" draggable="true" ondragstart="handleDragstart(event)" ondragend="handleDragend(event)">
          <div id="{{ $task->id }}">{{ $task->title }}</div>
          <menu>
            <button data-edit><i class="bi bi-pencil-square">✏️</i></button>
            <button data-delete><i class="bi bi-trash">🗑️</i></button>
          </menu>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <!--En curso tarea -->
    <div class="column" data-status="progress">
      <div class="column-title">
        <h3 data-tasks="{{ $count['progress'] }}">En Curso</h3>
        <button data-add><i class="bi bi-plus">➕</i></button>
      </div>
      <div class="tasks" id="progress">
        @foreach($tasks as $task)
        @if($task->status=="progress")
        <div class="task" draggable="true" ondragstart="handleDragstart(event)" ondragend="handleDragend(event)">
          <div id="{{ $task->id }}">{{ $task->title }}</div>
          <menu>
            <button data-edit><i class="bi bi-pencil-square">✏️</i></button>
            <button data-delete><i class="bi bi-trash">🗑️</i></button>
          </menu>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <!--Parado tarea -->
    <div class="column" data-status="stop">
      <div class="column-title">
        <h3 data-tasks="{{ $count['stop'] }}">Parado</h3>
      </div>
      <div class="tasks" id="stop">
        @foreach($tasks as $task)
        @if($task->status=="stop")
        <div class="task" draggable="true" ondragstart="handleDragstart(event)" ondragend="handleDragend(event)">
          <div id="{{ $task->id }}">{{ $task->title }}</div>
          <menu>
            <button data-edit><i class="bi bi-pencil-square">✏️</i></button>
            <button data-delete><i class="bi bi-trash">🗑️</i></button>
          </menu>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <!--Finalizada tarea-->
    <div class="column" data-status="done">
      <div class="column-title">
        <h3 data-tasks="{{ $count['done'] }}">Finalizadas</h3>
      </div>
      <div class="tasks" id="done">
        @foreach($tasks as $task)
        @if($task->status=="done")
        <div class="task" data-tarea="{{ $task->id }}" draggable="true" ondragstart="handleDragstart(event)" ondragend="handleDragend(event)">
          <div id="{{ $task->id }}">{{ $task->title }}</div>
          <menu>
            <button data-edit><i class="bi bi-pencil-square">✏️</i></button>
            <button data-delete><i class="bi bi-trash">🗑️</i></button>
          </menu>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  <!-- @endif -->
  <!-- 
  #region MODAL
  -->
  <div id="create" class="fixed top-0 left-0 z-50 hidden w-full h-full flex justify-center items-center overflow-y-auto overflow-x-hidden md:inset-0 backdrop-brightness-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
          <h3 class="text-lg font-semibold text-violet-900">
            Crear una tarea
          </h3>
          <button type="button" id="cerrar-modal" class="cancel text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form method="dialog">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Titulo de Tarea</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el titulo" required />
              </div>
              <div class="col-span-2 pt-3">
                <div class="flex items-center rounded-mdpl-3">
                  <textarea id="createContent" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Describe tu tarea..." required></textarea>
                </div>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="asignFor" class="block mb-2 text-sm font-medium text-gray-900">Asignar a</label>
                <select id="asignFor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                  @if(!$users || $user->rol=="user")
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @else
                  @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <button type="submit" id="confirm" class="text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Crear tarea
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="edit" class="fixed top-0 left-0 z-50 hidden w-full h-full flex justify-center items-center overflow-y-auto overflow-x-hidden md:inset-0 backdrop-brightness-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">
            Editar la tarea
          </h3>
          <button type="button" id="cerrar-modal" class="cancel text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          <form method="dialog">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="titleEdit" class="block mb-2 text-sm font-medium text-gray-900">Titulo de Tarea</label>
                <input type="text" name="titleEdit" id="titleEdit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe el titulo" required />
              </div>
              <div class="col-span-2 pt-3">
                <div class="flex items-center rounded-mdpl-3">
                  <textarea id="editContent" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Describe tu tarea..." required></textarea>
                </div>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="asignFor2" class="block mb-2 text-sm font-medium text-black">Asignar a</label>
                <select id="asignFor2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                  @if(!$users || auth()->user()->rol == 'user')
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @else
                  @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <button type="submit" id="confirm" class="text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Editar tarea
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <dialog id="edit" class="confirm-modal">
    <form method="dialog">
      @csrf
      <h3>Editar Tarea</h3>
      <textarea id="editContent" required></textarea>
      <menu>
        <button type="button" class="cancel">Cancelar</button>
        <button type="submit" id="confirm">Editar.</button>
      </menu>
    </form>
  </dialog>

  <dialog id="delete" class="confirm-modal">
    <form method="dialog">
      <h3>Deseas borrar la tarea?</h3>
      <p>No podrás deshacer el cambio</p>
      <div class="preview"></div>

      <menu>
        <button type="button" class="cancel">Cancelar</button>
        <button type="submit" id="confirm">Borrar.</button>
      </menu>
    </form>
  </dialog>

  <x-slot:scripts>
    <script src="{{ asset('js/tareas.js') }}"></script>
  </x-slot:scripts>
</x-layout>