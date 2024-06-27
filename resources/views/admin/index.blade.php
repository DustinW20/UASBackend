@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Menu</p>
                        <h4 class="mb-0">{{ $menus }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Menu Terjual Hari ini</p>
                        <h4 class="mb-0">{{ $totalSoldToday }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
            </div>
        </div>
    </div>

    <div class="my-3">
        <div class="card">
            <div class="card-header">
                Monthly Revenue Chart
            </div>
            <div class="card-body">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const monthlyRevenue = {!! json_encode($monthlyRevenue) !!};

            const months = [];
            const revenues = [];

            // Extract months and revenues
            for (const [month, revenue] of Object.entries(monthlyRevenue)) {
                months.push(month);
                revenues.push(revenue);
            }

            // Chart.js configuration
            const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
