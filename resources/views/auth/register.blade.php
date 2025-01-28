<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-8">

<form method="POST" action="{{ route('register') }}" class="max-w-lg mx-auto p-6 bg-white shadow-lg rounded-lg">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" class="text-lg font-medium text-gray-900" />
        <x-text-input id="name" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
    </div>

    <!-- Email Address -->
    <div class="mt-6">
        <x-input-label for="email" :value="__('Email')" class="text-lg font-medium text-gray-900" />
        <x-text-input id="email" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
    </div>

    <!-- Password -->
    <div class="mt-6">
        <x-input-label for="password" :value="__('Password')" class="text-lg font-medium text-gray-900" />
        <x-text-input id="password" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-6">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-lg font-medium text-gray-900" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
    </div>

    <!-- Submit and Links -->
    <div class="flex items-center justify-between mt-6">
        <a class="text-sm text-gray-600 hover:text-gray-900 transition duration-300" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
</div>
</body>
</html>