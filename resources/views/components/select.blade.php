@props(['disabled' => false])

<select style="cursor: pointer" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-select']) !!}>
    {{ $slot }}
</select>
