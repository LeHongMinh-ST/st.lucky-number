<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin chung
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
                <div class="mt-2 row">
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

                <div class="mt-2 row">
                    <div class="col">
                        <button class="btn btn-primary" @click="$wire.update"><i class="ph-floppy-disk"></i> Cập nhật</button>

                    </div>
                </div>
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
