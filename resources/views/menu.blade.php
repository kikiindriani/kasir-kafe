@extends('layouts.app') 

@section('content')
    <h1 class="text-4xl font-bold">Beranda</h1>
    <div class="flex">
        <p class="mt-2 text-xl italic font-bold">Halo, </p>
        <p class="mt-2 text-xl">{{ session('user.level') }}!</p>
    </div>
    
    <div class="mt-14">
        <div class="px-6 py-[25px] bg-white rounded-[10px] shadow-md border-2 border-[#389012] flex flex-col justify-between">
            <div class="content-header p-2">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold">Menu Tersedia</h2>
                    <button data-modal-target="add-modal" data-modal-toggle="add-modal" class="px-3 py-2 bg-[#389012] rounded-[10px] border border-[#389012] text-white font-semibold text-xs flex items-center justify-between space-x-2">
                        <span>Tambah Menu</span>
                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="content px-6 h-[420px] overflow-y-auto no-scrollbar">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                        @foreach ($menu as $menu)
                            <div class="w-[195px] h-[200px] bg-white border border-[#DADADA] rounded-lg shadow-sm">
                                <button data-modal-target="detail-menu-{{ $menu->id_menu }}" data-modal-toggle="detail-menu-{{ $menu->id_menu }}">
                                    <img class="object-cover w-[195px] h-[135px] rounded-t-lg" src="{{ asset('storage/images/' . $menu->image_name) }}" alt="" />
                                </button>
                                <div class="px-2 flex flex-col h-full">
                                    <p class="mb-1 font-semibold text-black text-sm">{{ $menu->nama_menu }}</p>
                                    <p class="font-bold text-right text-[#965A50] text-lg">Rp {{ number_format($menu->harga, 0, '.', '.') }}</p>
                                </div>
                            </div>

                            <!-- Edit menu -->
                            <div id="detail-menu-{{ $menu->id_menu }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="w-[800px] h-[434px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
                                    <!-- Modal Header -->
                                    <div class="self-stretch justify-start items-center gap-1 inline-flex">
                                        <div class="h-[21px] justify-start items-center gap-0.5 flex">
                                            <div class="w-[3px] h-[21px] bg-[#389012]"></div>
                                            <div class="w-1.5 h-[21px] bg-[#389012]"></div>
                                        </div>
                                        <div class="flex justify-between w-full">
                                            <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Edit menu</div>
                                            <button data-modal-target="delete-modal-{{ $menu->id_menu }}" data-modal-toggle="delete-modal-{{ $menu->id_menu }}" class="" type="button">
                                                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Modal Content -->
                                    <form action="{{ route('menu.update', $menu->id_menu) }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex" enctype="multipart/form-data">
                                        @csrf    
                                        @method('PUT')
                                        <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                            <label for="nama_menu" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama menu</label>
                                            <input type="text" id="nama_menu" name="nama_menu" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" value="{{ $menu->nama_menu }}" required>
                                        </div>
                                        <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                            <label for="harga" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Harga</label>
                                            <input type="number" id="harga" name="harga" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" value="{{ $menu->harga }}" required>
                                        </div>
                                        <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                            <label for="imageEdit_name" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Profil menu</label>
                                            <div class="flex gap-2">
                                                <div class="flex-1">
                                                    <input type="text" hidden id="fileNameEditDisplay" name="fileNameEditDisplay" class="self-stretch h-[38px] w-[560px] rounded-[10px] border border-[#389012] bg-[#389012] bg-opacity-20 text-[#389012] text-xs font-semibold font-['Poppins'] pl-2 text-left" disabled/>
                                                    <input type="file" id="imageEdit_name" name="imageEdit_name" class="self-stretch h-[38px] w-[560px] rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" accept="image/jpeg, image/png, image/jpg, image/svg" onclick="updateFileName('<?php echo $menu->id_menu ?>')"/>
                                                </div>
                                                <div class="flex-none">
                                                    <button type="button" disabled class="self-stretch w-[150px] p-2.5 rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins'] flex justify-center items-center" onclick="document.getElementById('imageEdit_name').click()">
                                                        Pilih file
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="fileNamePreview" class="mt-2 text-[#389012] text-xs font-semibold font-['Poppins']"></div>
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

                            
                            <!-- Delete menu -->
                            <div id="delete-modal-{{ $menu->id_menu }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="w-[500px] h-[264px] px-10 py-[25px] bg-white rounded-[10px] shadow-[6px_7px_4px_0px_rgba(0,0,0,0.10)] border-2 border-[#389012] flex-col justify-start items-start gap-5 inline-flex overflow-hidden">
                                    <div class="self-stretch justify-start items-center gap-1 inline-flex">
                                        <div class="h-[21px] justify-start items-center gap-0.5 flex">
                                            <div class="w-[3px] h-[21px] bg-[#389012]"></div>
                                            <div class="w-1.5 h-[21px] bg-[#389012]"></div>
                                        </div>
                                        <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Hapus Kasir</div>
                                    </div>
                                    <form action="{{ route('menu.delete', $menu->id_menu) }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex">
                                        @csrf    
                                        @method('DELETE')
                                        <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                                            <label for="nama" class="text-[#389012] text-xl font-medium font-['Poppins'] leading-normal">Hapus Menu {{($menu->nama_menu)}}?</label>
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
                <div class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Tambah menu</div>
            </div>
            <!-- Modal Content -->
            <form action="{{ route('menu.add') }}" method="post" class="self-stretch h-[276px] py-2.5 flex-col justify-start items-start gap-5 flex" enctype="multipart/form-data">
                @csrf    
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="nama_menu" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Nama menu</label>
                    <input type="text" id="nama_menu" name="nama_menu" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" placeholder="Alan Walker" required>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="harga" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Harga</label>
                    <input type="number" id="harga" name="harga" class="self-stretch h-[38px] p-2.5 rounded-[10px] border focus:outline-none border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" placeholder="10000" required>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <label for="imageAdd_name" class="text-[#389012] text-xl font-semibold font-['Poppins'] leading-normal">Profil menu</label>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <input type="text" id="fileAddNameDisplay" name="fileAddNameDisplay" class="self-stretch h-[38px] w-[560px] rounded-[10px] border border-[#389012] bg-[#389012] bg-opacity-20 text-[#389012] text-xs font-semibold font-['Poppins'] pl-2 text-left" disabled />
                            <input type="file" hidden id="imageAdd_name" name="imageAdd_name" class="self-stretch h-[38px] w-[560px] rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins']" accept="image/jpeg, image/png, image/jpg, image/svg" onchange="AddFileName()">
                           
                        </div>
                        <div class="flex-none">
                            <button type="button" class="self-stretch w-[150px] p-2.5 rounded-[10px] border border-[#389012] text-[#389012] text-xs font-semibold font-['Poppins'] flex justify-center items-center" onclick="document.getElementById('imageAdd_name').click()">
                                Pilih file
                            </button>
                        </div>
                    </div>
                    <div id="fileNamePreview" class="mt-2 text-[#389012] text-xs font-semibold font-['Poppins']"></div>
                </div>
                <div class="self-stretch h-[72px] flex-col justify-center items-start gap-2.5 flex">
                    <button type="submit" class="self-stretch px-5 py-2.5 bg-[#389012] rounded-[10px] border border-[#389012] justify-between items-center inline-flex overflow-hidden">
                        <div class="text-lg font-semibold font-['Poppins'] text-white leading-snug">Next</div>
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
        function AddFileName(){
            const fileAddInput = document.getElementById('imageAdd_name');
            const fileAddNameDisplay = document.getElementById('fileAddNameDisplay');
            fileAddNameDisplay.value = fileAddInput.files[0].name;
        }
    </script>
@endsection
