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
    public function show($id)
    {
        //find post by ID
        $post = Material::find($id);

        //return single post as a resource
        return new MaterialResource(true, 'Detail Data Materials', $post);
    }
}
