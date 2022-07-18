<x-guest-layout>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <x-application-logo width="82" />
      </a>
    </x-slot>

    <div class="card-body">
      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form method="POST" action="{{ route('branch.store') }}">
        @csrf
        <h3>Register branch (Please dont forget name and key)</h3>
        <!-- Name -->
        <div class="mb-3">
          <x-label for="name" :value="__('Name')" />

          <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <!-- LOcation -->
        <div class="mb-3">
          <x-label for="location" :value="__('Location')" />

          <x-input id="location" type="text" name="location" :value="old('location')" required autofocus />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <x-label for="password" :value="__('Key (Branch password)')" />

          <x-input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <x-label for="password_confirmation" :value="__('Confirm Key')" />

          <x-input id="password_confirmation" type="password" name="password_confirmation" required />
        </div>

        <div class="d-flex items-center justify-content-end mt-4">
          <x-button class="ml-4">
            {{ __('Register Branch') }}
          </x-button>
        </div>
      </form>
      <div class="d-flex items-center justify-content-end mt-4 bold">
        For users of registered branch only
      </div>
      <div class="d-flex items-center justify-content-end mt-4">
        @if (Route::has('login'))
          <div>
            @auth
              <a href="{{ url('/main') }}"><x-button class="ml-4">Dashboard</x-button></a>
            @else
              <a href="{{ route('login') }}" class="me-3"><button type="button" class="btn btn-dark ml-4">Log in</button></a>

              @if (Route::has('register'))
                <a href="{{ route('register') }}"><x-button class="ml-4">Register</x-button></a>
              @endif
            @endauth
          </div>
        @endif
      </div>
    </div>
  </x-auth-card>
</x-guest-layout>
