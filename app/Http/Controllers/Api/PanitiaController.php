<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PanitiaRequest;
use App\Models\Panitia;
use App\Http\Resources\PanitiaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PanitiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $panitias = Panitia::all();
        return response()->json(new PanitiaResource(true, 'List of Panitia', $panitias), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PanitiaRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $this->storeImage($request->file('foto'));
        }

        $panitia = Panitia::create($data);

        return response()->json(new PanitiaResource(true, 'Panitia created successfully', $panitia), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $panitia = Panitia::find($id);

        if ($panitia) {
            return response()->json(new PanitiaResource(true, 'Panitia details', $panitia), 200);
        }

        return response()->json(new PanitiaResource(false, 'Data tidak ditemukan', null), 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PanitiaRequest $request, string $id): JsonResponse
    {
        $panitia = Panitia::find($id);

        if (!$panitia) {
            return response()->json(new PanitiaResource(false, 'Data tidak ditemukan', null), 404);
        }

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $this->deleteImage($panitia->foto);
            $data['foto'] = $this->storeImage($request->file('foto'));
        }

        $panitia->update($data);

        return response()->json(new PanitiaResource(true, 'Panitia updated successfully', $panitia), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $panitia = Panitia::find($id);

        if (!$panitia) {
            return response()->json(new PanitiaResource(false, 'Data tidak ditemukan', null), 404);
        }

        $this->deleteImage($panitia->foto);
        $panitia->delete();

        return response()->json(new PanitiaResource(true, 'Panitia deleted successfully', null), 200);
    }

    /**
     * Store the image and return the path URL.
     */
    protected function storeImage($image): string
    {
        return Storage::url($image->store('public/foto_panitia'));
    }

    /**
     * Delete the specified image if it exists.
     */
    protected function deleteImage(?string $imagePath): void
    {
        if ($imagePath) {
            Storage::delete('public/foto_panitia/' . basename($imagePath));
        }
    }
}
