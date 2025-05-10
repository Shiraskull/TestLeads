<?php

namespace App\Livewire;

use App\Exports\LeadsExport;
use App\Models\Leads as ModelsLeads;
use App\Models\Report;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Leads extends Component
{
    public $warna, $dataUnik;
    public $type, $kolom, $templateName,$reports;

    public $SelectTipe = [];
    public $handleReport = [];
    public $checkboxValues = [];
    public $range = [];
    public $date = [];

    /**
     * Simpan template ke dalam database
     */
    public function simpanTemplate()
    {
        // Simpan data template ke dalam tabel report
        $dataTemplate = Report::create([
            'nama' => $this->templateName,
            'SelectTipe' => $this->SelectTipe,
            'checkboxValues' => $this->checkboxValues,
            'range' => $this->range,
            'date' => $this->date,
        ]);

        // Reset nilai setelah disimpan
        return redirect()->route('home');
    }

    /**
     * Menangani perubahan pada checkbox
     */
    public function handleCheckboxChange($nama)
    {
        // Jika nilai belum ada di array, tambahkan
        if (!in_array($nama, $this->checkboxValues)) {
            $this->checkboxValues[] = $nama;
        } else {
            // Jika sudah ada, hapus nilai dari array
            $this->checkboxValues = array_diff($this->checkboxValues, [$nama]);
        }
    }

    /**
     * Menangani perubahan tanggal
     */
    public function changeDate($nama, $tipe, $value)
    {
        // Ambil nilai sebelumnya atau array kosong
        $existing = $this->date[$nama] ?? [];

        // Gabungkan dengan nilai baru
        $existing[$tipe] = $value;

        // Simpan kembali ke array date
        $this->date[$nama] = $existing;
    }

    /**
     * Menangani perubahan rentang
     */
    public function changeRange($nama, $tipe, $value)
    {
        // Ambil nilai sebelumnya atau array kosong
        $existing = $this->range[$nama] ?? [];

        // Gabungkan dengan nilai baru
        $existing[$tipe] = $value;

        // Simpan kembali ke array range
        $this->range[$nama] = $existing;
    }

    /**
     * Menangani perubahan select dropdown
     */
    public function handleSelectChange($jsonValue)
    {
        // Decode nilai JSON
        $data = json_decode($jsonValue, true);
        $value = $data['value'] ?? null;
        $nama = $data['nama'] ?? null;

        if ($nama && $value) {
            // Pastikan array untuk nama sudah ada
            if (!isset($this->SelectTipe[$nama])) {
                $this->SelectTipe[$nama] = [];
            }

            // Tambahkan jika belum ada
            if (!in_array($value, $this->SelectTipe[$nama])) {
                $this->SelectTipe[$nama][] = $value;
            }
        }
    }

    /**
     * Menyiapkan data pada saat mount (komponen dimuat)
     */
    public function mount()
    {
        $data = ModelsLeads::all();
        $this->reports = Report::all();
        dump($this->reports);
        // Ambil kolom-kolom dari tabel leads dan tipe data
        $columns = collect(Schema::getColumnListing('leads'))
            ->reject(fn($col) => in_array($col, ['id', 'created_at', 'updated_at']))
            ->map(fn($col) => [
                'nama' => $col,
                'tipe' => Schema::getColumnType('leads', $col),
            ])
            ->values()
            ->toArray();

        $this->kolom = $columns;

        // Ambil data unik per kolom
        $this->dataUnik = [];
        foreach ($columns as $kolom) {
            $namaKolom = $kolom['nama'];
            $this->dataUnik[$namaKolom] = $data->pluck($namaKolom)->unique()->values()->all();
        }
    }

    /**
     * Menangani perubahan pada field SelectTipe
     */
    public function updatedSelectedTipes($value)
    {
        // Debugging, dump nilai $selectedTipes saat perubahan terjadi
        dd($value);
    }
    public function handleCheckboxChangeReport($nama)
    {
        // Jika nilai belum ada di array, tambahkan
        if (!in_array($nama, $this->handleReport)) {
            $this->handleReport[] = $nama;
        } else {
            // Jika sudah ada, hapus nilai dari array
            $this->handleReport = array_diff($this->handleReport, [$nama]);
        }
    }
    public function cetak()
    {
        $filteredReports = Report::whereIn('id', $this->handleReport)->get();

        foreach ($filteredReports as $index => $report) {
            // Parsing SelectTipe
            $SelectTipe = is_array($report->SelectTipe)
                ? $report->SelectTipe
                : json_decode($report->SelectTipe ?? '{}', true);

            // Parsing checkboxValues
            $checkboxValues = is_array($report->checkboxValues)
                ? $report->checkboxValues
                : json_decode($report->checkboxValues ?? '[]', true);

            // Parsing range dan date
            $range = is_array($report->range)
                ? $report->range
                : json_decode($report->range ?? '{}', true);

            $date = is_array($report->date)
                ? $report->date
                : json_decode($report->date ?? '{}', true);

            // Mulai query untuk Leads
            $query = ModelsLeads::query();

            // Filter SelectTipe
            foreach ($SelectTipe as $key => $values) {
                if (!empty($values)) {
                    $query->where(function ($q) use ($key, $values) {
                        foreach ($values as $value) {
                            $q->orWhere($key, $value);
                        }
                    });
                }
            }

            // Filter Range
            foreach ($range as $field => $rangeValues) {
                if (isset($rangeValues['min'], $rangeValues['max']) && $rangeValues['min'] !== null && $rangeValues['max'] !== null) {
                    $query->whereBetween($field, [$rangeValues['min'], $rangeValues['max']]);
                }
            }

            // Filter Date
            foreach ($date as $field => $dateValues) {
                if (isset($dateValues['min'], $dateValues['max']) && $dateValues['min'] !== null && $dateValues['max'] !== null) {
                    $minDate = date('Y-m-d', strtotime($dateValues['min']));
                    $maxDate = date('Y-m-d', strtotime($dateValues['max']));
                    $query->whereBetween($field, [$minDate, $maxDate]);
                }
            }

            // Tambahkan kolom-kolom dari checkboxValues ke selectedColumns
            $selectedColumns = [];
            if (!empty($checkboxValues)) {
                foreach ($checkboxValues as $column) {
                    if (!in_array($column, $selectedColumns)) {
                        $selectedColumns[] = $column;
                    }
                }
            }

            // Ambil data sesuai kolom yang dipilih
            if (!empty($selectedColumns)) {
                $query->select($selectedColumns);
            }

            // Ambil data leads untuk laporan ini
            $leads = $query->get()->toArray();  // Pastikan hasilnya adalah array

            // Buat nama file untuk setiap laporan
            $fileName = 'leads_report_' . ($index + 1) . '.xlsx';

            // Download file terpisah untuk setiap laporan
            return Excel::download(new LeadsExport([$leads], $selectedColumns), $fileName);
        }
    }






    /**
     * Render view untuk komponen Livewire
     */
    public function render()
    {
        return view('livewire.leads');
    }
}
