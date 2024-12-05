{{-- @php
    $pages = [
        ['name' => 'menu1', 'to' => 'to'],
        ['name' => 'menu2', 'to' => 'to'],
        ['name' => 'menu3', 'to' => 'to'],
        ['name' => 'menu4', 'to' => 'to'],
        ['name' => 'menu3', 'sublinks' => [
            ['name' => 'menu1', 'to' => 'to'],
            ['name' => 'menu2', 'to' => 'to'],
            ['name' => 'menu3', 'to' => 'to']
        ]]
    ]
@endphp --}}
@props(['pages'])


<nav id="header" x-data="{ open: false }" class=" dark:bg-gray-800  dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="flex flex-end">

                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
                @foreach ($pages as $page )
                    <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                        @if(isset($page['sublinks']))
                            <div class="hidden sm:flex sm:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                                        {{--hnav-item selector from app.js  --}}
                                        <button class=" hnav-item inline-flex items-center  py-2 border border-transparent leading-4 font-semibold rounded-md text-gray-200 dark:text-gray-200 dark:bg-gray-800 text-lg hover:text-white hover:font-bold dark:hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ $page['name'] }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        @foreach ($page['sublinks'] as $sublink)
                                            <x-dropdown-link :href="route('home')">
                                                {{ __($sublink['name']) }}
                                            </x-dropdown-link>
                                        @endforeach
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <x-nav-link :active="false" :href="route('home')">
                                {{ __($page['name']) }}
                            </x-nav-link>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Settings Dropdown -->
            {{-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>username</div>

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
                    </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @foreach ($pages as $page )
            <div class=" border-t border-gray-200 dark:border-gray-600">
                <div class=" space-y-1">
                    <x-responsive-nav-link 
                    {{-- :href="route('profile.edit')" --}}
                    >
                        {{ __($page['name']) }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endforeach
    </div>
</nav>
