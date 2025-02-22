<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <div class="bg-[#F0FEDF] w-screen h-screen flex-col flex justify-center items-center">

  @if(session('error'))
  <div id="toast-simple" class="fixed flex items-center max-w-xs p-4 space-x-4 bg-[#ffdddd] border border-[#d02222] rounded-lg shadow-sm top-5 right-5" role="alert">
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
    
  <!-- Logos -->
    <div class="w-52 h-[109px] relative mb-10">
      <div class="left-[63px] top-0 absolute text-[#379012] text-[55px] font-bold font-['Kirome'] leading-[65.45px]">Cafe</div>
      <div class="left-[63px] top-[44px] absolute text-[#379012] text-[55px] font-bo font-['Kirome'] leading-[65.45px]">Kasir</div>
      <div class="w-[60px] h-[83px] left-0 top-[9px] absolute">
        <div class="w-[33px] h-[83px] left-[27px] top-0 absolute bg-[#389012]"></div>
        <div class="w-3 h-[83px] left-[12px] top-0 absolute bg-[#389012]"></div>
        <div class="w-[5px] h-[83px] left-0 top-0 absolute bg-[#389012]"></div>
      </div>
    </div>
  <!-- End Logos -->

  <!-- FORM -->
    <div class="w-[340px] h-[403px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
      <div class="self-stretch justify-start items-center gap-1 inline-flex">
        <div class="h-[21px] justify-start items-center gap-0.5 flex">
          <div class="w-[3px] h-[21px] bg-[#389012]"></div>
          <div class="w-1.5 h-[21px] bg-[#389012]"></div>
        </div>
        <div class="text-[#389012] text-3xl font-semibold font-['Poppins'] leading-9">Masuk</div>
      </div>

      <form action="{{ route('login-process') }}" method="post" class="self-stretch h-[233px] py-2.5 flex-col justify-start items-start gap-5 flex" autocomplete="off">
    @csrf
    <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
        <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama Pengguna</div>
        <input type="text" id="username" name="username" placeholder="Masukan Nama Pengguna" class="w-full px-4 py-2 mt-2 border text-xs rounded-lg focus:outline-none border-green-700" required autocomplete="off" readonly onfocus="this.removeAttribute('readonly')">
    </div>
    
    <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
        <label for="password" class="w-[89px] h-6 text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Sandi</label>
        <div class="flex gap-2">
            <div class="flex-1">
                <input type="password" id="password" name="password" placeholder="Masukan Sandi" class="self-stretch h-[38px] w-[210px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-['Poppins']" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly')">
            </div>
            <div class="flex-none">
                <button type="button" id="togglePassword" class="self-stretch h-[38px] w-[38px] p-0 rounded-[10px] border border-[#389012] text-[#389012] flex justify-center items-center">
                    <svg id="iconClosed" class="w-6 h-6 text-[#389012]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    
                    <svg id="iconOpen" class="w-6 h-6 text-[#389012] hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Tambahkan tombol login di sini -->
    <button type="submit" class="w-full px-5 py-3 bg-[#389012] rounded-lg border border-[#389012] text-white text-lg font-semibold hover:bg-green-800 transition">
        Lanjut
    </button>

</form>


    </div>
    <!-- END FORM -->
  </div>

  

  






  <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        const iconClosed = document.getElementById('iconClosed');
        const iconOpen = document.getElementById('iconOpen');

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            if (type === 'password') {
                iconClosed.classList.remove('hidden');
                iconOpen.classList.add('hidden');
            } else {
                iconClosed.classList.add('hidden');
                iconOpen.classList.remove('hidden');
            }
        });
    </script>

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
                        console.log(${type} toast has been dismissed);
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
