@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1  border-b-2 border-indigo-400 dark:border-indigo-600 text-lg font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1  border-b-2 border-transparent text-lg font-medium leading-5 text-lg text-gray-500 hover:text-blue-500 hover:font-bold  dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
