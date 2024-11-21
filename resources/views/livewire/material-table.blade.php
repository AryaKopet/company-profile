<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $material->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $material->barang }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $material->harga }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $material->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $materials->links() }} <!-- Pagination -->
</div>
