@extends('layouts.app')

@section('page_title', 'Lapangan')

@section('content')
<div class="space-y-4">
    
    <!-- Judul & Tombol Tambah Lapangan -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-lg font-bold text-slate-900">Lapangan</h1>
            <p class="text-xs text-slate-500">Input data lapangan, jenis rumput/lantai, ukuran, dan status fisik</p>
        </div>
        <!-- Button tambah lapangan -->
        <button type="button" 
                onclick="document.getElementById('modal-tambah-venue').classList.remove('hidden')"
                class="px-3 py-1.5 text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-lg cursor-pointer transition">
            + Tambah Lapangan
        </button>
    </div>

    <!-- Tabel Data Lapangan -->
    <!-- Judul kolom -->
    <div class="bg-white border border-slate-200 rounded-lg overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-600 border-b border-slate-200 font-semibold">
                <tr>
                    <th class="py-2.5 px-3">Kode</th>
                    <th class="py-2.5 px-3">Nama Lapangan</th>
                    <th class="py-2.5 px-3">Cabang Olahraga</th>
                    <th class="py-2.5 px-3">Lantai/Rumput</th>
                    <th class="py-2.5 px-3">Ukuran</th>
                    <th class="py-2.5 px-3">Tarif/Jam</th>
                    <th class="py-2.5 px-3">Status</th>
                    <th class="py-2.5 px-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- Isi data -->
            <tbody class="divide-y divide-slate-100 text-slate-700">
                @forelse($venues as $v)
                <tr>
                    <td class="py-2.5 px-3 font-mono font-medium text-slate-900">{{ $v->kode_lapangan }}</td>
                    <td class="py-2.5 px-3 font-medium text-slate-900">{{ $v->nama_lapangan }}</td>
                    <td class="py-2.5 px-3">{{ $v->tipe_olahraga }}</td>
                    <td class="py-2.5 px-3">{{ $v->jenis_lantai }}</td>
                    <td class="py-2.5 px-3 font-mono">{{ $v->ukuran_lapangan }}</td>
                    <td class="py-2.5 px-3 font-mono font-medium text-slate-900">
                        Rp {{ number_format($v->tarif_perjam, 0) }}
                    </td>
                    <td class="py-2.5 px-3">
                        @if($v->status_lapangan == 'Tersedia')
                            <span class="text-emerald-700 font-medium">Tersedia</span>
                        @elseif($v->status_lapangan == 'Maintenance')
                            <span class="text-amber-700 font-medium">Maintenance</span>
                        @elseif($v->status_lapangan == 'Renovasi')
                            <span class="text-red-700 font-medium">Renovasi</span>
                        @elseif($v->status_lapangan == 'Dipesan')
                            <span class="text-indigo-700 font-medium">Dipesan</span>
                        @else
                            <span class="text-slate-700 font-medium">{{ $v->status_lapangan }}</span>
                        @endif
                    </td>
                    <td class="py-2.5 px-3 text-center space-x-2">

                        <!-- Tombol Edit -->
                        <button type="button" 
                                onclick="document.getElementById('modal-edit-{{ $v->id }}').classList.remove('hidden')"
                                class="text-blue-600 hover:text-blue-800 font-medium cursor-pointer">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('venues.destroy', $v) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 font-medium hover:text-rose-600 cursor-pointer">Hapus</button>
                        </form>

                        <!-- Form edit data lapangan -->
                        <div id="modal-edit-{{ $v->id }}" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 hidden text-left font-sans">
                            <div class="bg-white rounded-xl border border-slate-200 shadow-2xl max-w-lg w-full p-5 overflow-hidden">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                                    <h3 class="font-bold text-slate-900 text-sm">Edit Lapangan ({{ $v->kode_lapangan }})</h3>
                                    <button type="button" onclick="document.getElementById('modal-edit-{{ $v->id }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-xl font-bold cursor-pointer">&times;</button>
                                </div>
                                
                                <form action="{{ route('venues.update', $v) }}" method="POST" class="space-y-3 text-xs">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Kode Lapangan (Tetap)</label>
                                            <input type="text" value="{{ $v->kode_lapangan }}" disabled class="w-full px-2.5 py-1.5 border border-slate-200 bg-slate-100 rounded-lg text-slate-500 cursor-not-allowed">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Nama Lapangan</label>
                                            <input type="text" name="nama_lapangan" value="{{ $v->nama_lapangan }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Cabang Olahraga</label>
                                            <input type="text" name="tipe_olahraga" value="{{ $v->tipe_olahraga }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Lantai/Rumput</label>
                                            <input type="text" name="jenis_lantai" value="{{ $v->jenis_lantai }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Ukuran</label>
                                            <input type="text" name="ukuran_lapangan" value="{{ $v->ukuran_lapangan }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-slate-700 mb-1">Tarif Per-Jam (Rp)</label>
                                            <input type="number" name="tarif_perjam" value="{{ (int)$v->tarif_perjam }}" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block font-medium text-slate-700 mb-1">Status Lapangan</label>
                                        <select name="status_lapangan" class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                                            <option value="Tersedia" {{ $v->status_lapangan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="Maintenance" {{ $v->status_lapangan == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                            <option value="Renovasi" {{ $v->status_lapangan == 'Renovasi' ? 'selected' : '' }}>Renovasi</option>
                                            <option value="Dipesan" {{ $v->status_lapangan == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
                                        </select>
                                    </div>

                                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                                        <button type="button" onclick="document.getElementById('modal-edit-{{ $v->id }}').classList.add('hidden')" class="px-3 py-1.5 text-xs text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg cursor-pointer">Batal</button>
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg cursor-pointer">Perbarui Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- kalau gaada data lapangan -->
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-slate-400 italic">Belum ada data lapangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- form tambah data lapangan -->
    <div id="modal-tambah-venue" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-xl border border-slate-200 shadow-2xl max-w-lg w-full p-5 overflow-hidden">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="font-bold text-slate-900 text-sm">Tambah Lapangan Baru</h3>
                <button type="button" onclick="document.getElementById('modal-tambah-venue').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-xl font-bold cursor-pointer">&times;</button>
            </div>
            
            <form action="{{ route('venues.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Kode Lapangan</label>
                        <input type="text" name="kode_lapangan" placeholder="LAP-001" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Nama Lapangan</label>
                        <input type="text" name="nama_lapangan" placeholder="Futsal Court A" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Cabang Olahraga</label>
                        <input type="text" name="tipe_olahraga" placeholder="Futsal/Badminton/Basket" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Lantai/Rumput</label>
                        <input type="text" name="jenis_lantai" placeholder="Rumput Sintetis/Interlock" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Ukuran Lapangan</label>
                        <input type="text" name="ukuran_lapangan" placeholder="25m x 15m" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Tarif Per-Jam (Rp)</label>
                        <input type="number" name="tarif_perjam" placeholder="150000" required class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                    </div>
                </div>

                <div>
                    <label class="block font-medium text-slate-700 mb-1">Status Lapangan</label>
                    <select name="status_lapangan" class="w-full px-2.5 py-1.5 border border-slate-300 rounded-lg text-slate-900">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Renovasi">Renovasi</option>
                        <option value="Dipesan">Dipesan</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modal-tambah-venue').classList.add('hidden')" class="px-3 py-1.5 text-xs text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg cursor-pointer">Batal</button>
                    <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-lg cursor-pointer">Simpan Lapangan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection