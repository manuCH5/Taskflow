<x-layout>
    <x-slot:head>
        <style>
            .card {
                backdrop-filter: blur(0px) saturate(100%);
                -webkit-backdrop-filter: blur(25px) saturate(100%);
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 1.125);
                box-shadow: 9px 9px 15px #777777,
                    -9px -9px 15px #ffffff;
            }
        </style>
    </x-slot:head>
    <x-slot:title>Incidencias</x-slot:title>
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
    </div>

    <section class="w-full flex justify-center pt-10 relative isolate px-6 lg:px-8">
        <div class="w-11/12 sm:w-1/3">
            <div class="card text-balance text-violet-950">
                <h3 class="text-3xl font-semibold tracking-tight  sm:text-4xl text-center pt-3">Incidencias</h3>
                <form method="post" action="/incidencias">
                    @csrf
                    <x-formImput type="mail" name="email" id="email" :value="old('email')">Email</x-formImput>
                    <x-formError name="email"></x-formError>


                    <div class="px-10 pt-3">
                        <div class="flex items-center rounded-mdpl-3">
                            <textarea id="content" name="content" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describe tu incidencia..."></textarea>
                        </div>
                    </div>
                    <div class="mt-5 flex items-center justify-center gap-x-6 pb-5">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-violet-700">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <div class="absolute inset-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 bg-linear-to-tr from-[#892fea] to-[#5100ff] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
</x-layout>