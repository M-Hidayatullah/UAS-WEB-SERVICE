<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(5);

        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "List Data Berita"
            ],
            "data" => $news
        ], 200);

    }

    public function show($id)
    {

        $news = News::findOrFail($id);

        try {
            return response()->json([
                "response" => [
                    "status"    => 200,
                    "message"   => "Data Berita dengan id " . $id . " Ditemukan"
                ],
                "data" => $news
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "response" => [
                    "status"    => 404,
                    "message"   => "Data Berita dengan id " . $id . " tidak ditemukan"
                ],
                "data" => null
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'body'     => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $news = News::create($request->all());

        return response()->json([
            "response" => [
                "status"    => 201,
                "message"   => "Berita Berhasil Ditambahkan"
            ],
            "data" => $news
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->update([
            'title'     => $request->title,
            'body'   => $request->body,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "Berita Berhasil DI UPDATE"
            ],
            "data" => $news
        ], 200);
    }

    public function destroy($id)
    {
        News::findOrFail($id)->delete();

        return response()->json(['message' => 'Berita Berhasil Dihapus'], 200);
    }
}
