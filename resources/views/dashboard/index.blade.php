@extends('shared.general.layouts')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center text-maroon font-weight-bold">Dashboard Data Estimasi Biaya</h1>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row mb-4">
            <!-- Weekly Estimation Card -->
            <div class="col-md-4">
                <div class="card bg-light-pink">
                    <div class="card-body text-center">
                        <h1 class="display-4">{{ $weeklyCount }}</h1>
                        <p>Estimasi Minggu Ini</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Estimation Card -->
            <div class="col-md-4">
                <div class="card bg-medium-pink">
                    <div class="card-body text-center">
                        <h1 class="display-4">{{ $monthlyCount }}</h1>
                        <p>Estimasi Bulan Ini</p>
                    </div>
                </div>
            </div>

            <!-- Yearly Estimation Card -->
            <div class="col-md-4">
                <div class="card bg-dark-pink">
                    <div class="card-body text-center">
                        <h1 class="display-4">{{ $yearlyCount }}</h1>
                        <p>Estimasi Tahun Ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <!-- Service/Part/Material Usage Chart -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Tren Penggunaan Jasa/Part/Material
                    </div>
                    <div class="card-body">
                        <canvas id="usageChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Type Contribution Chart -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Kontribusi Komponen Estimasi
                    </div>
                    <div class="card-body">
                        <canvas id="typeContributionChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Estimations Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light-pink">
                        <div class="row">
                            <div class="col-md-3">ID Estimasi</div>
                            <div class="col-md-3">Nama Customer</div>
                            <div class="col-md-2">Tipe Mobil</div>
                            <div class="col-md-2">Tanggal</div>
                            <div class="col-md-2">Total Biaya</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    @foreach($recentEstimations as $estimation)
                                        <tr class="bg-{{ $loop->iteration % 2 == 0 ? 'light-pink' : 'medium-pink' }}">
                                            <td class="col-md-3">{{ $estimation->id_estimasi }}</td>
                                            <td class="col-md-3">{{ $estimation->nama }}</td>
                                            <td class="col-md-2">{{ $estimation->tipe_mobil }}</td>
                                            @php \Carbon\Carbon::setLocale('id'); @endphp
                                            <td class="col-md-2">
                                                {{ \Carbon\Carbon::parse($estimation->tanggal_transaksi)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="col-md-2">Rp{{ number_format($estimation->total_biaya, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-10 text-left">Total Estimasi</div>
                            <div class="col-md-2 text-right">{{ $totalEstimations }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Type Contribution Chart - Doughnut
            const typeCtx = document.getElementById('typeContributionChart').getContext('2d');
            const typeChart = new Chart(typeCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($componentLabels) !!},
                    datasets: [{
                        data: {!! json_encode($componentValues) !!},
                        backgroundColor: [
                            'rgba(151, 30, 30, 0.8)',
                            'rgba(203, 113, 113, 0.8)',
                            'rgba(220, 152, 152, 0.8)',
                            'rgba(236, 189, 189, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.formattedValue;
                                    const percentage = (context.raw / context.dataset.data.reduce((a, b) => a + b, 0) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Usage Chart - Horizontal Bar
            const usageCtx = document.getElementById('usageChart').getContext('2d');
            const usageChart = new Chart(usageCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($usageLabels) !!},
                    datasets: [{
                        label: 'Frekuensi Penggunaan',
                        data: {!! json_encode($usageCounts) !!},
                        backgroundColor: [
                            'rgba(151, 30, 30, 0.8)',
                            'rgba(167, 48, 48, 0.8)',
                            'rgba(184, 71, 71, 0.8)',
                            'rgba(203, 113, 113, 0.8)',
                            'rgba(220, 152, 152, 0.8)',
                            'rgba(228, 171, 171, 0.8)',
                            'rgba(236, 189, 189, 0.8)',
                            'rgba(245, 209, 209, 0.8)',
                            'rgba(251, 223, 223, 0.8)',
                            'rgba(254, 236, 236, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .bg-light-pink {
            background-color: #f8c4c4;
        }

        .bg-medium-pink {
            background-color: #e77c7c;
        }

        .bg-dark-pink {
            background-color: #d14141;
        }

        .text-maroon {
            color: #7a1a1a;
        }

        .card {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .display-4 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .table td,
        .table th {
            padding: 12px 15px;
        }
    </style>
@endpush