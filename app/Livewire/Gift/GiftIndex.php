<?php

namespace App\Livewire\Gift;

use App\Common\Constants;
use App\Models\Gift;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GiftIndex extends Component
{

    public string $campaignId = '';

    public string $giftId = '';

    public string $search = '';

    protected $listeners = [
        'refresh-gift' => '$refresh',
        'deleteGift' => 'destroy'
    ];

    public function render()
    {
        $gifts = Gift::query()->orderBy('order')
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.gift.gift-index', [
            'gifts' => $gifts
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function openCreateModal()
    {
        $this->dispatch('open-create-gift-modal');
    }

    public function openUpdateModal($id)
    {
        $this->giftId = $id;
        $this->dispatch('open-update-gift-modal', ['giftId' => $id]);
    }

    public function openDeleteModal($id): void
    {
        $this->giftId = $id;
        $this->dispatch('openDeleteGiftModal');
    }

    public function destroy(): void
    {
        try {
            Gift::destroy($this->giftId);
            $this->dispatch('alert', type: 'success', message: 'Xóa thành công!');
            $this->dispatch('$refresh');
        } catch (Exception $e) {
            Log::error('Error delete gift', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
            $this->dispatch('alert', type: 'error', message: 'Xóa thất bại!');
        }
    }
}
