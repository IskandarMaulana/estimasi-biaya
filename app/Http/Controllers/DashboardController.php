<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimasiBiaya;
use App\Models\DetailEstimasiBiaya;
use App\Models\Part;
use App\Models\Material;
use App\Models\JasaBerkala;
use App\Models\JasaVendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current date info
        $now = Carbon::now();
        $startOfWeek = $now->copy()->startOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfYear = $now->copy()->startOfYear();

        // 1. Get statistics for estimations
        $weeklyCount = EstimasiBiaya::where('created_at', '>=', $startOfWeek)->count();
        $monthlyCount = EstimasiBiaya::where('created_at', '>=', $startOfMonth)->count();
        $yearlyCount = EstimasiBiaya::where('created_at', '>=', $startOfYear)->count();
        $totalEstimations = EstimasiBiaya::count();

        // 2. Get component contribution percentages
        $detailStats = DB::table('detail_estimasi_biayas')
            ->select('detail_type', DB::raw('SUM(jumlah) as total_amount'))
            ->groupBy('detail_type')
            ->get();

        $componentLabels = [];
        $componentValues = [];

        foreach ($detailStats as $stat) {
            switch ($stat->detail_type) {
                case 'part':
                    $componentLabels[] = 'Part';
                    break;
                case 'material':
                    $componentLabels[] = 'Material';
                    break;
                case 'jasa_berkala':
                    $componentLabels[] = 'Jasa Berkala';
                    break;
                case 'jasa_vendor':
                    $componentLabels[] = 'Jasa Vendor';
                    break;
            }
            $componentValues[] = $stat->total_amount;
        }

        // 4. Get usage trends for services/parts/materials
        $usageStats = DB::table('detail_estimasi_biayas')
            ->select('nama', 'detail_type', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('nama', 'detail_type')
            ->orderBy('usage_count', 'desc')
            ->limit(10)
            ->get();

        $usageLabels = [];
        $usageCounts = [];

        foreach ($usageStats as $stat) {
            $prefix = '';
            switch ($stat->detail_type) {
                case 'part':
                    $prefix = 'Part: ';
                    break;
                case 'material':
                    $prefix = 'Material: ';
                    break;
                case 'jasa_berkala':
                    $prefix = 'Jasa: ';
                    break;
                case 'jasa_vendor':
                    $prefix = 'Jasa Vendor: ';
                    break;
            }
            $usageLabels[] = $prefix . $stat->nama;
            $usageCounts[] = $stat->usage_count;
        }

        // 5. Get recent estimations for the logged-in user
        $recentEstimations = EstimasiBiaya::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'weeklyCount',
            'monthlyCount',
            'yearlyCount',
            'totalEstimations',
            'componentLabels',
            'componentValues',
            'usageLabels',
            'usageCounts',
            'recentEstimations'
        ));
    }
}
