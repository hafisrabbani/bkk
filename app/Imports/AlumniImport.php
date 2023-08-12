<?php

namespace App\Imports;

use App\Alumni;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class AlumniImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $row = 0;
    private $lulusan;
    public function lulusan($params)
    {
        return $this->lulusan = $params;
    }
    public function model(array $row)
    {
        ++$this->row;
        return new Alumni([
            'nis' => $row['nis'],
            'name' => $row['nama'],
            'jurusan' => $row['jurusan'],
            'status' => (string) $row['status'],
            'instansi' => $row['instansi'],
            'posisi' => $row['jabatan'],
            'lulusan' => $this->lulusan
        ]);
    }

    public function onError(Throwable $e)
    {
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|unique:alumni,nis',
            'name' => 'required',
            'jurusan' => 'required',
            'status' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'nis.unique' => 'NIS sudah terdaftar',
        ];
    }

    public function getRows()
    {
        return $this->row;
    }
}
