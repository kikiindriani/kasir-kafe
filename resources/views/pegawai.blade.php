@extends('layouts.app') 

@section('content')
    <h1 class="text-4xl font-bold">Dashboard</h1>
    <div class="flex">
        <p class="mt-2 text-xl italic font-bold">Halo, </p>
        <p class="mt-2 text-xl">{{ session('user.level') }}!</p>
    </div>
    
    <div class="mt-14">
        <div class="px-6 py-[25px] bg-white rounded-[10px] shadow-md border-2 border-[#389012] flex flex-col justify-between">
            <div class="content-header mt-2 p-2">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Pengguna Tersedia</h2>
                <button data-modal-target="add-modal" data-modal-toggle="add-modal" class="px-3 py-2 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-xs flex items-center justify-between space-x-2">
                    <span>Tambah Pengguna</span>
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5"/>
                    </svg>
                </button>
            </div>

            </div>
            <div class="table-content mt-2 p-2 h-[420px] overflow-y-auto no-scrollbar">
                <div class="space-y-4">
                @foreach ($pegawai as $pegawai)
                    <div class="flex items-center h-16 justify-between bg-[#E4FFD9] border border-black text-white p-4 rounded-xl shadow-md">
                        <div>
                            <div class="text-sm italic text-black">{{ $pegawai->username }}</div>
                            <div class="text-base text-black font-medium">{{ $pegawai->nama_pegawai }}</div>
                        </div>
                        <div>
                            <!-- sementara pake cara ini bisa, tinggal mikir bikin modalnya -->
                            <button data-modal-target="default-modal-{{ $pegawai->id_pegawai }}" data-modal-toggle="default-modal-{{ $pegawai->id_pegawai }}" class="" type="button">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                </svg>
                            </button>
                            <button data-modal-target="delete-modal-{{ $pegawai->id_pegawai }}" data-modal-toggle="delete-modal-{{ $pegawai->id_pegawai }}" class="" type="button">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>


                    <div id="default-modal-{{ $pegawai->id_pegawai }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="w-[800px] h-[434px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
                            <!-- Modal Header -->
                            <div class="self-stretch justify-start items-center gap-1 inline-flex">
                                <div class="h-[21px] justify-start items-center gap-0.5 flex">
                                    <div class="w-[3px] h-[21px] bg-[#389012]"></div>
                                    <div class="w-1.5 h-[21px] bg-[#389012]"></div>
                                </div>
                                <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Edit Kasir</div>
                            </div>
                            <!-- Modal Content -->
                            <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex">
                                @csrf    
                                @method('PUT')
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                    <label for="nama" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama lengkap</label>
                                    <input type="text" id="nama" name="nama" value="{{ ($pegawai->nama_pegawai) }}" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" required>
                                </div>
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                    <label for="username" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama Pengguna</label>
                                    <input type="text" id="username" name="username" value="{{ ($pegawai->username) }}" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" required>
                                </div>
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                    <label for="password" class="w-[89px] h-6 text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Sandi</label>
                                    <div class="flex gap-2">
                                        <div class="flex-1">
                                            <input type="password" id="password" name="password" class="self-stretch h-[38px] w-[670px] p-2.5 rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" required>
                                            <small id="passwordHelp" class="text-xs text-red-500 mt-1 hidden">Password harus memiliki minimal 8 karakter.</small>
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
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                <button type="submit" class="self-stretch px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] justify-between items-center inline-flex overflow-hidden">
                                    <div class="text-lg font-semibold font-['Poppins'] text-white leading-snug">Lanjut</div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </div>  
                                </button>    
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="delete-modal-{{ $pegawai->id_pegawai }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="w-[500px] h-[264px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
                            <div class="self-stretch justify-start items-center gap-1 inline-flex">
                                <div class="h-[21px] justify-start items-center gap-0.5 flex">
                                    <div class="w-[3px] h-[21px] bg-[#389012]"></div>
                                    <div class="w-1.5 h-[21px] bg-[#389012]"></div>
                                </div>
                                <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Hapus Kasir</div>
                            </div>
                            <form action="{{ route('pegawai.delete', $pegawai->id_pegawai) }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex">
                                @csrf    
                                @method('DELETE')
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                    <label for="nama" class="text-[#389012] text-xl font-medium font-['Poppins'] leading-normal">Hapus Pengguna {{($pegawai->nama_pegawai)}}?</label>
                                </div>
                                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                <button type="submit" class="self-stretch px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] justify-between items-center inline-flex overflow-hidden">
                                    <div class="text-lg font-semibold font-['Poppins'] text-white leading-snug">Lanjut</div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </div>  
                                </button>    
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add-->
    <div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="w-[800px] h-[434px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
            <!-- Modal Header -->
            <div class="self-stretch justify-start items-center gap-1 inline-flex">
                <div class="h-[21px] justify-start items-center gap-0.5 flex">
                    <div class="w-[3px] h-[21px] bg-[#389012]"></div>
                    <div class="w-1.5 h-[21px] bg-[#389012]"></div>
                </div>
                <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Tambah kasir</div>
            </div>
            <!-- Modal Content -->
            <form action="{{ route('pegawai.add') }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex">
                @csrf    
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="nama" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama lengkap</label>
                    <input type="text" id="nama" name="nama" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" placeholder="Nama Lengkap" required>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="username" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama Pengguna</label>
                    <input type="text" id="username" name="username" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" placeholder="@nama" required>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="password" class="w-[89px] h-6 text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Sandi</label>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <input type="password" id="passwordAdd" name="passwordAdd" class="self-stretch h-[38px] w-[670px] p-2.5 rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" required>
                            <small id="passwordHelpAdd" class="text-xs text-red-500 mt-1 hidden">Password harus memiliki minimal 8 karakter.</small>
                        </div>
                        <div class="flex-none">
                        <button type="button" id="togglePasswordAdd" class="self-stretch h-[38px] w-[38px] p-0 rounded-[10px] border border-[#389012] text-[#389012] flex justify-center items-center">
                            <svg id="iconAddClosed" class="w-6 h-6 text-[#389012]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            
                            <svg id="iconAddOpen" class="w-6 h-6 text-[#389012] hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                        </div>
                    </div>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                <button type="submit" class="self-stretch px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] justify-between items-center inline-flex overflow-hidden">
                    <div class="text-lg font-semibold font-['Poppins'] text-white leading-snug">Lanjut</div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </div>  
                </button>    
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const togglePasswordAddButton = document.getElementById('togglePasswordAdd');
        const passwordField = document.getElementById('password');
        const passwordAddField = document.getElementById('passwordAdd');
        const iconClosed = document.getElementById('iconClosed');
        const iconAddClosed = document.getElementById('iconAddClosed');
        const iconOpen = document.getElementById('iconOpen');
        const iconAddOpen = document.getElementById('iconAddOpen');
        
        const passwordAddInput = document.getElementById('passwordHelpAdd');
        const passwordInput = document.getElementById('passwordHelp');

        passwordField.addEventListener('input', function() {
            if (passwordField.value.length < 8) {
                passwordInput.classList.remove('hidden');
            } else {
                passwordInput.classList.add('hidden');
            }
        });

        passwordAddField.addEventListener('input', function() {
            if (passwordAddField.value.length < 8) {
                passwordAddInput.classList.remove('hidden');
            } else {
                passwordAddInput.classList.add('hidden');
            }
        });

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


        togglePasswordAddButton.addEventListener('click', function(){
            const type = passwordAddField.type === 'password' ? 'text' : 'password';
            passwordAddField.type = type;

            if (type === 'password') {
                iconAddClosed.classList.remove('hidden');
                iconAddOpen.classList.add('hidden');
            } else {
                iconAddClosed.classList.add('hidden');
                iconAddOpen.classList.remove('hidden');
            }
        });
    </script>
@endsection

