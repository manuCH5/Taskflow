<!DOCTYPE html>
<html lang="es">

<head>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cherry+Bomb+One');

    /* parrallax */
    .foto {
      border-radius: 10px;
      background: #ffffff;
      box-shadow: -11px 11px 21px #7d7d7d,
        11px -11px 21px #7d7d7d;

    }

    #a {
      background-image: url("{{ asset('img/trabajoEquipo.jpg') }}");
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .border,
    .wave {
      position: absolute;
      font-size: 15vmin;
      border-width: 0px;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      font-weight: bold;
    }

    .border {
      color: rgb(0, 0, 0);
      text-shadow:
        -1px,
        1px,
        -1px,
        1px;
    }

    .wave {
      color: #ddbaf8;
      animation: wave 3s ease-in-out infinite;
    }

    #poster {
      height: 200px;
      width: 300px;
      transition: box-shadow .1s, transform .2s;
      background-size: cover;
    }

    #poster:hover {
      box-shadow: 0px 0px 50px rgba(0, 0, 0, 1);
    }

    .va {
      view-timeline-name: --reveal;
      animation-name: show;
      animation-fill-mode: both;

      animation-timeline: --reveal;
      animation-range: entry 20% cover 40%;
    }

    @keyframes wave {

      0%,
      100% {
        clip-path: polygon(0% 47%,
            10% 48%,
            33% 54%,
            54% 60%,
            70% 61%,
            84% 59%,
            100% 52%,
            100% 100%,
            0% 100%);
      }

      50% {
        clip-path: polygon(0% 60%,
            15% 65%,
            34% 66%,
            51% 62%,
            67% 50%,
            84% 45%,
            100% 46%,
            100% 100%,
            0% 100%);
      }
    }

    @keyframes show {
      from {
        opacity: 0;
        scale: 10%
      }

      to {
        opacity: 1;
        scale: 100%
      }
    }

    @media (width <=648px) {

      .border,
      .wave {
        margin-top: 25px;
        font-size: 20vmin;
      }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-violet-200 to-violet-500">
  <header class="  absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between  lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="/" class="-m-1.5 p-1.5">
          <img class="h-20 w-auto" src="{{ asset('img/TaskFlow.png') }}" alt="taskflow">
        </a>
      </div>

      <div class="lg:flex lg:flex-1 lg:justify-end gap-x-6 gap">
        <x-normalButton href="/login">Login</x-normalButton>
        <x-normalButton href="/register">Register</x-normalButton>
      </div>
    </nav>
  </header>
  <div class="w-full mt-20 bg-white self-end">
    <div class=" w-full h-full relative isolate overflow-hidden px-6 pt-16 sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">

      <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
        <div class="mb-20">
          <h2 class="border font-semibold tracking-tight text-balance text-white sm:text-4xl top-0 sm:top-25">Taskflow</h2>
          <h2 class="wave font-semibold tracking-tight text-balance text-white sm:text-4xl top-0 
          sm:top-25">Taskflow</h2>
        </div>
        <p class="mt-26 text-lg/8 text-pretty text-violet-950">Organiza, colabora y crece. Mejora la productividad de tu equipo de forma sencilla y completamente gratuita.</p>
        <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
          <a href="/login" class="rounded-md bg-violet-200 px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white animate-bounce">Comienza Gratis Ahora</a>
          <!-- <a href="#a" class="text-sm/6 font-semibold text-violet-950">Descubre Más<span aria-hidden="true">→</span></a> -->
        </div>
      </div>
      <div id="poster" class="relative mt-16 h-80 lg:mt-8">
        <img class="foto absolute top-0 left-0 w-[65rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="{{ asset('img/tareas.jpg') }}" alt="App screenshot" width="1824" height="1080">
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
      </div>
    </div>
  </div>
  <hr class="h-px mb-20 bg-gray-200 border-0 dark:bg-gray-700">

  <!-- Titulo Task Flow -->
  <!-- <section class="relative isolate px-6 lg:px-8">
    <div class="mx-auto max-w-2xl py-20 sm:py-15 lg:py-23">
      <div class="flex justify-center">
        <h2 class="border">Taskflow</h2>
        <h2 class="wave">Taskflow</h2>
      </div>
      <div class="text-center">
        <p class="mt-45 sm:mt-60 text-lg font-medium text-pretty text-violet-950 sm:text-xl/8 animate-bounce">Mejora la productividad de tu equipo de forma totalmente gratuita</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="/login" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Empezar</a>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Promocion -->

  <section class="w-full flex justify-center mb-20 text-violet-950">
    <div id="a" class="w-11/12 relative isolate overflow-hidden bg-gray-900 rounded-4xl pt-20 pb-10 sm:pt-30 sm:pb-20">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <h2 class="text-5xl font-semibold tracking-tight  sm:text-4 ">Maximiza el Rendimiento de tu Equipo</h2>
          <p class="mt-8 text-lg font-medium text-pretty text-violet-800 sm:text-xl/8">Gestiona a tu equipo con flexibilidad, adaptándote a tu propio estilo de trabajo</p>
        </div>
        <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">

          <dl class=" grid grid-cols-2 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col-reverse gap-1 bg-blend-soft-light">
              <dt class="text-base/8 text-violet-800 font-bold">tus Equipos</dt>
              <dd class="text-4xl font-semibold tracking-tight ">Crea</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-violet-800 font-bold">tareas eficientemente</dt>
              <dd class="text-4xl font-semibold tracking-tight">Asigna</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-violet-800 font-bold">tu progreso</dt>
              <dd class="text-4xl font-semibold tracking-tight">Visualiza</dd>
            </div>
            <div class="flex flex-col-reverse gap-1">
              <dt class="text-base/7 text-violet-800 font-bold">siempre</dt>
              <dd class="text-4xl font-semibold tracking-tight">Gratis</dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </section>

  <div class="va overflow-hidden bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        <div class="lg:pt-4 lg:pr-8">
          <div class="lg:max-w-lg">
            <h2 class="text-base/7 font-semibold text-indigo-600">Colabora de Forma Inteligente</h2>
            <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-violet-950 sm:text-5xl">Diseño Intuitivo para una Gestión sin Esfuerzo</p>
            <p class="mt-6 text-lg/8 text-gray-600">Nuestra plataforma te ofrece una interfaz intuitiva y amigable, diseñada para que cualquier usuario pueda empezar a gestionar tareas sin complicaciones.</p>
            <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none">
              <div class="relative pl-9">
                <dt class="inline font-semibold text-violet-950">
                  <svg class="absolute top-1 left-1 size-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                  </svg>
                  Crear tareas de equipos.
                </dt>
                <dd class="inline">Crea tareas grupales asignando a varios miembros.</dd>
              </div>
              <div class="relative pl-9">
                <dt class="inline font-semibold text-violet-950">
                  <svg class="absolute top-1 left-1 size-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
                  </svg>
                  Crear tareas privadas.
                </dt>
                <dd class="inline">Define tareas privadas para usuarios individuales, manteniendo la confidencialidad y el enfoque personal.</dd>
              </div>
              <div class="relative pl-9">
                <dt class="inline font-semibold text-violet-950">
                  <svg class="absolute top-1 left-1 size-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path d="M4.632 3.533A2 2 0 0 1 6.577 2h6.846a2 2 0 0 1 1.945 1.533l1.976 8.234A3.489 3.489 0 0 0 16 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234Z" />
                    <path fill-rule="evenodd" d="M4 13a2 2 0 1 0 0 4h12a2 2 0 1 0 0-4H4Zm11.24 2a.75.75 0 0 1 .75-.75H16a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75V15Zm-2.25-.75a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75h-.01Z" clip-rule="evenodd" />
                  </svg>
                  Ver todas tus tareas.
                </dt>
                <dd class="inline">Visualiza todas tus tareas en un solo vistazo.</dd>
              </div>
            </dl>
          </div>
        </div>
        <img class="w-[48rem] max-w-none rounded-xl ring-1 shadow-xl ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0 hover:scale-105 duration-300" width="2432" height="1442" src="{{ asset('img/inicio.jpg') }}" alt="taskflow">
      </div>
    </div>
  </div>

  <div class="bg-gradient-to-br from-violet-200 to-violet-500 py-24 sm:py-32">
    <div class="va mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
      <p class="mx-auto mt-2 max-w-lg text-center text-4xl font-semibold tracking-tight text-balance text-gray-950 sm:text-5xl">Herramientas Completas a tu Alcance</p>
      <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
        <div class="relative lg:row-span-2">
          <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
          <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
            <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
              <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Con diseño responsive</p>
            </div>
            <div class="@container relative min-h-[30rem] w-full grow max-lg:mx-auto max-lg:max-w-sm hover:scale-110 duration-300">
              <div class="absolute inset-x-10 top-10 bottom-0 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
                <img class="size-full object-cover object-top" src="{{ asset('img/movil.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 lg:rounded-l-[2rem]"></div>
        </div>
        <div class="relative max-lg:row-start-1">
          <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
          <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
            <div class="px-8 pt-8 sm:px-10 sm:pt-10">
              <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Equipos</p>
              <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Potencia la colaboración en equipo y distribuye cargas de trabajo de manera eficiente para alcanzar tus objetivos.</p>
            </div>
            <div class="flex flex-1 items-center justify-center px-8 max-lg:pt-10 max-lg:pb-12 sm:px-10 lg:pb-2">
              <img class="w-full max-lg:max-w-xs" src="https://tailwindcss.com/plus-assets/img/component-images/bento-03-performance.png" alt="">
            </div>
          </div>
          <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 max-lg:rounded-t-[2rem]"></div>
        </div>
        <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
          <div class="absolute inset-px rounded-lg bg-white"></div>
          <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
            <div class="px-8 pt-8 sm:px-10 sm:pt-10">
              <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Incidencias</p>
              <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Soporte y Mejora Continua: Cuéntanos tu experiencia y ayúdanos a evolucionar la plataforma para satisfacer tus necesidades.</p>
            </div>
            <div class="@container flex flex-1 items-center max-lg:py-6 lg:pb-2">
              <p>
            </div>
          </div>
          <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"></div>
        </div>
        <div class="relative lg:row-span-2">
          <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
          <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
            <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
              <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Código abierto</p>
              <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Transparencia Total con Código Abierto.</p>
            </div>
            <div class="relative min-h-[30rem] w-full grow hover:scale-105 duration-300">
              <div class="absolute top-10 right-0 bottom-0 left-10 overflow-hidden rounded-tl-xl bg-gray-900 shadow-2xl">
                <div class="flex bg-gray-800/40 ring-1 ring-white/5">
                  <div class="-mb-px flex text-sm/6 font-medium text-gray-400"></div>
                </div>
                <div class="h-full">
                  <img
                    src="{{ asset('img/github.jpg') }}"
                    class=" h-full object-cover object-left rounded-xl"
                    alt="GitHub Image">
                </div>
              </div>
            </div>

          </div>
          <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-violet-950">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
      <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
          <a href="/welcome">
            <img class="h-20 w-auto" src="{{ asset('img/TaskFlow.png') }}" alt="taskflow">
          </a>
        </div>
        <div class="sm:flex items-center mb-10">
          <span class="text-sm text-gray-500 dark:text-gray-400">© 2025 Taskflow™.
          </span>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-10 sm:grid-cols-2">
          <div>
            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Recursos</h2>
            <ul class="text-gray-500 dark:text-gray-400 font-medium">
              <li class="mb-4">
                <a href="https://laravel.com/" class="hover:underline">Laravel</a>
              </li>
              <li>
                <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
              </li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Síguenos</h2>
            <ul class="text-gray-500 dark:text-gray-400 font-medium">
              <li class="mb-4">
                <a href="https://github.com/manuCH5/Taskflow" class="hover:underline ">Github</a>
              </li>
              <li>
                <a href="https://youtube.com" class="hover:underline">Youtube</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    const el = document.getElementById('poster');

    const height = el.clientHeight;

    const width = el.clientWidth;

    el.addEventListener("mousemove", (evt) => {
      const {
        layerX,
        layerY
      } = evt;

      const yRotation = ((layerX - width / 2) / width) * 20;

      const xRotation = -((layerY - height / 2) / height) * 20;

      const string = `
    perspective(500px)
    scale(1.1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)
  `;
      el.style.transform = string;
    });

    el.addEventListener('mouseout', () => {
      el.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)
  `
    });
  </script>
</body>

</html>