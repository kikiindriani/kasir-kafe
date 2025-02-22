<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Dashboard</title>
</head>
<body>
    @if(session('error'))
    <div id="toast-simple" class="fixed flex items-center max-w-xs p-4 space-x-4 opacity-5 ease-in-out bg-[#ffdddd] border border-[#d02222] rounded-lg shadow-sm top-5 right-5" role="alert">
            <svg class="w-5 h-5 text-[#d02222] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
            </svg>
        <div class="text-[#d02222] text-xs font-semibold">{{ session('error') }}</div>
    </div>
    @endif

    @if(session('success'))
    <div id="toast-simple" class="fixed flex items-center max-w-xs p-4 space-x-4 bg-[#ddffdd] border border-[#22d022] rounded-lg shadow-sm top-5 right-5" role="alert">
            <svg class="w-5 h-5 text-[#22d022] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
            </svg>
        <div class="text-[#22d022] text-xs font-semibold">{{ session('success') }}</div>
    </div>
    @endif

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-[310px] bg-[#F0FEDF] text-white h-screen p-5">
        <div class="logo">
            <div class="w-52 h-[109px] relative mb-[38px]">
            <div class="left-[63px] top-0 absolute text-[#379012] text-[50px] font-bold font-['Kirome'] leading-[60px]">Cafe</div>
            <div class="left-[63px] top-[44px] absolute text-[#379012] text-[50px] font-bold font-['Kirome'] leading-[60px]">Kasir</div>
            <div class="w-[60px] h-[83px] left-0 top-[9px] absolute">
                <div class="w-[33px] h-[83px] left-[27px] top-0 absolute bg-[#389012]"></div>
                <div class="w-3 h-[83px] left-[12px] top-0 absolute bg-[#389012]"></div>
                <div class="w-[5px] h-[83px] left-0 top-0 absolute bg-[#389012]"></div>
            </div>  
            </div>
        </div>

        <div class="h-[320px] px-[18px] py-[25px] bg-white rounded-[15px] shadow-md border-2 border-[#389012] flex flex-col justify-between">
        <!-- Group Pengguna dan Laporan -->
        <div class="flex flex-col gap-4 mb-auto">
            @if(session('user.level') == "Admin")
            <a href="{{ route('pegawai.index') }}" class="px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-sm flex items-center justify-between">
                Pengguna
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            @endif

            @if(session('user.level') == "Manajer")
            <a href="{{ route('menu.index') }}" class="px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-sm flex items-center justify-between">
                Menu
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            @endif

            <a href="{{ route('report.report') }}" class="px-5 py-2.5 bg-[#979696]/20 rounded-[10px] border border-[#979696]/20 text-[#389012] font-semibold text-sm flex items-center justify-between">
                Laporan
                <svg class="w-5 h-5 text-[#389012]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>

        <!-- Group Logout -->
        <a href="/logout" class="px-5 py-2.5 bg-[#f16451] rounded-[10px] border border-[#e74934] text-white font-semibold text-sm flex items-center justify-between">
            <svg class="w-[18px] h-[18px] text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
            </svg>
            Logout
        </a>
    </div>
    </div>

        <!-- Content -->
        <div class="flex-1 pr-4 py-8 bg-[#F0FEDF]">
            @yield('content') 
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>

    <script>
        // Function to show toast with animation
        function showToast(type) {
            const $targetEl = document.getElementById('toast-simple');
            
            if ($targetEl) {
                $targetEl.classList.remove('hidden'); // Show the toast
                
                const options = {
                    transition: 'transition-opacity',
                    duration: 1000,  // Durasi animasi dalam milidetik
                    timing: 'ease-out',  // Timing function

                    // Callback function
                    onHide: (context, targetEl) => {
                        console.log(`${type} toast has been dismissed`);
                        console.log(targetEl);
                    }
                };

                // Apply the fade out effect after 3 seconds
                setTimeout(function () {
                    $targetEl.classList.add('opacity-0'); // Add fade out class
                    $targetEl.classList.add(options.transition); // Add transition class

                    // After the transition duration, hide the element
                    setTimeout(function () {
                        $targetEl.classList.add('hidden'); // Hide the toast
                        options.onHide(null, $targetEl); // Run the callback
                    }, options.duration);
                }, 3000); // Delay 3 seconds before dismissing the toast
            }
        }

        // Example usage
        setTimeout(() => showToast('error'), 1000); // Show error toast after 1 second
        setTimeout(() => showToast('success'), 5000); // Show success toast after 5 seconds
    </script>
</body>
</html>