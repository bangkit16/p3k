<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use App\Models\Pemakaian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PelaporanController extends Controller
{
    public function prepareData()
    {
        $data = Pemakaian::with(['kotakP3k' , 'barang' , 'user'])->get();

        

        return [
            'data' => $data
        ];
        

    }

    public function downloadPDF(Request $request)
    {
        $data = $this->prepareData();

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        // $pdf = Pdf::loadView('admin.laporan.cetak', $data, compact('id'));
        
        $pdf = Pdf::loadView('admin.laporan.cetak_pdf_pemakaian', $data);
        return $pdf->download('checklist-p3k.pdf');


        // return $pdf->download('patroli-keselamatan.pdf');
    }

    //
    public function downloadExcel(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $header = ['NO', 'NAMA PEMAKAI OBAT P3K', 'DIVISI', 'TANGGAL PEMAKAIAN', 'JAM PEMAKAIAN', 'JENIS OBAT P3K', 'JUMLAH PEMAKAIAN', 'ALASAN PEMAKAIAN', 'KOTAK P3K'];
        $sheet->fromArray($header, null, 'A1');

        // Data
        $databaseData = Pemakaian::with(['kotakP3k' , 'barang' , 'user'])->get();

        $data = $databaseData->map(function ($item, $index) {
            return [
                $index + 1, // NO
                $item->nama_pemakai, // NAMA PEMAKAI
                $item->divisi, // DIVISI
                $item->tanggal, // TANGGAL
                $item->jam_pemakaian, // JAM
                $item->barang->barang_nama ?? 'N/A', // JENIS OBAT P3K
                $item->jumlah_pemakaian, // JUMLAH
                $item->alasan_pemakaian, // ALASAN
                $item->kotakP3k->lokasi ?? 'N/A' // KOTAK P3K
            ];
        })->toArray();

        // $data = [
        //     [1, 'Andi', 'HRD', '2024-12-10', '10:00:00', 'Kasa steril (isi 10)', 2, 'Luka kecil', 'Kantor'],
        //     [2, 'Budi', 'Produksi', '2024-12-11', '14:30:00', 'Perban (lebar 5 cm) isi 10', 1, 'Tergores mesin', 'Dapur'],
        //     [3, 'Ferly', 'UI/UX', '2024-12-11', '18:22:00', 'Sarung tangan sekali pakai', 1, 'ADA', 'Dapur']
        // ];

        $sheet->fromArray($data, null, 'A2');

        // Styling
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(20);

        // Export file
        $writer = new Xlsx($spreadsheet);
        $filename = 'data-obat-p3k.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function print(Request $request)
    {
        $data = $this->prepareData();

        // dd($data);

        // dd(count($data['data'][4]['sub_uraian']));

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.laporan.cetak_print_pemakaian', $data, compact('data'));
    }
}
