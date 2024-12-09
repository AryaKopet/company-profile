<h1>Test View File</h1>
<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Widget Material Stats -->
        @livewire(App\Filament\Widgets\MaterialStats::class)

        <!-- Widget Admin Stats -->
        @livewire(App\Filament\Widgets\AdminStats::class)

        <!-- Widget Pelanggan -->
        @livewire(App\Filament\Widgets\PelangganWidget::class)
    </div>
</x-filament::page>
