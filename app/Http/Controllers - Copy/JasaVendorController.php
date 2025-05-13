<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\JasaVendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class JasaVendorController extends Controller
{
    /**
     * Display a listing of jasa vendors.
     */
    public function index(): JsonResponse
    {
        try {
            $jasaVendors = JasaVendor::all();
            return response()->json([
                'success' => true,
                'data' => $jasaVendors
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving jasa vendors: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created jasa vendor in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id_jasa' => 'required|string|unique:jasa_vendors,id_jasa',
                'jasa' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0'
            ]);

            // Create the jasa vendor
            $jasaVendor = JasaVendor::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Jasa Vendor created successfully',
                'data' => $jasaVendor
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
                'message' => 'Error creating jasa vendor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified jasa vendor.
     */
    public function show(string $id_jasa): JsonResponse
    {
        try {
            $jasaVendor = JasaVendor::findOrFail($id_jasa);
            return response()->json([
                'success' => true,
                'data' => $jasaVendor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Jasa Vendor not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified jasa vendor in storage.
     */
    public function update(Request $request, string $id_jasa): JsonResponse
    {
        try {
            // Find the jasa vendor
            $jasaVendor = JasaVendor::findOrFail($id_jasa);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'jasa' => 'sometimes|string|max:255',
                'harga' => 'sometimes|numeric|min:0'
            ]);

            // Update the jasa vendor
            $jasaVendor->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Jasa Vendor updated successfully',
                'data' => $jasaVendor
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
                'message' => 'Error updating jasa vendor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified jasa vendor from storage.
     */
    public function destroy(string $id_jasa): JsonResponse
    {
        try {
            // Find the jasa vendor
            $jasaVendor = JasaVendor::findOrFail($id_jasa);

            // Delete the jasa vendor
            $jasaVendor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jasa Vendor deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting jasa vendor: ' . $e->getMessage()
            ], 500);
        }
    }
}