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
            <!-- <div class="shrink-0">
              <img class="size-10 rounded-full" src="" alt="">
            </div>
            <div class="ml-3">
              <div class="text-base/5 font-medium text-white">Tom Cook</div>
              <div class="text-sm font-medium text-gray-400">tom@example.com</div>
            </div> -->


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

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>

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