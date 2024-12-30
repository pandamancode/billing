<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Sertifikat;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SertifikatImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $data;

    public function __construct(array $data = []){
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $cekSertifikat = Sertifikat::
                where('nomor_sertifikat', $row['nomor_sertifikat'] ?? '',)
                ->where('peserta_id', $row['id_peserta'] ?? '',)
                ->first();

            if (!is_null($cekSertifikat)) {
                $cekSertifikat->update([
                    'tanggal_sertifikat' => $this->data['tanggal'] ?? '',
                    'nomor_sertifikat' => $row['nomor_sertifikat'] ?? '',
                    'peserta_id' => $row['id_peserta'] ?? '',
                    'nama_peserta' => $row['nama_mahasiswa'] ?? '',
                    'program_studi' => $row['program_studi'] ?? '',
                    'fakultas' => $row['fakultas'] ?? '',
                    'detail_kegiatan_id' => $this->data['kegiatan'] ?? '',
                    'penghargaan_id' => $this->data['penghargaan'] ?? '',
                    'semester' => $this->data['semester'] ?? '',
                ]);
            } else {
                Sertifikat::create([
                    'tanggal_sertifikat' => $this->data['tanggal'] ?? '',
                    'nomor_sertifikat' => $row['nomor_sertifikat'] ?? '',
                    'peserta_id' => $row['id_peserta'] ?? '',
                    'nama_peserta' => $row['nama_mahasiswa'] ?? '',
                    'program_studi' => $row['program_studi'] ?? '',
                    'fakultas' => $row['fakultas'] ?? '',
                    'detail_kegiatan_id' => $this->data['kegiatan'] ?? '',
                    'penghargaan_id' => $this->data['penghargaan'] ?? '',
                    'semester' => $this->data['semester'] ?? '',
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
