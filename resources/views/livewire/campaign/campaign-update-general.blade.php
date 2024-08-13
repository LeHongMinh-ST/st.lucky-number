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
                        <button class="btn btn-primary" @click="$wire.update"><i class="ph-floppy-disk"></i> Cập nhật</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
