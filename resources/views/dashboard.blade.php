<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
    <!-- @can('edit articles')
        <p>You can edit articles.</p>
    @endcan
    @can('delete articles')
    <p>You can delete articles.</p>
    @endcan
    @can('view posts')
    <p>You can view posts.</p>
    @endcan
    @can('create posts')
    <p>You can create posts.</p>
    @endcan
    @can('edit posts')
    <p>You can edit posts.</p>
    @endcan
    @can('delete posts')
    <p>You can delete posts.</p>
    @endcan -->
    <x-button.primary type="submit" class="danger">
        test
    </x-button.primary>
</x-app-layout>
