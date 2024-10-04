<?php

namespace App\Livewire\Member;

use App\Jobs\MemberImportJob;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class MemberImport extends Component
{
    use WithFileUploads;

    public $file;

    public string|int $campaignId;

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }


    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimes:xlsx,xls',
            ],

        ];
    }

    public function render()
    {
        return view('livewire.member.member-import');
    }

    public function closeImportModal()
    {
        $this->dispatch('close-import-modal');
    }

    public function submit()
    {
        $this->validate();

        try {
            MemberImportJob::dispatch($this->campaignId, $this->file)->onQueue('default');
//            Excel::import(new \App\Imports\MemberImport($this->campaignId), $this->file);

            $this->dispatch('alert', type: 'success', message: 'Import thành công! Hệ thống đang xử lý tệp của bạn');
            $this->closeImportModal();
            $this->dispatch('refresh-student');
        }catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Import thất bại!');
        }
    }
}
