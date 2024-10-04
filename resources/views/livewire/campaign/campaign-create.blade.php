<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin chiến dịch
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="name" class="col-form-label">
                            Tên chiến dịch <span class="required">*</span>
                        </label>
                        <input wire:model.live="name" type="text" id="name" class="form-control">
                        @error('name')
                        <label id="error-name" class="validation-error-label text-danger"
                               for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header bold">
                <i class="ph-clock"></i>
                Thời gian
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="title" class="col-form-label">
                            Ngày kết kúc <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="end" type="text" id="endDate" value="{{ $this->end }}"
                                   class="form-control datepicker-basic datepicker-input ">
                        </div>
                        @error('end')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bold">
                <i class="ph-file"></i>
                Loại
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="title" class="col-form-label">
                            Loại vòng quay <span class="required">*</span>
                        </label>
                        <select class="form-control" wire:model="type">
                            @foreach (\App\Enums\CampaignType::cases() as $campaign)
                                <option value="{{ $campaign->value }}">{{ \App\Enums\CampaignType::getDescription($campaign) }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <label id="error-type" class="validation-error-label text-danger"
                               for="type">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button class="btn btn-primary" @click="$wire.submit"><i class="ph-floppy-disk"></i> Lưu</button>
                <a href="{{route('admin.campaigns.index')}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementEndDate = document.querySelector('#endDate');
        if (dpBasicElementEndDate) {
            new Datepicker(dpBasicElementEndDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementEndDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-end-date', { value: formattedDate })
            });
        }

    });
</script>
@endscript

