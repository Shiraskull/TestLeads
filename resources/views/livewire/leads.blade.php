<div class="px-4">
    <div class="p-6 space-y-6 max-w-7xl my-10  mx-auto bg-white rounded-xl shadow">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 space-y-6">
              <!-- Selection Criteria -->
              <div class="bg-blue-200 rounded-3xl p-4 ">
                <h2 class="text-xl font-bold mb-4">Selection Criteria</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($kolom as $item)
                    <div>
                        <label class="block text-sm font-medium">{{ $item['nama'] }}</label>

                        @if($item['tipe'] === 'varchar')
                            <!-- Dropdown untuk varchar -->
                            <select class="input input-bordered w-full"  wire:change="handleSelectChange($event.target.value)" >
                                <option value="">Pilih {{ $item['nama'] }}</option>
                                @foreach ($dataUnik[$item['nama']] ?? [] as $value)
                                <option value='@json(["value" => $value, "nama" => $item["nama"]])'>{{ $value }}</option>

                                @endforeach
                            </select>
                            @foreach ($SelectTipe as $nama => $values)
                                @if ($nama ==  $item['nama'])
                                    <div class="mt-2">
                                        <strong>{{ $nama }}:</strong>
                                        {{ implode(', ', $values) }}
                                    </div>
                                @endif
                            @endforeach
                        @elseif($item['tipe'] === 'bigint')
                            <!-- Input untuk tipe bigint -->
                            <div class="flex items-center gap-2">
                                <input
                                    type="number"
                                    class="input input-bordered w-full"
                                    placeholder="Min {{ $item['nama'] }}"
                                    wire:change="changeRange('{{ $item['nama'] }}', 'min', $event.target.value)"
                                />
                                <input
                                    type="number"
                                    class="input input-bordered w-full"
                                    placeholder="Max {{ $item['nama'] }}"
                                    wire:change="changeRange('{{ $item['nama'] }}', 'max', $event.target.value)"
                                />
                            </div>
                        {{-- @endif --}}
                        @elseif($item['tipe'] === 'date')
                            <!-- Input untuk tipe date -->
                            <div class="flex items-center gap-2">
                                <input
        type="date"
        class="input input-bordered w-full"
        placeholder="Min {{ $item['nama'] }}"
        wire:change="changeDate('{{ $item['nama'] }}', 'min', $event.target.value)"
    />
    <span class="text-sm">s/d</span>
    <input
        type="date"
        class="input input-bordered w-full"
        placeholder="Max {{ $item['nama'] }}"
        wire:change="changeDate('{{ $item['nama'] }}', 'max', $event.target.value)"
    />
                            </div>
                        @endif
                    </div>
                @endforeach


                  {{-- <div>
                    <label class="block text-sm font-medium">Tipe Kendaraan</label>
                    <select class="input input-bordered w-full">
                      @foreach ($type as $tipe)
                          <option>{{ $tipe }}</option>
                      @endforeach
                    </select>
                  </div> --}}
                </div>
              </div>

              <!-- Field Data -->
              <div>
                <h2 class="text-xl font-bold mb-2">Field Data</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($kolom as $item)
                    <label>
                        <input
                            type="checkbox"
                            class="mr-2"
                            wire:change="handleCheckboxChange('{{ $item['nama'] }}')"
                            value="{{ $item['nama'] }}"
                        >
                        {{ $item['nama'] }}
                    </label>
                @endforeach
    {{-- @dump($this->checkboxValues --}}

                </div>
              </div>
            </div>
            <div class="col-span-12 lg:col-span-4 flex flex-col justify-between space-y-6">
              <!-- Nama Report -->


              <!-- Daftar Report -->
              <div>
                <h2 class="text-xl font-bold mb-2">Daftar Report</h2>
                @if ($reports && $reports->count() > 0) <!-- Memastikan data tidak kosong -->
                    <div class="space-y-2">
                        <!-- Loop untuk menampilkan daftar report -->
                        @foreach ($reports as $report)
                            <div class="flex items-center justify-between bg-gray-100 p-3 rounded">
                                <!-- Checkbox untuk memilih report -->
                                <div class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        wire:change="handleCheckboxChangeReport('{{ $report->id }}')"
                                        value="{{ $report->id }}"
                                        class="checkbox checkbox-primary"
                                    >
                                    <span>{{ $report->nama }}</span>
                                </div>
                                <!-- Tombol untuk setiap report -->
                            </div>
                        @endforeach

                        <div class="space-x-2">
                            <button class="btn btn-sm btn-secondary" wire:click='cetak'>Cetak PDF</button>
                            <button class="btn btn-sm btn-error" wire:click="hapusReport({{ $report->id }})">Hapus</button>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada report untuk ditampilkan.</p> <!-- Menampilkan pesan jika tidak ada data -->
                @endif
            </div>
{{-- @dump($leads) --}}

            </div>

        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Nama Report</label>
            <form wire:submit.prevent="simpanTemplate">
                <input type="text" class="input input-bordered w-full mb-3" placeholder="Contoh: Laporan Penjualan Tipe A" wire:model="templateName" />
                <button type="submit" class="btn btn-primary w-full">Simpan Template</button>
            </form>

          </div>
      <!-- Kiri: Selection Criteria dan Field Data -->

      <!-- Kanan: Save Report & Daftar Report -->

    </div>
  </div>
