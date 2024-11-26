<div class="bg-white shadow rounded-lg p-4 flex items-center">
    <!-- Ikon ditampilkan di sebelah kiri -->
    <div class="text-primary-500 mr-4">
        <x-heroicon-o-cube class="h-10 w-10" />
    </div>
    
    <div>
        <h2 class="text-lg font-semibold">Statistik Material</h2>
        <div class="mt-4">
            <p>Total Material: <strong>{{ $this->getMaterialCount() }}</strong></p>
        </div>
    </div>
</div>
