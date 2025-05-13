<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\JasaBerkala;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class JasaBerkalaController extends Controller
{
    /**
     * Display a listing of periodic services.
     */
    public function index(): JsonResponse
    {
        try {
            $jasaBerkala = JasaBerkala::all();
            return response()->json([
                'success' => true,
                'data' => $jasaBerkala
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving periodic services: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created periodic service in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_jasa' => 'required|string|unique:jasa_berkalas,id_jasa',
                'tipe_mobil' => 'required|string|max:255',
                'jenis_service' => 'required|string|max:255',
                'biaya_jasa' => 'required|numeric|min:0'
            ]);

            // Create the periodic service
            $jasaBerkala = JasaBerkala::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Periodic Service created successfully',
                'data' => $jasaBerkala
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
                'message' => 'Error creating periodic service: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified periodic service.
     */
    public function show(string $id_jasa): JsonResponse
    {
        try {
            $jasaBerkala = JasaBerkala::findOrFail($id_jasa);
            return response()->json([
                'success' => true,
                'data' => $jasaBerkala
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Periodic Service not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified periodic service in storage.
     */
    public function update(Request $request, string $id_jasa): JsonResponse
    {
        try {
            // Find the periodic service
            $jasaBerkala = JasaBerkala::findOrFail($id_jasa);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'tipe_mobil' => 'sometimes|string|max:255',
                'jenis_service' => 'sometimes|string|max:255',
                'biaya_jasa' => 'sometimes|numeric|min:0'
            ]);

            // Update the periodic service
            $jasaBerkala->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Periodic Service updated successfully',
                'data' => $jasaBerkala
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
                'message' => 'Error updating periodic service: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified periodic service from storage.
     */
    public function destroy(string $id_jasa): JsonResponse
    {
        try {
            // Find the periodic service
            $jasaBerkala = JasaBerkala::findOrFail($id_jasa);

            // Delete the periodic service
            $jasaBerkala->delete();

            return response()->json([
                'success' => true,
                'message' => 'Periodic Service deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting periodic service: ' . $e->getMessage()
            ], 500);
        }
    }
}