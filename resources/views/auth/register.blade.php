<x-guest-layout>
  <script>
    // alert('You shall wait for the branch manager to activate your account after registration.');
  </script>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <x-application-logo width="82" />
      </a>
    </x-slot>

    <div class="card-body">
      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="alert alert-success mb-4" role="alert">
          <div class="text-success">You will first be approved by your manager before logging in the first time.</div>
        </div>
        <!-- Name -->
        <div class="mb-3">
          <x-label for="name" :value="__('Name')" />

          <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <!-- Phone -->
        <div class="mb-3">
          <x-label for="phone" :value="__('Phone')" />

          <x-input id="phone" type="text" name="phone" :value="old('phone')" required autofocus />
        </div>


        <!-- Email Address -->
        <div class="mb-3">
          <x-label for="email" :value="__('Email')" />

          <x-input id="email" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <x-label for="password" :value="__('Password')" />

          <x-input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <x-label for="password_confirmation" :value="__('Confirm Password')" />

          <x-input id="password_confirmation" type="password" name="password_confirmation" required />
        </div>

        <!-- Branch -->
        <div class="mb-3">
          <x-label for="branch" :value="__('Branch')" />

          <x-select id="branch" name="branch" required>
            @foreach ($branches as $branch)
              <option value="{{$branch->id}}">{{$branch->name}}</option>
            @endforeach
          </x-select>
        </div>
        <script>
          document.getElementById('branch').value = "";
        </script>

        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <a class="text-muted me-3 text-decoration-underline" href="{{ route('login') }}">
              {{ __('Already registered?') }}
            </a>

            <x-button>
              {{ __('Register') }}
            </x-button>
          </div>
        </div>
      </form>
    </div>
  </x-auth-card>
</x-guest-layout>
