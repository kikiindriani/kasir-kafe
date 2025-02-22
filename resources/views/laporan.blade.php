@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold">Laporan Penjualan</h1>
    <div class="flex">
        <p class="mt-2 text-xl italic font-bold">Halo, </p>
        <p class="mt-2 text-xl">{{ session('user.level') }}!</p>
    </div>

    <div class="mt-14">
        <div id="reportCard" class="px-6 py-[25px] bg-white rounded-[10px] shadow-md border-2 border-[#389012] flex flex-col justify-between">
            <div class="flex justify-between  px-6">
                <div class="h-11 flex-col justify-center items-start gap-2.5 inline-flex overflow-hidden">
                    <div class="text-black text-xl font-semibold font-['Poppins'] leading-normal">Laporan Penjualan</div>
                </div>

                <form action="{{ route('report.report') }}" method="GET">
                    <div class="flex border border-[#389012] rounded-lg bg-[#389012]">
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="date-filter" name="date_filter" type="text" class="bg-[#389012] rounded-lg text-white text-sm focus:ring-[#389012] focus:border-[#389012] block w-full ps-10 p-2.5" value={{old('data_filter', $dateFilter)}}>

                        </div>
                        <button type="submit" class="px-2 bg-[#255112] text-white rounded-e-lg">Kirim</button>
                    </div>
                </form>

            </div>

            <div class="flex gap-3 h-[400px]">
                <div class="grow bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <div id="line-chart">
                        <canvas id="salesChart" class="w-[500px] h-[400px]"></canvas>
                    </div>
                </div>

                <div class="grow w-full flex flex-col gap-10 rounded-lg shadow-sm p-4 md:p-6">
                <div class="grow h-[150px] flex flex-col justify-center items-center relative bg-[#79FE76] rounded-[10px] border-2 border-[#389012] overflow-hidden">
                    <div class="text-black text-[40px] font-semibold font-['Poppins'] leading-[47.60px]">
                        {{ isset($totalOrders[0]) ? $totalOrders[0] : 0 }}
                    </div>
                    <div class="text-black text-xl font-semibold font-['Poppins'] leading-normal mt-[5px]">
                        Penjualan
                    </div>
                </div>

                    <div class="w-full grow h-28 flex-col justify-start items-start gap-5 inline-flex">
                        <div class="self-stretch justify-between items-center inline-flex">
                            <div class="text-black text-xl font-regular font-['Poppins'] leading-normal">Total Tunai bulan ini</div>
                            <div class="text-black text-lg font-light font-['Poppins'] leading-snug">Rp {{ isset($salesByCash[0]['total_sales']) ? number_format($salesByCash[0]['total_sales'], 0, '.', '.') : 0 }}</div>
                        </div>
                        <div class="self-stretch justify-between items-center inline-flex">
                            <div class="text-black text-xl font-regular font-['Poppins'] leading-normal">Total Non Tunai bulan ini</div>
                            <div class="text-black text-lg font-light font-['Poppins'] leading-snug">Rp {{ isset($salesByCashless[0]['total_sales']) ? number_format($salesByCashless[0]['total_sales'], 0, '.', '.') : 0 }}</div>
                        </div>
                        <div class="self-stretch justify-between items-center inline-flex">
                            <div class="text-black text-xl font-semibold font-['Poppins'] leading-normal">Pendapatan</div>
                            <div class="text-black text-lg font-light font-['Poppins'] leading-snug">Rp {{ isset($totalSales[0]) ? number_format($totalSales[0], 0, '.', '.') : 0 }}</div>
                        </div>
                    </div>

                    <div>
                        <a  href="{{ route('report.detail',['date_filter'=>\Carbon\Carbon::parse($dateFilter)->format('Y-m')]) }}" class="w-full px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-sm flex items-center justify-between">
                            Laporan
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("date-filter");

        flatpickr(dateInput, {
            enableTime: false,
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F Y",
            onOpen: function(selectedDates, dateStr, instance) {
                instance.set("minDate", null);
                instance.set("maxDate", null);
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (dateStr.includes("-W")) {
                    instance.set("dateFormat", "Y-W");
                    instance.set("altFormat", "W, Y");
                } else {
                    instance.set("dateFormat", "Y-m");
                    instance.set("altFormat", "F Y");
                }
            }
        });

        dateInput.addEventListener("focus", function () {
            const mode = prompt("Select mode: Type 'week' for weekly or 'month' for monthly");

            if (mode.toLowerCase() === "week") {
                flatpickr(dateInput, {
                    weekNumbers: true,
                    dateFormat: "Y-W",
                    altInput: true,
                    altFormat: "Week W, Y",
                    onChange: function(selectedDates, dateStr, instance) {
                        console.log("Selected Week:", dateStr);
                    }
                }).open();
            } else if (mode.toLowerCase() === "month") {
                flatpickr(dateInput, {
                    dateFormat: "Y-m",
                    altInput: true,
                    altFormat: "F Y",
                    plugins: [new monthSelectPlugin({ shorthand: true, dateFormat: "Y-m", altFormat: "F Y" })],
                    onChange: function(selectedDates, dateStr, instance) {
                        console.log("Selected Month:", dateStr);
                    }
                }).open();
            }
        });
    });

        var ctx = document.getElementById('salesChart').getContext('2d');

        const periods = <?php echo json_encode($periods); ?>;
        const totalSales = <?php echo json_encode($totalSales); ?>;
        const totalOrders = <?php echo json_encode($totalOrders); ?>;

        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: periods,
                datasets: [
                    {
                        label: 'Total Penjualan',
                        data: totalSales,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Pesanan',
                        data: totalOrders,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
