<?php

namespace App\Http\Controllers;

use App\Models\Raket;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class UserController extends Controller
{
    public function index()
    {
        $rakets = Raket::all();
        return view('user.index', compact('rakets'));
    }

    public function show(Raket $raket)
    {
        return view('user.show', compact('raket'));
    }

    public function downloadPdf(Request $request, Raket $raket)
{
    $chartConfig = [
        'type' => 'radar',
        'data' => [
            'labels' => ['Power', 'Control', 'Speed', 'Durability', 'Flexibility'],
            'datasets' => [[
                'label' => 'Performa',
                'data' => [(int)$raket->power, (int)$raket->control, (int)$raket->speed, (int)$raket->durability, (int)$raket->flexibility],
                'backgroundColor' => 'rgba(13, 110, 253, 0.15)',
                'borderColor' => 'rgba(13, 110, 253, 1)',
                'borderWidth' => 2
            ]]
        ],
        'options' => [
            'scale' => [
                'ticks' => ['min' => 0, 'max' => 100, 'display' => false]
            ],
            'legend' => ['display' => false]
        ]
    ];

    $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig));

    $html = view('user.pdf', compact('raket', 'chartUrl'))->render();
    
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 15,
        'margin_bottom' => 15,
    ]);
    
    $mpdf->WriteHTML($html);
    
    return $mpdf->Output('Spesifikasi-' . $raket->nama_raket . '.pdf', 'D');
}

public function beliRaket(Raket $raket)
{
    if ($raket->gambar) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($raket->gambar);
    }

    $raket->delete();

    return redirect()->route('user.index')->with('success', 'Selamat! Raket berhasil dibeli dan sedang dikemas.');
}
}
