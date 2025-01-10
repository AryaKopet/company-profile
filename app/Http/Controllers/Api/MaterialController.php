<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all materials with pagination
        $materials = Material::orderBy('id_material', 'asc')->paginate();

        // Return the data using the modified MaterialResource
        return new MaterialResource(true, 'List Data Materials', $materials);
    }
}
