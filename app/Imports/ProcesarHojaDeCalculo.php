<?php
use Maatwebsite\Excel\Concerns\ToCollection;

class ProcesarHojaCálculo implements ToCollection
{
    public function collection($rows)
    {
        foreach ($rows as $row) {
            // procesar cada fila de datos
        }
    }
}

?>