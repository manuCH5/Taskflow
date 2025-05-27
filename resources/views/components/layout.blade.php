<x-base>
  <x-slot:head>{{ $head ?? '' }}</x-slot:head>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="min-h-dvh ">
    <nav>
      <div class="mx-auto sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="shrink-0">
              <a href="/inicio"><img class="h-15 w-auto" src="{{ asset('img/TaskFlow.png') }}" alt="taskflow"></a>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <x-links href="/inicio" :active="request()->is('inicio')">Inicio</x-links>
                <x-links href="/tareas" :active="request()->is('tareas')">Tareas</x-links>
                <x-links href="/equipo" :active="request()->is('equipo')">Equipo</x-links>
                <x-links href="/incidencias" :active="request()->is('incidencias')">Incidencias</x-links>
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <!-- Profile dropdown -->
              <div class="relative ml-3">
                <div>
                  <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img class="size-8 rounded-full" alt="">
                  </button>
                </div>

                <div class="absolute right-0 z-10 mt-2 w-20 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <button id="showDrawerButton" class="block px-4 py-2 text-sm text-gray-700 pointer-coarse">Perfil</button>
                  <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</a> -->
                  <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 pointer-coarse">Logout</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <x-linksMobile href="/inicio" :active="request()->is('inicio')">Inicio</x-linksMobile>
          <x-linksMobile href="/tareas" :active="request()->is('tareas')">Tareas</x-linksMobile>
          <x-linksMobile href="/equipo" :active="request()->is('equipo')">Equipo</x-linksMobile>
          <x-linksMobile href="/incidencias" :active="request()->is('incidencias')">Incidencias</x-linksMobile>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
          <div class="flex items-center px-5">
            <div class="shrink-0">
              <img class="size-10 rounded-full" src="" alt="">
            </div>
            <div class="ml-3">
              <div class="text-base/5 font-medium text-white">Tom Cook</div>
              <div class="text-sm font-medium text-gray-400">tom@example.com</div>
            </div>


            <button type="submit" class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log out</button>
          </div>
          <!--
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
-->
        </div>
      </div>
    </nav>

    <!-- <div id="drawerForm" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-form-label">
      <h5 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
        <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
        </svg>
        New event
      </h5>
      <button type="button" id="hideDrawerButton" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
      </button>
      <form class="mb-6">
        <div class="mb-6">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
          <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Apple Keynote" required />
        </div>
        <div class="mb-6">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Apple Keynote" required />
        </div>
        <div class="mb-6">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload images</label>
          <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imageUpload" type="file" accept="image/*" multiple>
          <div id="imagePreviewContainer" class="mt-2 flex flex-wrap gap-2">
          </div>
        </div>
        <div class="mb-4">
          <label for="guests" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Invite guests</label>
          <div class="relative">
            <input type="search" id="guests" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add guest email" required />
            <button type="button" id="addGuestButton" class="absolute inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg end-2 bottom-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
              </svg>
              Add
            </button>
          </div>
        </div>
        <div id="guestAvatars" class="flex mb-4 -space-x-4 rtl:space-x-reverse">
        </div>
        <button type="submit" id="createEventButton" class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
            <path d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z" />
          </svg>
          Create event
        </button>
      </form>
    </div> -->

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>

  <!-- AÑADE ESTE SCRIPT AL FINAL DEL BODY -->

  <x-slot:scripts>
    <script>
      // Dropdown del usuario (desktop)
      const userMenuButton = document.getElementById('user-menu-button');
      const userMenu = userMenuButton?.parentElement?.nextElementSibling;

      userMenuButton?.addEventListener('click', () => {
        userMenu?.classList.toggle('hidden');
      });

      // Menú móvil toggle
      const mobileMenuButton = document.querySelector('button[aria-controls="mobile-menu"]');
      const mobileMenu = document.getElementById('mobile-menu');
      const openIcon = mobileMenuButton.querySelector('svg.block');
      const closeIcon = mobileMenuButton.querySelector('svg.hidden');

      mobileMenuButton?.addEventListener('click', () => {
        const isExpanded = mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');

        // Alterna iconos
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
      });

      // Inicialmente ocultar el menú desplegable y el móvil si no están ya ocultos
      userMenu?.classList.add('hidden');
      mobileMenu?.classList.add('hidden');

      // document.addEventListener('DOMContentLoaded', () => {
      //   const drawerForm = document.getElementById('drawerForm');
      //   const showDrawerButton = document.getElementById('showDrawerButton');
      //   const hideDrawerButton = document.getElementById('hideDrawerButton');
      //   const guestsInput = document.getElementById('guests');
      //   const addGuestButton = document.getElementById('addGuestButton');
      //   const guestAvatarsContainer = document.getElementById('guestAvatars');
      //   const createEventButton = document.getElementById('createEventButton');
      //   const eventDateInput = document.getElementById('eventDate');

      //   // Function to show the drawer
      //   function showDrawer() {
      //     drawerForm.classList.remove('-translate-x-full');
      //     drawerForm.classList.add('translate-x-0');
      //   }

      //   // Function to hide the drawer
      //   function hideDrawer() {
      //     drawerForm.classList.remove('translate-x-0');
      //     drawerForm.classList.add('-translate-x-full');
      //   }

      //   // Event listeners for showing and hiding the drawer
      //   showDrawerButton.addEventListener('click', showDrawer);
      //   hideDrawerButton.addEventListener('click', hideDrawer);

      //   // Close drawer when clicking outside (optional, but good for UX)
      //   document.addEventListener('click', (event) => {
      //     if (!drawerForm.contains(event.target) && !showDrawerButton.contains(event.target)) {
      //       hideDrawer();
      //     }
      //   });

      //   // --- Guest Management ---
      //   const guests = []; // Array to store guest emails

      //   function addGuest() {
      //     const email = guestsInput.value.trim();
      //     if (email && !guests.includes(email)) {
      //       guests.push(email);
      //       renderGuestAvatars();
      //       guestsInput.value = ''; // Clear input field
      //     }
      //   }

      //   function renderGuestAvatars() {
      //     guestAvatarsContainer.innerHTML = ''; // Clear existing avatars
      //     guests.forEach(email => {
      //       const img = document.createElement('img');
      //       img.classList.add('w-8', 'h-8', 'border-2', 'border-white', 'rounded-full', 'dark:border-gray-800');
      //       // You'd typically use a service like Gravatar for real avatars based on email
      //       // For demonstration, let's use placeholder images or initials
      //       // Here, we'll use a generic placeholder for simplicity.
      //       img.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(email)}&background=random&color=fff`;
      //       img.alt = email;
      //       img.title = email; // Show email on hover
      //       guestAvatarsContainer.appendChild(img);
      //     });
      //   }

      //   addGuestButton.addEventListener('click', addGuest);
      //   guestsInput.addEventListener('keypress', (e) => {
      //     if (e.key === 'Enter') {
      //       e.preventDefault(); // Prevent form submission
      //       addGuest();
      //     }
      //   });


      //   // --- Form Submission (Example) ---
      //   createEventButton.addEventListener('click', (event) => {
      //     event.preventDefault(); // Prevent default form submission

      //     const title = document.getElementById('title').value;
      //     const description = document.getElementById('description').value;
      //     const eventDate = document.getElementById('eventDate').value;

      //     // Basic validation
      //     if (!title || !description || !eventDate || guests.length === 0) {
      //       alert('Please fill in all fields and add at least one guest.');
      //       return;
      //     }

      //     const eventData = {
      //       title,
      //       description,
      //       date: eventDate,
      //       guests: guests
      //     };

      //     console.log('Event Data:', eventData);
      //     alert('Event created successfully! Check console for data.');
      //     hideDrawer(); // Hide the drawer after submission
      //     // You would typically send this data to a server using fetch() or XMLHttpRequest
      //   });
      // });
    </script>
    {{ $scripts ?? '' }}
  </x-slot:scripts>
</x-base>