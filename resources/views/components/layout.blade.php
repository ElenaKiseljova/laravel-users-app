@props(['title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
    <link href="{{ asset('css/tailwindcss.css') }}" rel="stylesheet" />
  @endif
</head>

<body
  class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
  <header class="flex justify-between gap-x-5 w-full max-w-screen-xl text-sm mb-6 empty:hidden">
    @if (!request()->routeIs('main'))
      <a href="{{ route('main') }}" class="hover:opacity-75 flex flx-row gap-x-1 align-middle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>

        <span class="text-xl">Main</span>
      </a>
    @endif

    @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
          <a href="{{ url('/dashboard') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
            Dashboard
          </a>
        @else
          <a href="{{ route('login') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
            Log in
          </a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}"
              class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
              Register
            </a>
          @endif
        @endauth
      </nav>
    @endif
  </header>
  <div
    class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
    <main class="w-full max-w-screen-xl">
      <h1 class="text-3xl font-bold mb-6 pb-2 border-b-2">{{ $title }}</h1>

      {{ $slot }}
    </main>
  </div>

  @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
  @endif
</body>

</html>
