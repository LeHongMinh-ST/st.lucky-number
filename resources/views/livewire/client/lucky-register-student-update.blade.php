<div class="card">
    <div class="p-2 card-body p-md-5">
        <div class="row flex-md-row-reverse">

            <div class="col-md-6 col-12">
                <div class="form-register">
                    <div class="mb-3 text-center">
                        <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                            <a href="https://vnua.edu.vn">
                                <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">
                            </a>
                            <a href="https://fita.vnua.edu.vn">
                                <img src="{{ asset('assets/images/FITA.png') }}" class="h-64px" alt="">
                            </a>
                            <a href="https://fita.vnua.edu.vn">
                                <img src="{{ asset('assets/images/logoST.jpg') }}" class="h-64px" alt="">
                            </a>
                        </div>
                        <h3 class="mb-0">Chương trình quay số may mắn</h3>
                        <span class="mb-3 d-block text-muted">Sinh viên đăng ký tham gia quay thưởng bằng cách điền, gửi thông tin cá nhân để nhận được mã số may mắn. Khoa sẽ tổ chức quay số trúng thưởng và trao quà cho các thí sinh trúng thưởng</span>
                    </div>
                    <div class="mb-3">
                        <h6>
                            {{ $member->name }} - {{ $member->code }} <br>
                            Lớp {{ $member->class }} - Khoa {{ $member->faculty }}
                        </h6>
                    </div>

                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                            Căn cước công dân<span class="required">*</span>
                        </label>
                        <input wire:model.live="code_id" type="text" id="code_id"
                               class="form-control">
                        @error('code_id')
                        <label id="error-code_id" class="validation-error-label text-danger"
                               for="code_id">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                           Email<span class="required">*</span>
                        </label>
                        <input wire:model.live="email" type="text" id="email"
                               class="form-control">
                        @error('email')
                        <label id="error-email" class="validation-error-label text-danger"
                               for="email">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                            Số điện thoại<span class="required">*</span>
                        </label>
                        <input wire:model.live="phone" type="text" id="phone"
                               class="form-control">
                        @error('phone')
                        <label id="error-phone" class="validation-error-label text-danger"
                               for="phone">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                            Địa chỉ nhà<span class="required">*</span>
                        </label>
                        <input wire:model.live="address" type="text" id="address"
                               class="form-control">
                        @error('address')
                        <label id="error-address" class="validation-error-label text-danger"
                               for="address">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                            Phụ huynh <span class="required">*</span>
                        </label>
                        <input wire:model.live="family" type="text" id="family"
                               class="form-control">
                        @error('family')
                        <label id="error-family" class="validation-error-label text-danger"
                               for="family">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                            Số điện thoại liên hệ phụ huynh <span class="required">*</span>
                        </label>
                        <input wire:model.live="family_phone" type="text" id="family_phone"
                               class="form-control">
                        @error('family_phone')
                        <label id="error-family" class="validation-error-label text-danger"
                               for="family_phone">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="col-form-label">
                             Phòng ký túc xá @if(!$is_inn) <span class="required">*</span> @endif
                        </label>
                        <input wire:model.live="address_now" type="text" id="address_now"
                               class="form-control">
                        @error('address_now')
                        <label id="error-address_now" class="validation-error-label text-danger"
                               for="address_now">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="phone" class="col-form-label">
                            Có ở trọ không ?
                        </label>
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input"  @if($is_inn) checked @endif  wire:model.live="is_inn" id="is_inn">
                            <label class="form-check-label" for="is_inn">@if($is_inn) Có @else Không @endif</label>
                        </div>
                    </div>

                    @if($is_inn)
                        <div class="mb-2">
                            <label for="name" class="col-form-label">
                                Họ tên chủ trọ <span class="required">*</span>
                            </label>
                            <input wire:model.live="inn_owner" type="text" id="inn_owner"
                                   class="form-control">
                            @error('inn_owner')
                            <label id="error-inn_owner" class="validation-error-label text-danger"
                                   for="inn_owner">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="name" class="col-form-label">
                                Số điện thoại chủ trọ <span class="required">*</span>
                            </label>
                            <input wire:model.live="inn_owner_phone" type="text" id="inn_owner_phone"
                                   class="form-control">
                            @error('inn_owner_phone')
                            <label id="error-inn_owner_phone" class="validation-error-label text-danger"
                                   for="inn_owner_phone">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="name" class="col-form-label">
                                Địa chỉ trọ <span class="required">*</span>
                            </label>
                            <input wire:model.live="inn_owner_address" type="text" id="inn_owner_address"
                                   class="form-control">
                            @error('inn_owner_address')
                            <label id="error-inn_owner_address" class="validation-error-label text-danger"
                                   for="inn_owner_address">{{ $message }}</label>
                            @enderror
                        </div>

                    @endif



                    <div class="mt-3  d-flex justify-content-end">
                        <button wire:loading wire:target="update" type="button" class="btn btn-primary">
                            <i class="ph-circle-notch spinner"></i>
                            @if($member?->is_register) Cập nhật @else Đăng ký @endif
                        </button>
                        <button wire:loading.remove type="button" class="btn btn-primary" wire:click="update()">
                            <i class="ph-telegram-logo"></i>
                            @if($member?->is_register) Cập nhật @else Đăng ký @endif
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                <div class="register-image-wrapper">
                    <img class="login-image" src="{{ asset('assets/images/login.jpg') }}" alt="login">
                    <div class="line"></div>
                     <div class="login-note text-muted">
                        Lưu ý: Thông tin sinh viên cần phải chính xác, các sinh viên nhập thông tin sai sẽ không được nhận quà.
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
