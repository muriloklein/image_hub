<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('Entrou no método index do ImageController');

        $userId = auth()->id();
        Log::info('User ID:', ['id' => $userId]);    

        return Image::where('user_id', $userId)->latest()->get()->map(function($image) {
            return [
                'id' => $image->id,
                'url' => url(Storage::url($image->path)),
                'label' => $image->label,
                'user_id' => $image->user_id,
            ];
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'image' => ['required', 'image', 'max:2000', 'file', 'mimes:jpeg,png'],
            'label' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'path' => $path,
            'label' => $request->label,
            'user_id' => $userId,
        ]);

        return response($image, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $userId = auth()->id();

        if ($image->user_id !== $userId) {
            return response(null, 403);
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return response(null, 204);
    }
}
