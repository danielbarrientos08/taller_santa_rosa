<?php

namespace App\Imports;

use App\Models\Estudiante;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstudianteImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $key => $row)
        {

            // $oldDate =  \DateTime::createFromFormat('d/m/Y',trim($row['fecha_nacimiento']));

            // $newDate = $oldDate->format('Y-m-d');

            $estudiante = new Estudiante();
            $estudiante->documento= trim($row['documento']);
            $estudiante->apellido_paterno= trim($row['apellido_paterno']);
            $estudiante->apellido_materno= trim($row['apellido_materno']);
            $estudiante->nombres= trim($row['nombres']);
            $estudiante->fecha_nacimiento= null;
            $estudiante->nivel= trim($row['nivel']);
            $estudiante->grado= trim($row['grado']);
            $estudiante->seccion= trim($row['seccion']);
            $estudiante->save();

        }
    }
}
