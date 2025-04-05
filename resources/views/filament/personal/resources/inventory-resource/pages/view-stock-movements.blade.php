<x-filament-panels::page>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Movimientos de: {{ $product->name }}</h2>
    </x-slot>

    {{ $this->table }}
</x-filament-panels::page>
