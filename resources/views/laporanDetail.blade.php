@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold">Detail Laporan</h1>
    <div class="flex">
        <p class="mt-2 text-xl italic font-bold">Halo, </p>
        <p class="mt-2 text-xl">{{ session('user.level') }}!</p>
    </div>

    <div class="mt-14">
        <div id="reportCard" class="px-6 py-[25px] bg-white rounded-[10px] shadow-md border-2 border-[#389012] flex flex-col justify-between">
            <div class="flex justify-center px-6">
                <div class="h-11 flex-col justify-center items-center gap-2.5 inline-flex overflow-hidden">
                    <div class="text-black text-xl font-semibold font-['Poppins'] leading-normal">Laporan Penjualan</div>
                </div>
            </div>

            <h3 class="font-bold text-lg capitalize font-['Poppins']">
                Pemasukan Harian
            </h3>

            <table class="w-full border-collapse border border-gray-300 rounded-sm mt-3">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Pemasukan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesPerDay as $value)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2 text-left">{{\Carbon\Carbon::parse($value->date)->format('d-m-Y')}}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">Rp. {{number_format($value->total_sales, 0, '.', '.')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="font-bold text-lg capitalize font-['Poppins'] mt-6">
                Perbandingan Pembayaran Tunai & Non Tunai
            </h3>

            <table class="w-full border-collapse border border-gray-300 rounded-sm mt-3">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">Jenis Pembayaran</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Total Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2 text-left w-1/2">Tunai</td>
                        <td class="border border-gray-300 px-4 py-2 text-left w-1/2">Rp. {{isset($salesForCash[0]) ? number_format($salesForCash[0]->total_sales, 0, '.', '.') : 0}}</td>
                    </tr>
                    @foreach ($salesPerDay as $value)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2 text-left">Non Tunai</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">Rp. {{isset($salesForCashless[0]) ? number_format($salesForCashless[0]->total_sales, 0, '.', '.') : 0}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="font-bold text-lg capitalize font-['Poppins'] mt-6">
                Menu paling sering dipesan oleh pelanggan
            </h3>

            <table class="w-full border-collapse border border-gray-300 rounded-sm mt-3">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Nama Menu</th>
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Total Dipesan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPesanan as $value)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2 text-left">{{$value->nama_menu}}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">{{$value->total_dipesan}} kali dipesan</td>
                    </tr>
                    @endforeach
                    {{-- @foreach ($data as $row)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $row->column_one }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $row->column_two }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>

            <h3 class="font-bold text-lg capitalize font-['Poppins'] mt-6">
                Jumlah transaksi yang diproses oleh pegawai
            </h3>

            <table class="w-full border-collapse border border-gray-300 rounded-sm mt-3">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Nama Pegawai</th>
                        <th class="border border-gray-300 px-4 py-2 text-left w-1/2">Total Transaksi Yang Diproses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPegawai as $value)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2 text-left">{{$value->nama_pegawai}}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">{{$value->total_transaksi}} transaksi</td>
                    </tr>
                    @endforeach
                    {{-- @foreach ($data as $row)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $row->column_one }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $row->column_two }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>

            <div class="flex justify-end">
                <h3 class="font-bold text-md capitalize font-['Poppins'] mt-4">
                Total Keseluruhan Pemasukan: Rp. {{(!empty($salesForCashless) && !empty($salesForCashless))? number_format($salesForCashless[0] ->total_sales + + $salesForCash[0]->total_sales, 0, '.', '.') : 0}}
                </h3>
            </div>
            <div class="flex justify-end">
                <h3 id="tanggal" class="font-semibold text-sm capitalize font-['Poppins'] mt-4"></h3>
            </div>

            <div class="mt-6">
                <button onclick="window.print()" class="w-full px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-sm flex items-center justify-between">
                    Cetak Laporan
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function updateTanggal() {
        const options = { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' };
        const tanggalSekarang = new Date().toLocaleDateString('id-ID', options);
        document.getElementById('tanggal').textContent = "Dibuat Pada " + tanggalSekarang;
    }

    updateTanggal();
    setInterval(updateTanggal, 60000);
    </script>


@endsection
