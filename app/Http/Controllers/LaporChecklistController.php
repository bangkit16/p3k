<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class LaporChecklistController extends Controller
{
    //
    public function prepareData($id)
    {
        // $data = Pemakaian::with(['kotakP3k' , 'barang' , 'user'])->get();
        

        // $data = Checklist::with(['user' , 'inputChecklists.barang' , 'kondisiInputs.kondisi' , 'kotakP3k'])->where('user_id' , auth()->user()->id)->where('checklist_id' , $id)->first();

        $object = Checklist::with(['user', 'inputChecklists.barang', 'kondisiInputs.kondisi', 'kotakP3k'])
        ->where('checklist_id', $id)
        ->first()
        ->toArray();

        $data = [
            'lokasi_p3k' => $object['kotak_p3k']['lokasi'],
            'status' => ucfirst($object['status']), // Uppercase pertama
            'tanggal' => date('d-m-Y', strtotime($object['tanggal'])),
            'inspektor' => $object['user']['name'],
            'isi_kotak' => array_map(function ($checklist) {
                return [
                    'isi' => $checklist['barang']['barang_nama'],
                    'jumlah_standar' => $checklist['barang']['jumlah_standar'],
                    'jumlah_aktual' => $checklist['jumlah_aktual'],
                    'tanggal_kadaluarsa' => date('d-m-Y', strtotime($checklist['tanggal_kadaluwarsa'])),
                    'keterangan' => $checklist['keterangan'],
                ];
            }, array_filter($object['input_checklists'], function ($checklist) use ($id) {
                // Filter hanya input_checklists dengan checklist_id yang sesuai
                return $checklist['checklist_id'] == $id;
            })),
            'status_kotak' => array_map(function ($kondisi) {
                return [
                    'item' => $kondisi['kondisi']['kondisi_nama'],
                    'status' => ucfirst($kondisi['status']), // Uppercase pertama
                    'tindakan' => ucfirst($kondisi['tindakan_perbaikan']), // Uppercase pertama
                ];
            }, $object['kondisi_inputs']),
        ];
        

        // dd($data->toArray());

        return [
            'data' => $data
        ];
        

    }

    public function downloadPDF(Request $request , $id)
    {
        // $object = Checklist::with(['user', 'inputChecklists.barang', 'kondisiInputs.kondisi', 'kotakP3k'])
        // ->where('checklist_id', $id)
        // ->first()
        // ->toArray();

        // $data = [
        //     'lokasi_p3k' => $object['kotak_p3k']['lokasi'],
        //     'status' => ucfirst($object['status']), // Uppercase pertama
        //     'tanggal' => date('d-m-Y', strtotime($object['tanggal'])),
        //     'inspektor' => $object['user']['name'],
        //     'isi_kotak' => array_map(function ($checklist) {
        //         return [
        //             'isi' => $checklist['barang']['barang_nama'],
        //             'jumlah_standar' => $checklist['barang']['jumlah_standar'],
        //             'jumlah_aktual' => $checklist['jumlah_aktual'],
        //             'tanggal_kadaluarsa' => date('d-m-Y', strtotime($checklist['tanggal_kadaluwarsa'])),
        //             'keterangan' => $checklist['keterangan'],
        //         ];
        //     }, array_filter($object['input_checklists'], function ($checklist) use ($id) {
        //         // Filter hanya input_checklists dengan checklist_id yang sesuai
        //         return $checklist['checklist_id'] == $id;
        //     })),
        //     'status_kotak' => array_map(function ($kondisi) {
        //         return [
        //             'item' => $kondisi['kondisi']['kondisi_nama'],
        //             'status' => ucfirst($kondisi['status']), // Uppercase pertama
        //             'tindakan' => ucfirst($kondisi['tindakan_perbaikan']), // Uppercase pertama
        //         ];
        //     }, $object['kondisi_inputs']),
        // ];

        $data = $this->prepareData($id);
        
        $pdf = Pdf::loadView('admin.laporan.cetak_pdf_checklist', $data);
        return $pdf->download('checklist-p3k.pdf');
    }

    //
    public function downloadExcel($id){
        $object = Checklist::with(['user', 'inputChecklists.barang', 'kondisiInputs.kondisi', 'kotakP3k'])
            ->where('checklist_id', $id)
            ->first()
            ->toArray();

        $data = [
            'lokasi_p3k' => $object['kotak_p3k']['lokasi'],
            'status' => ucfirst($object['status']), // Uppercase pertama
            'tanggal' => date('d-m-Y', strtotime($object['tanggal'])),
            'inspektor' => $object['user']['name'],
            'isi_kotak' => array_map(function ($checklist) {
                return [
                    'isi' => $checklist['barang']['barang_nama'],
                    'jumlah_standar' => $checklist['barang']['jumlah_standar'],
                    'jumlah_aktual' => $checklist['jumlah_aktual'],
                    'tanggal_kadaluarsa' => date('d-m-Y', strtotime($checklist['tanggal_kadaluwarsa'])),
                    'keterangan' => $checklist['keterangan'],
                ];
            }, array_filter($object['input_checklists'], function ($checklist) use ($id) {
                // Filter hanya input_checklists dengan checklist_id yang sesuai
                return $checklist['checklist_id'] == $id;
            })),
            'status_kotak' => array_map(function ($kondisi) {
                return [
                    'item' => $kondisi['kondisi']['kondisi_nama'],
                    'status' => ucfirst($kondisi['status']), // Uppercase pertama
                    'tindakan' => ucfirst($kondisi['tindakan_perbaikan']), // Uppercase pertama
                ];
            }, $object['kondisi_inputs']),
        ];


        // dd($data);
        // $data = [
        //     'lokasi_p3k' => 'Gudang Utama',
        //     'status' => 'Baik',
        //     'tanggal' => now()->format('d-m-Y'),
        //     'inspektor' => 'John Doe',
        //     'isi_kotak' => [
        //         ['isi' => 'Kasa steril (isi 10)', 'jumlah_standar' => 4, 'jumlah_aktual' => 3, 'tanggal_kadaluarsa' => '2025-12-01', 'keterangan' => 'Kurang'],
        //         ['isi' => 'Perban (lebar 5 cm)', 'jumlah_standar' => 4, 'jumlah_aktual' => 4, 'tanggal_kadaluarsa' => '2024-06-15', 'keterangan' => '-'],
        //     ],
        //     'status_kotak' => [
        //         ['item' => 'Kotak P3K berwarna dasar putih dengan tanda cross warna hijau', 'status' => 'Sesuai'],
        //         ['item' => 'Kotak P3K dalam kondisi tidak tertutup oleh benda lain', 'status' => 'Tidak Sesuai'],
        //     ],
        // ];
    
        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set judul
        $sheet->setCellValue('A1', 'Checklist Kotak P3K');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
    
        // Tambahkan informasi umum
        $sheet->setCellValue('A3', 'Lokasi P3K:');
        $sheet->setCellValue('B3', $data['lokasi_p3k']);
        $sheet->setCellValue('A4', 'Status:');
        $sheet->setCellValue('B4', $data['status']);
        $sheet->setCellValue('A5', 'Tanggal:');
        $sheet->setCellValue('B5', $data['tanggal']);
        $sheet->setCellValue('A6', 'Inspektor:');
        $sheet->setCellValue('B6', $data['inspektor']);
    
        // Tambahkan tabel "Isi Kotak P3K"
        $sheet->setCellValue('A8', 'No.');
        $sheet->setCellValue('B8', 'Isi Kotak');
        $sheet->setCellValue('C8', 'Jumlah Standar');
        $sheet->setCellValue('D8', 'Jumlah Aktual');
        $sheet->setCellValue('E8', 'Tanggal Kadaluarsa');
        $sheet->setCellValue('F8', 'Keterangan');
        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
    
        $row = 9;
        foreach ($data['isi_kotak'] as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item['isi']);
            $sheet->setCellValue('C' . $row, $item['jumlah_standar']);
            $sheet->setCellValue('D' . $row, $item['jumlah_aktual']);
            $sheet->setCellValue('E' . $row, $item['tanggal_kadaluarsa']);
            $sheet->setCellValue('F' . $row, $item['keterangan']);
            $row++;
        }
    
        // Tambahkan tabel "Kondisi Kotak"
        $row += 2; // Pindah ke baris berikutnya
        $sheet->setCellValue('A' . $row, 'No.');
        $sheet->setCellValue('B' . $row, 'Item Check');
        $sheet->setCellValue('C' . $row, 'Status');
        $sheet->setCellValue('D' . $row, 'Tindakan Perbaikan');
        $sheet->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);
    
        $row++;
        foreach ($data['status_kotak'] as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item['item']);
            $sheet->setCellValue('C' . $row, $item['status']);
            $sheet->setCellValue('D' . $row, $item['tindakan']);
            $row++;
        }
    
        // Atur lebar kolom
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Simpan ke file Excel dan kirimkan sebagai respons download
        $filename = 'Checklist_P3K.xlsx';
        $writer = new WriterXlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);
    
        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }

    public function print(Request $request , $id)
    {
        $object = Checklist::with(['user', 'inputChecklists.barang', 'kondisiInputs.kondisi', 'kotakP3k'])
            ->where('checklist_id', $id)
            ->first()
            ->toArray();

        $data = [
            'lokasi_p3k' => $object['kotak_p3k']['lokasi'],
            'status' => ucfirst($object['status']), // Uppercase pertama
            'tanggal' => date('d-m-Y', strtotime($object['tanggal'])),
            'inspektor' => $object['user']['name'],
            'isi_kotak' => array_map(function ($checklist) {
                return [
                    'isi' => $checklist['barang']['barang_nama'],
                    'jumlah_standar' => $checklist['barang']['jumlah_standar'],
                    'jumlah_aktual' => $checklist['jumlah_aktual'],
                    'tanggal_kadaluarsa' => date('d-m-Y', strtotime($checklist['tanggal_kadaluwarsa'])),
                    'keterangan' => $checklist['keterangan'],
                ];
            }, array_filter($object['input_checklists'], function ($checklist) use ($id) {
                // Filter hanya input_checklists dengan checklist_id yang sesuai
                return $checklist['checklist_id'] == $id;
            })),
            'status_kotak' => array_map(function ($kondisi) {
                return [
                    'item' => $kondisi['kondisi']['kondisi_nama'],
                    'status' => ucfirst($kondisi['status']), // Uppercase pertama
                    'tindakan' => ucfirst($kondisi['tindakan_perbaikan']), // Uppercase pertama
                ];
            }, $object['kondisi_inputs']),
        ];

        return view('admin.laporan.cetak_print_checklist', compact('data'));
    }
}
