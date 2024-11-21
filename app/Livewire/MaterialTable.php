<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Material;
use Livewire\WithPagination;

class MaterialTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.material-table', [
            'materials' => Material::paginate(10), // Tampilkan 10 data per halaman
        ]);
    }
}
