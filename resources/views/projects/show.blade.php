<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }}
        </h2>
    </x-slot>
    <div class="mx-auto mt-16 max-w-2l sm:mt-20 lg:mt-24 lg:max-w-4l">
      <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-1 lg:gap-y-10">
        <div class="relative pl-16">
          <dt class="text-base/7 font-semibold text-gray-900">
            {{__('Title')}}
          </dt>
          <dd class="mt-2 text-base/7 text-gray-600">{{$project->title}}</dd>
        </div>
        <div class="relative pl-16">
          <dt class="text-base/7 font-semibold text-gray-900">
             {{__('Description')}}
          </dt>
          <dd class="mt-2 text-base/7 text-gray-600">{{$project->description}}</dd>
        </div>
      </dl>
    </div>

</x-app-layout>