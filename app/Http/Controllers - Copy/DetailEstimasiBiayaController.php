<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\DetailEstimasiBiaya;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DetailEstimasiBiayaController extends Controller
{
    /**
     * Display a listing of cost estimate details.
     */
    public function index(): JsonResponse
    {
        try {
            $detailEstimasiBiaya = DetailEstimasiBiaya::all();
            return response()->json([
                'success' => true,
                'data' => $detailEstimasiBiaya
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving cost estimate details: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created cost estimate detail in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_detail_estimasi' => 'required|string|unique:detail_estimasi_biayas,id_detail_estimasi',
                'id_estimasi' => 'required|string|exists:estimasi_biayas,id_estimasi',
                'nama' => 'required|string|max:255',
                'detail_type' => 'nullable|string|max:255',
                'harga_satuan' => 'required|numeric|min:0',
                'qty' => 'required|numeric|min:1',
                'discount' => 'nullable|numeric|min:0|max:100',
                'jumlah' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            // Create the cost estimate detail
            $detailEstimasiBiaya = DetailEstimasiBiaya::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate Detail created successfully',
                'data' => $detailEstimasiBiaya
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
                'message' => 'Error creating cost estimate detail: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified cost estimate detail.
     */
    public function show(string $id_detail_estimasi): JsonResponse
    {
        try {
            $detailEstimasiBiaya = DetailEstimasiBiaya::findOrFail($id_detail_estimasi);
            return response()->json([
                'success' => true,
                'data' => $detailEstimasiBiaya
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cost Estimate Detail not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified cost estimate detail in storage.
     */
    public function update(Request $request, string $id_detail_estimasi): JsonResponse
    {
        try {
            // Find the cost estimate detail
            $detailEstimasiBiaya = DetailEstimasiBiaya::findOrFail($id_detail_estimasi);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_estimasi' => 'sometimes|string|exists:estimasi_biayas,id_estimasi',
                'nama' => 'sometimes|string|max:255',
                'detail_type' => 'nullable|string|max:255',
                'harga_satuan' => 'sometimes|numeric|min:0',
                'qty' => 'sometimes|numeric|min:1',
                'discount' => 'nullable|numeric|min:0|max:100',
                'jumlah' => 'sometimes|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            // Update the cost estimate detail
            $detailEstimasiBiaya->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate Detail updated successfully',
                'data' => $detailEstimasiBiaya
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
                'message' => 'Error updating cost estimate detail: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified cost estimate detail from storage.
     */
    public function destroy(string $id_detail_estimasi): JsonResponse
    {
        try {
            // Find the cost estimate detail
            $detailEstimasiBiaya = DetailEstimasiBiaya::findOrFail($id_detail_estimasi);

            // Delete the cost estimate detail
            $detailEstimasiBiaya->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cost Estimate Detail deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting cost estimate detail: ' . $e->getMessage()
            ], 500);
        }
    }

}