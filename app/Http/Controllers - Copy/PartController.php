<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Part;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PartController extends Controller
{
    /**
     * Display a listing of parts.
     */
    public function index(): JsonResponse
    {
        try {
            $parts = Part::all();
            return response()->json([
                'success' => true,
                'data' => $parts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving parts: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created part in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_part' => 'required|string|unique:parts,id_part',
                'nama_part' => 'required|string|max:255',
                'tipe_mobil' => 'nullable|string|max:255',
                'no_part' => 'nullable|string|max:255',
                'no_part_eff' => 'nullable|string|max:255',
                'no_part_carb' => 'nullable|string|max:255',
                'harga_part_eff' => 'nullable|numeric|min:0',
                'harga_part_carb' => 'nullable|numeric|min:0',
                'stock_plan' => 'nullable|integer|min:0',
                'stock_actual' => 'nullable|integer|min:0',
                'selisih' => 'nullable|integer'
            ]);

            // Create the part
            $part = Part::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Part created successfully',
                'data' => $part
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
                'message' => 'Error creating part: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified part.
     */
    public function show(string $id_part): JsonResponse
    {
        try {
            $part = Part::findOrFail($id_part);
            return response()->json([
                'success' => true,
                'data' => $part
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Part not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified part in storage.
     */
    public function update(Request $request, string $id_part): JsonResponse
    {
        try {
            // Find the part
            $part = Part::findOrFail($id_part);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'nama_part' => 'sometimes|string|max:255',
                'tipe_mobil' => 'nullable|string|max:255',
                'no_part' => 'nullable|string|max:255',
                'no_part_eff' => 'nullable|string|max:255',
                'no_part_carb' => 'nullable|string|max:255',
                'harga_part_eff' => 'nullable|numeric|min:0',
                'harga_part_carb' => 'nullable|numeric|min:0',
                'stock_plan' => 'nullable|integer|min:0',
                'stock_actual' => 'nullable|integer|min:0',
                'selisih' => 'nullable|integer'
            ]);

            // Update the part
            $part->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Part updated successfully',
                'data' => $part
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
                'message' => 'Error updating part: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified part from storage.
     */
    public function destroy(string $id_part): JsonResponse
    {
        try {
            // Find the part
            $part = Part::findOrFail($id_part);

            // Delete the part
            $part->delete();

            return response()->json([
                'success' => true,
                'message' => 'Part deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting part: ' . $e->getMessage()
            ], 500);
        }
    }
}