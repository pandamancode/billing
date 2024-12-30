<?php

namespace App\Exports;

use App\Models\Pegawai;
use App\Models\Posisi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RekapExport implements FromView, WithEvents
{

    function __construct($request) {
        $this->dari = $request->dari;
        $this->sampai = $request->sampai;
        $this->id_posisi = $request->id_posisi;
        
        $this->jam_wajib = $request->jam_wajib;
        $this->jumlah_wajib_hadir = $request->jumlah_wajib_hadir;
        $this->hari_libur = $request->hari_libur;
    }

    public function view(): View
    {

        $period_tanggal = '';

        $dari = $this->dari ?? '';
        $sampai  = $this->sampai ?? '';

        $jam_wajib = $this->jam_wajib ?? '';
        $jumlah_wajib_hadir  = $this->jumlah_wajib_hadir ?? '';
        // $hari_libur  = $this->hari_libur ?? '';

        $posisi = Posisi::orderBy('nama_posisi', 'asc');

        if($this->id_posisi == 'All') {
            $posisi = $posisi->get();
            $pegawai = Pegawai::get();
        }else {
            $posisi = $posisi->where('id', $this->id_posisi)->get();
            $pegawai = Pegawai::where('posisi_id', $this->id_posisi)->get();
        }
        
        // menghitung hari minggu dalam bulan
        $period_tanggal = CarbonPeriod::create($dari , $sampai)->toArray();

            $dtAwal = Carbon::createFromDate($dari);
            $dtAkhir =  Carbon::createFromDate($sampai);

            $countDaySunday = $dtAwal->diffInDaysFiltered(function(Carbon $date) {
                return $date->isSunday();
                }, $dtAkhir);

        return view('admin.rekap.cetak',compact(
            'posisi',
            'pegawai',
            'period_tanggal',
            'dari',
            'sampai',
            'countDaySunday',
            'jam_wajib',
            'jumlah_wajib_hadir',
            // 'hari_libur',
        ));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $styleHeader = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ];
                
                $to = $event->sheet->getDelegate()->getHighestColumn();

                $event->sheet->mergeCells('A1:'.$to.'1');
                $event->sheet->getDelegate()->getStyle('A1:'.$to.'1')->applyFromArray($styleHeader);

                $styleTableHeader = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];

                $to = $event->sheet->getDelegate()->getHighestColumn();

                $event->sheet->getDelegate()->getStyle('A3:'.$to.'4')->applyFromArray($styleTableHeader);

                $styleTableUtama = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];

                $to = $event->sheet->getDelegate()->getHighestColumn();

                $hight = $event->sheet->getDelegate()->getHighestRow();

                for ($i = 'A'; $i !=  $to; $i++) {
                    $event->sheet->getDelegate()->getColumnDimension($i)->setAutoSize(true);
                }
                $event->sheet->getDelegate()->getStyle('A5:'.$to.$hight)->applyFromArray($styleTableUtama);
                
                $event->sheet->getDelegate()->getProtection()->setSheet(true);
            },
        ];
    }
}