<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
          <!-- Monthly Salary -->
          <div class="mt-4">
            <x-input-label for="monthly_salary" :value="__('Monthly Salary (DH)')" />
            <x-text-input id="monthly_salary" class="block mt-1 w-full" type="number" name="monthly_salary" :value="old('monthly_salary')" required step="0.01" min="0" />
            <x-input-error :messages="$errors->get('monthly_salary')" class="mt-2" />
        </div>

        <!-- Salary Credit Date -->
        <div class="mt-4">
            <x-input-label for="salary_credit_date" :value="__('Salary Credit Date (Day of month)')" />
            <x-text-input id="salary_credit_date" class="block mt-1 w-full" type="number" name="salary_credit_date" :value="old('salary_credit_date')" required min="1" max="31" />
            <x-input-error :messages="$errors->get('salary_credit_date')" class="mt-2" />
        </div>

        <!-- Budget -->
        <div class="mt-4">
            <x-input-label for="budget" :value="__('Budget (DH)')" />
            <x-text-input id="budget" class="block mt-1 w-full" type="number" name="budget" :value="old('budget')" required step="0.01" min="0" />
            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
