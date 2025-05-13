<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class MaterialController extends Controller
{
    /**
     * Display a listing of materials.
     */
    public function index(): JsonResponse
    {
        try {
            $materials = Material::all();
            return response()->json([
                'success' => true,
                'data' => $materials
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving materials: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created material in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'no_material' => 'required|string|unique:materials,no_material',
                'nama_material' => 'required|string|max:255',
                'jenis_material' => 'nullable|string|max:255',
                'harga_satuan' => 'required|numeric|min:0'
            ]);

            // Create the material
            $material = Material::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Material created successfully',
                'data' => $material
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating material: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified material.
     */
    public function show(string $no_material): JsonResponse
    {
        try {
            $material = Material::findOrFail($no_material);
            return response()->json([
                'success' => true,
                'data' => $material
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Material not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified material in storage.
     */
    public function update(Request $request, string $no_material): JsonResponse
    {
        try {
            // Find the material
            $material = Material::findOrFail($no_material);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'nama_material' => 'sometimes|string|max:255',
                'jenis_material' => 'nullable|string|max:255',
                'harga_satuan' => 'sometimes|numeric|min:0'
            ]);

            // Update the material
            $material->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Material updated successfully',
                'data' => $material
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating material: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified material from storage.
     */
    public function destroy(string $no_material): JsonResponse
    {
        try {
            // Find the material
            $material = Material::findOrFail($no_material);

            // Delete the material
            $material->delete();

            return response()->json([
                'success' => true,
                'message' => 'Material deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting material: ' . $e->getMessage()
            ], 500);
        }
    }
}