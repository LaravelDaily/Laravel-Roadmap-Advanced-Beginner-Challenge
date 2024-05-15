<button {{ $attributes->merge(['type' => 'button', 'class' => 'block px-4 py-2 text-sm w-full text-left text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white']) }}>
    {{ $slot }}
</button>
