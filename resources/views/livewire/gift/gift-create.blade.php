<div id="create-gift" wire:ignore.self class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo giải thưởng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="name" class="col-form-label">
                            Tên giải thưởng <span class="required">*</span>
                        </label>
                        <input wire:model.live="name" type="text" id="name" {{ $name }} class="form-control">
                        @error('name')
                        <label id="error-name" class="validation-error-label text-danger"
                               for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="quantity" class="col-form-label">
                            Số lượng
                        </label>
                        <input wire:model.live="quantity" type="number" value="{{$quantity}}" id="quantity" class="form-control">
                        @error('quantity')
                        <label id="error-quantity" class="validation-error-label text-danger"
                               for="quantity">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="order" class="col-form-label">
                            Số thứ tự
                        </label>
                        <input wire:model.live="order" type="number" id="order" value="{{$order}}" class="form-control">
                        @error('order')
                        <label id="error-order" class="validation-error-label text-danger"
                               for="quantity">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link"  wire:click="closeCreateGiftModal()">Đóng</button>
                <button type="button" class="btn btn-primary" wire:click="submit()">Lưu</button>
            </div>
        </div>
    </div>
</div>

