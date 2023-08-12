<?php

namespace App\Imports;

use App\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class AlumnisImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
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

    public function headingRow(): int
    {
        return 1;
    }
    public function onFailures(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->errors[] = [
                'row' => $failure->row(),
                'message' => $failure->errors()[0]
            ];
        }
    }
    public function rules(): array
    {
        return [
            'nis' => 'required|unique:alumnis,nis',
            'nama' => 'required',
            'jurusan' => 'required',
            'status' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
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
