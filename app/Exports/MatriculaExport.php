<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Collection;

class MatriculaExport implements FromView
{


    public function __construct(Collection $data, $taller)
    {
        $this->data = $data;
        $this->taller = $taller;
    }

    public function view(): View
    {
        return view('excel.lista_matriculas', [
            'matriculas' => $this->data,
            'taller'=> $this->taller
        ]);
    }
}
