<?php

namespace App\Service;

class SimpleCalculator
{
    public function getCalculationResult($data): ?float
    {
        if (is_numeric($data['number1']) && is_numeric($data['number2'])) {
            if ($data['operation'] == 'Plus') {
                $total = $data['number1'] + $data['number2'];
            }
            if ($data['operation'] == 'Minus') {
                $total = $data['number1'] - $data['number2'];
            }
            if ($data['operation'] == 'Times') {
                $total = $data['number1'] * $data['number2'];
            }
            if ($data['operation'] == 'Divided By') {
                $total = $data['number1'] / $data['number2'];
            }
        }

        return $total ?? null;
    }
}