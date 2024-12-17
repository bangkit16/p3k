<?php

namespace App\Charts;

use App\Models\P3K;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarangTerpakai
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }




public function build()
{
    // Ambil data P3K beserta barang dan kotakP3K
    $data = P3K::with(['barang', 'kotakP3k'])
        ->get()
        ->groupBy('kotakP3k.lokasi'); // Mengelompokkan berdasarkan lokasi kotak

    // Menyiapkan variabel untuk menyimpan data hasil
    $barNames = [];      // Untuk menyimpan nama barang unik
    $chartData = [];     // Untuk menyimpan data series barang

    // Loop data per lokasi kotak
    foreach ($data as $lokasi => $items) {
        // Urutkan barang berdasarkan jumlah dan ambil 3 barang terkecil
        $barangPalingSedikit = $items->sortBy('jumlah')->take(3);

        foreach ($barangPalingSedikit as $item) {
            $namaBarang = $item->barang->barang_nama;

            // Tambahkan nama barang jika belum ada
            if (!in_array($namaBarang, $barNames)) {
                $barNames[] = $namaBarang;
            }

            // Menyimpan jumlah barang berdasarkan lokasi dan nama barang
            $chartData[$namaBarang][$lokasi] = $item->jumlah;
        }
    }

    // Format data untuk LarapexCharts
    $locations = $data->keys()->toArray(); // Lokasi kotak sebagai X Axis
    $finalChartData = [];

    foreach ($barNames as $barang) {
        $dataValues = [];
        foreach ($locations as $lokasi) {
            // Pastikan semua lokasi memiliki nilai (default 0 jika kosong)
            $dataValues[] = $chartData[$barang][$lokasi] ?? 0;
        }
        $finalChartData[] = [
            'name' => $barang, // Nama barang sebagai series
            'data' => $dataValues,
        ];
    }

    // Membuat grafik menggunakan LarapexCharts
    $chart = $this->chart->barChart()
        ->setTitle('Barang Terpakai')
        ->setSubtitle('3 Barang Paling Sedikit Per Kotak')
        ->setXAxis($locations); // Lokasi kotak sebagai X Axis

    // Menambahkan data ke dalam chart
    foreach ($finalChartData as $data) {
        $chart->addData($data['name'], $data['data']);
    }

    return $chart;
}

    
}
