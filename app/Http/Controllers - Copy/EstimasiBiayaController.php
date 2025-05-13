<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\EstimasiBiaya;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EstimasiBiayaController extends Controller
{
    /**
     * Display a listing of cost estimates.
     */
    public function index(): JsonResponse
    {
        try {
            $estimasiBiaya = EstimasiBiaya::all();
            return response()->json([
                'success' => true,
                'data' => $estimasiBiaya
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving cost estimates: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created cost estimate in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_estimasi' => 'required|string|unique:estimasi_biayas,id_estimasi',
                'nama' => 'required|string|max:255',
                'no_polis' => 'nullable|string|max:255',
                'tipe_mobil' => 'nullable|string|max:255',
                'km_aktual' => 'nullable|numeric|min:0',
                'tanggal_transaksi' => 'nullable|date',
                'total_jasa' => 'nullable|numeric|min:0',
                'total_barang' => 'nullable|numeric|min:0',
                'total_biaya' => 'nullable|numeric|min:0',
                'id_user' => 'nullable|string|exists:users,id_user'
            ]);

            // Create the cost estimate
            $estimasiBiaya = EstimasiBiaya::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate created successfully',
                'data' => $estimasiBiaya
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
                'message' => 'Error creating cost estimate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified cost estimate.
     */
    public function show(string $id_estimasi): JsonResponse
    {
        try {
            $estimasiBiaya = EstimasiBiaya::findOrFail($id_estimasi);
            return response()->json([
                'success' => true,
                'data' => $estimasiBiaya
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cost Estimate not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified cost estimate in storage.
     */
    public function update(Request $request, string $id_estimasi): JsonResponse
    {
        try {
            // Find the cost estimate
            $estimasiBiaya = EstimasiBiaya::findOrFail($id_estimasi);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'nama' => 'sometimes|string|max:255',
                'no_polis' => 'nullable|string|max:255',
                'tipe_mobil' => 'nullable|string|max:255',
                'km_aktual' => 'nullable|numeric|min:0',
                'tanggal_transaksi' => 'nullable|date',
                'total_jasa' => 'nullable|numeric|min:0',
                'total_barang' => 'nullable|numeric|min:0',
                'total_biaya' => 'nullable|numeric|min:0',
                'id_user' => 'nullable|string|exists:users,id_user'
            ]);

            // Update the cost estimate
            $estimasiBiaya->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate updated successfully',
                'data' => $estimasiBiaya
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
                'message' => 'Error updating cost estimate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified cost estimate from storage.
     */
    public function destroy(string $id_estimasi): JsonResponse
    {
        try {
            // Find the cost estimate
            $estimasiBiaya = EstimasiBiaya::findOrFail($id_estimasi);

            // Delete the cost estimate
            $estimasiBiaya->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting cost estimate: ' . $e->getMessage()
            ], 500);
        }
    }
}