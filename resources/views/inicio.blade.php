<x-layout>
  <x-slot:head>
    <style>
      .hide-scrollbar::-webkit-scrollbar {
        display: none;
      }

      .hide-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
      }
    </style>
  </x-slot:head>
  <x-slot:title>Inicio</x-slot:title>
  <h1 class="text-2xl mb-2 font-bold text-white">Bienvenido {{ $user->name }}</h1>
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-3  sm:h-[76dvh] sm:overflow-hidden">
    <div class="w-full mb-6 bg-gradient-to-br from-violet-300 to-violet-500 rounded-xl p-8 flex flex-col items-center justify-center">
      <div class="text-white text-4xl font-extrabold tracking-tight mb-2">
        <span id="consola">
          00:00:00
        </span>
      </div>
      <div class="text-indigo-200 text-lg font-semibold">
        <span id="dia-anio-estatico">Hoy es el dia {{ $dayOfYear }} del año</span>
      </div>
      <div class="mt-4 text-md text-indigo-100 italic">
        {{ $fecha }}
      </div>
    </div>
    <div class="w-full bg-gradient-to-br from-violet-400 to-violet-500 rounded-lg shadow-blue-50-sm shadow-2xl p-4 md:p-6 mb-6 sm:col-span-2">
      <div class="flex justify-between mb-3">
        <div class="flex items-center">
          <div class="flex justify-center items-center">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Tu progreso</h5>
          </div>
        </div>
      </div>
      <div class=" p-5 rounded-lg">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-2">
          <dl class="bg-white rounded-lg flex flex-col items-center justify-center h-[80px] hover:scale-110 duration-300">
            <dt class="w-8 h-8 rounded-full bg-violet-400 text-sm font-medium flex items-center justify-center mb-1">{{ $totalTodoTasks }}</dt>
            <dd class="text-violet-400 text-sm font-medium">Pendiente</dd>
          </dl>
          <dl class="bg-white rounded-lg flex flex-col items-center justify-center h-[80px] hover:scale-110 duration-300">
            <dt class="w-8 h-8 rounded-full bg-teal-200 text-sm font-medium flex items-center justify-center mb-1">{{ $totalProgressTasks }}</dt>
            <dd class="text-teal-400 text-sm font-medium">En progreso</dd>
          </dl>
          <dl class="bg-white rounded-lg flex flex-col items-center justify-center h-[80px] hover:scale-110 duration-300">
            <dt class="w-8 h-8 rounded-full bg-red-400  text-violet-950 text-sm font-medium flex items-center justify-center mb-1">{{ $totalStopTasks }}</dt>
            <dd class="text-red-400 text-sm font-medium">Parado</dd>
          </dl>
          <dl class="bg-white rounded-lg flex flex-col items-center justify-center h-[80px] hover:scale-110 duration-300">
            <dt class="w-8 h-8 rounded-full bg-blue-500 text-sm font-medium flex items-center justify-center mb-1">{{ $totalDoneTasks }}</dt>
            <dd class="text-blue-600 text-sm font-medium">Finalizado</dd>
          </dl>
        </div>
      </div>
    </div>

    <div class="w-full flex justify-center sm:mt-15 ">
      <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white"><i>"Si estás caminando por el camino correcto y estás dispuesto a seguir caminando, eventualmente progresarás"</i></h2>
    </div>

    <!-- Radial Chart -->
    <div class="w-full flex justify-center">
      <div class="py-6" id="pie-chart"></div>
    </div>

    <div class="w-full sm:h-4/5 divide-gray-200 dark:divide-gray-700 col-span-1 sm:overflow-y-scroll hide-scrollbar">
      <h2 class="pt-3">Equipo</h2>
      <ul id="teamList" class="miembroEquipo pt-3">
        @foreach($teamMates as $teamMate)
        <li class="teamMember pb-4 sm:pb-5" data-id="{{ $teamMate->id }}">
          <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="shrink-0">
              <img class="w-8 h-8 rounded-full" src="{{ asset('img/TaskFlow.png') }}" alt="Neil image">
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                {{$teamMate->name}}
              </p>
            </div>
          </div>

          <div class="ml-12">
            <p class="text-sm text-violet-950">
              {{$teamMate->email}}
            </p>
          </div>

          <div class="flex justify-between mt-2">
            <span class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white ml-12"><span class="flex w-2.5 h-2.5 bg-blue-600 rounded-full me-1.5 shrink-0"></span>{{ $teamMate->rol }}</span>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>



  <x-slot:scripts>
    <script src="{{ asset('js/inicio.js') }}"></script>
  </x-slot:scripts>
</x-layout>