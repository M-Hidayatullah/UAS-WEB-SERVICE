<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->paginate(5);

        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "List Data Category"
            ],
            "data" => $category
        ], 200);

    }

    public function show($id)
    {

        $category = Category::findOrFail($id);

        try {
            return response()->json([
                "response" => [
                    "status"    => 200,
                    "message"   => "Data Category dengan id " . $id . " Ditemukan"
                ],
                "data" => $category
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "response" => [
                    "status"    => 404,
                    "message"   => "Data Category dengan id " . $id . " tidak ditemukan"
                ],
                "data" => null
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create($request->all());

        return response()->json([
            "response" => [
                "status"    => 201,
                "message"   => "Category Berhasil Ditambahkan"
            ],
            "data" => $category
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'nama'     => $request->nama,
        ]);

        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "Category Berhasil DiUPDATE"
            ],
            "data" => $category
        ], 200);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return response()->json(['message' => 'Catgory Berhasil Dihapus'], 200);
    }
}
