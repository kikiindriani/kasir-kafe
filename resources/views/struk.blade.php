<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-gray-100">

<div class="max-w-xs mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
        <div class="text-center mb-6">
            <div class="flex justify-center items-center">
                <div class="w-24 h-[49px] relative mb-[19px]">
                    <div class="left-[23px] top-0  text-[#379012] text-[24px] font-bold font-['Kirome'] leading-[28px]">Cafe</div>
                    <div class="left-[23px] top-[22px] absolute text-[#379012] text-[24px] font-bold font-['Kirome'] leading-[28px]">Kasir</div>
                    <div class="w-[20px] h-[28px] left-0 top-[4px] absolute">
                        <div class="w-[11px] h-[40px] left-[8px] top-0 absolute bg-[#389012]"></div>
                        <div class="w-[2px] h-[40px] left-[4px] top-0 absolute bg-[#389012]"></div>
                        <div class="w-[2px] h-[40px] left-0 top-0 absolute bg-[#389012]"></div>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-600">Jl. Perusahaan No.20, Tanjungtirto</p>
                <p class="text-sm text-gray-600">Telp: (0341) 4345127</p>
                <p class="text-sm text-gray-600">Singosari - Malang</p>
            </div>
        </div>


        <div class="border-t-2 py-4">
            <p class="text-sm text-gray-800">Nama Pembeli: <strong>{{ $name }}</strong></p>
            <p class="text-sm text-gray-800">Metode Pembayaran: <strong>{{ $statusPembayaran === 'Cash' ? 'Tunai' : 'Non Tunai'  }}</strong></p>
        </div>

        <div class="border-t-2 border-b-2 py-4">
            <ul>
                @foreach ($menuItems as $item)
                    <li class="flex justify-between mb-2">
                        <span class="text-sm text-gray-800">{{ $item['nama_menu'] }} (x{{ $item['quantity'] }})</span>
                        <span class="text-sm text-gray-600">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col py-2 border-t-2 mt-4">
            <div class="flex justify-between">
                <span class="font-semibold text-gray-800">Total</span>
                <span class="font-semibold text-gray-800">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-regular text-sm text-gray-800">Bayar</span>
                <span class="font-regular text-sm text-gray-800">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-regular text-sm text-gray-800">Kembalian</span>
                <span class="font-regular text-sm text-gray-800">Rp {{ number_format($totalKembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Terima kasih telah berkunjung!</p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('order.index') }}" class="text-sm text-blue-500 hover:underline">Kembali ke Order</a>
    </div>

</body>
</html>
