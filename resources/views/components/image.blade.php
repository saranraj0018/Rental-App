@props(['src' => '', 'alt'])

<div x-data="{
    open: false,
    src: '{{ $src }}',
}">
    <img @click="open = true" :src="src" alt="{{ $alt }}" {{ $attributes->merge([]) }} />

    <x-image-viewer />
</div>
