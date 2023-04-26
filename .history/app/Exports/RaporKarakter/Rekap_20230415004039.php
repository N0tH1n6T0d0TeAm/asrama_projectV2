<?php

namespace App\Exports\RaporKarakter;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Rekap implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $listpenilaian;
    private $listsiswa;

    public function __construct($listpenilaian)
    {
        $this->listpenilaian = $listpenilaian;
    }
    public function view() : View
    {
        return view('outputeraport.rekapraportkarakter', $this->listpenilaian);
    }
}
