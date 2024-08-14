<div class="home-page">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <label for="name" class="col-form-label">
                Trang chủ
            </label>
            <select class="form-control" wire:model.live="campaignIdSelected">
                <option value="0">Chọn trang tra cứu</option>
                @foreach ($campaigns as $campaign)
                    <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
