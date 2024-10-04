<?php

namespace App\Imports;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MemberImport implements ToCollection, WithStartRow, WithHeadingRow
{
    public function __construct(
        private string $campaignId
    )
    {
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {

                $member = Member::query()->where([
                    'code' => $row['ma_sv'],
                    'campaign_id' => $this->campaignId
                ]);

                $data = [
                    'campaign_id' => $this->campaignId,
                    'name' => $row['ho_ten'],
                    'code' => $row['ma_sv'],
                    'dob' => Carbon::make(str_replace('/', '-', $row['ngay_sinh'])),
                    'gender' => $row['gioi_tinh'] == 'Nam' ? 'male' : 'female',
                    'address' => $row['dia_chi_bao_tin'],
                    'phone' => $row['dien_thoai'],
                    'email' => $row['email'],
                    'ethnicity' => $row['dan_toc'],
                    'school_year' => $row['nien_khoa'],
                    'class' => $row['lop'],
                    'faculty' => $row['khoa'],
                ];

                if (!$member) {
                    Member::create($data);
                } else {
                    Log::alert('member', $member?->name);
                    $member->update($data);
                }

            }
            Log::alert('import success');
            DB::commit();
        } catch (\Exception $e) {
            Log::error('Error import student', [
                'message' => $e->getMessage(),
            ]);
            DB::rollBack();
            throw $e;
        }
    }

    public const START_ROW = 2;
    public const HEADER_INDEX = 1;

    public function startRow(): int
    {
        return self::START_ROW;
    }

    public function headingRow(): int
    {
        return self::HEADER_INDEX;
    }
}
