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

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
  <header class="grid grid-cols-2 gap-x-5 w-full max-w-screen-xl text-sm mb-6 empty:hidden">
    <div class="flex justify-start gap-x-5 w-fit">
      @if (!request()->routeIs('main'))
        <a href="{{ route('main') }}" class="link hover:opacity-75 text-center">
          <span class="text-xl">Main</span>
        </a>
      @endif
      @auth
        <a href="{{ route('users.index') }}" class="link link-secondary hover:opacity-75 text-center">
          <span class="text-xl">Users</span>
        </a>
        <a href="{{ route('positions.index') }}" class="link link-primary hover:opacity-75 text-center">
          <span class="text-xl">Positions</span>
        </a>
      @endauth

    </div>

    @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4">
        @auth
          <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ms-6 shrink-0">
            <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                <button
                  class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <div>{{ Auth::user()->name }}</div>

                  <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </button>
              </x-slot>

              <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                  {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </x-dropdown-link>
                </form>
              </x-slot>
            </x-dropdown>
          </div>

          <!-- Hamburger -->
          <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        @else
          <a href="{{ route('login') }}"
            class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal">
            Log in
          </a>

          @if (Route::has('register'))
            <a href="{{ route('register') }}"
              class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal">
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
