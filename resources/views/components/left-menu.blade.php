<div class="w-full h-16 pt-4 text-center bg-indigo-900">
    <h2>CRM</h2>
</div>
<div class="w-full">
    <ul class="w-full">
        <x-left-menu-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-left-menu-link>

        <x-left-menu-link :href="route('users.index')" :active="request()->routeIs('users.index')">
            {{ __('Users') }}
        </x-left-menu-link>

        <x-left-menu-link :href="route('clients.index')" :active="request()->routeIs('clients.index')">
            {{ __('Clients') }}
        </x-left-menu-link>

        <x-left-menu-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">
            {{ __('Projects') }}
        </x-left-menu-link>

        <x-left-menu-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
            {{ __('Tasks') }}
        </x-left-menu-link>
    </ul>
</div>
