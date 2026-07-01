<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
@php
    $projectName = basename(base_path());
@endphp

<div class="hidden sm:-my-px sm:ms-10 sm:flex sm:items-center sm:space-x-6">

    <x-nav-link
        :href="route('dashboard')"
        :active="request()->routeIs('dashboard')"
    >
        {{ __('Dashboard') }}
    </x-nav-link>

    @can('admin-access')
        <div
            x-data="{ openUsers: false }"
            class="relative"
        >
            <button
                type="button"
                @click="openUsers = ! openUsers"
                @click.away="openUsers = false"
                class="inline-flex items-center px-1 pt-1 text-xs font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition"
            >
                Korisnici

                <i class="bi bi-chevron-down ms-1 text-[10px]"></i>
            </button>

            <div
                x-show="openUsers"
                x-transition
                class="absolute z-50 mt-2 w-56 rounded-md bg-white shadow-lg border border-gray-100"
                style="display: none;"
            >
                <div class="py-1">
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Popis korisnika
                    </a>

                    <a
                        href="{{ route('admin.users.indexPaginated') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Korisnici paginacija
                    </a>
                </div>
            </div>
        </div>
    @endcan

    <div
        x-data="{ openCategories: false }"
        class="relative"
    >
        <button
            type="button"
            @click="openCategories = ! openCategories"
            @click.away="openCategories = false"
            class="inline-flex items-center px-1 pt-1 text-xs font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition"
        >
            Kategorije

            <i class="bi bi-chevron-down ms-1 text-[10px]"></i>
        </button>

        <div
            x-show="openCategories"
            x-transition
            class="absolute z-50 mt-2 w-60 rounded-md bg-white shadow-lg border border-gray-100"
            style="display: none;"
        >
            <div class="py-1">
                <a
                    href="{{ route('categories.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Popis kategorija
                </a>

                <a
                    href="{{ route('categories.summary') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Statistika kategorija
                </a>

                <a
                    href="{{ route('categories.db') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Kategorije DB
                </a>
            </div>
        </div>
    </div>
    

    <div
        x-data="{ openProducts: false }"
        class="relative"
    >
        <button
            type="button"
            @click="openProducts = ! openProducts"
            @click.away="openProducts = false"
            class="inline-flex items-center px-1 pt-1 text-xs font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition"
        >
            Proizvodi

            <i class="bi bi-chevron-down ms-1 text-[10px]"></i>
        </button>

        <div
            x-show="openProducts"
            x-transition
            class="absolute z-50 mt-2 w-60 rounded-md bg-white shadow-lg border border-gray-100"
            style="display: none;"
        >
            <div class="py-1">
                <a
                    href="{{ route('products.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Popis proizvoda
                </a>

                <a
                    href="{{ route('products.search') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Pretraga proizvoda
                </a>

                <a
                    href="{{ route('dummy-products.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Dummy proizvodi
                </a>

                <a
                    href="{{ route('products.db') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Proizvodi DB
                </a>
            </div>
        </div>
    </div>

</div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


        </div>
         <div class="hidden sm:flex sm:items-center mr-6">
            <span class="text-xs text-gray-500">
                Projekt:
                <span class="font-semibold text-gray-700">
                    {{ $projectName }}
                </span>
            </span>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>