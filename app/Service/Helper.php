<?php


namespace App\Service;

class Helper {
    public static function generateDateEvent($startDate, $endDate)
    {
        $formatStartDate = $startDate->format('Y-m-d');
        $dateStartParts = explode('-', $formatStartDate);

        $formatEndDate = $endDate->format('Y-m-d');
        $dateEndParts = explode('-', $formatEndDate);

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $date =
            $dateStartParts[2] .
            ' ' .
            ($dateStartParts[1] !== $dateEndParts[1] ? $bulan[$dateStartParts[1]] : '') .
            ($dateStartParts[1] !== $dateEndParts[1] ? ' - ' . $dateEndParts[2] : '') .
            ' ' .
            $bulan[$dateEndParts[1]] .
            ' ' .
            $dateEndParts[0];

        return $date;
    }
}