<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .card {
            backdrop-filter: blur(25px) saturate(100%);
            -webkit-backdrop-filter: blur(25px) saturate(100%);
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 1.125);
            box-shadow: 9px 9px 15px #777777,
                -9px -9px 15px #ffffff;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-violet-200 to-violet-500 h-dvh">
    <header class="inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <a href="/" class="-m-1.5 p-1.5">
                <img class="h-20 w-auto" src="{{ asset('img/TaskFlow.png') }}" alt="taskflow">
            </a>
        </nav>
    </header>

    <section class="w-full flex justify-center pt-10 relative isolate px-6 lg:px-8">
        <div class="w-11/12 sm:w-1/3">
            <div class="card text-balance text-violet-950">
                <h3 class="text-3xl font-semibold tracking-tight  sm:text-4xl text-center mt-3">Login</h3>
                <form method="post" action="/login">
                    @csrf
                    <x-formImput type="mail" name="email" id="email" :value="old('email')">Email</x-formImput>
                    <x-formError name="email"></x-formError>

                    <x-formImput type="password" name="password" id="password">Contraseña</x-formImput>
                    <x-formError name="password"></x-formError>

                    <div class="mt-5 flex items-center justify-center gap-x-6 pb-5">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xshover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>