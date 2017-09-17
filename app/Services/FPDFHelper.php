<?php

namespace App\Services;

use Fpdf;

class FPDFHelper
{
    public static function showPDFStatistic($fpdfData)
    {
        $pdf = new Fpdf();
        $pdf::Ln();
        $pdf::AddPage();
        $pdf::SetFont('Times','',16);
        $pdf::Cell(0,10, $fpdfData['info'], 0,"","C");
        if ($fpdfData['status'] == '2') {
            $pdf::Image($fpdfData['img'],150,20,50);
            $pdf::Ln();
            $pdf::SetFont('Times','',12);
            foreach ($fpdfData['user_Array'] as $stat => $value) {
                $pdf::SetFillColor(230,230,230);
                $pdf::cell(100,10,$stat,1,0,"L", TRUE);
                $pdf::cell(30,10,$value,1,0,"L", TRUE);
                $pdf::Ln();
            }
        }
        $pdf::Output();
    }
}
