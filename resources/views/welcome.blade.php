<x-guest-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <x-application-logo class="w-20 h-20" />
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ __('Welcome to') }} {{ config('app.name', 'Laravel') }}
                    </h1>
                    <p class="text-gray-600">
                        {{ __('This is a more detailed welcome page. You can customize it further based on your needs.') }}
                    </p>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <a href="{{ route('login') }}" class="ml-1 underline">
                            {{ __('Log in') }}
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 underline">
                                {{ __('Register') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <x-button.primary
            :class="'primary'"
            type="submit"
            >
            {{ 'ffftest' }}
        </x-button.primary>
        </div>
    </div>
</x-guest-layout>