<div class="register-container">
    @if($state == 'register')
        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <div class="d-flex gap-2">
                        <img src="{{asset('assets/images/login.jpg')}}" class="w-80px" alt="">
                        <h3>Thí sinh điền thông tin tham gia Vòng quay may mắn </h3>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <label for="name" class="col-form-label col-form-label-lg">
                        Họ và tên <span class="required">*</span>
                    </label>
                    <input wire:model.live="name" type="text" id="name" value="{{ $name }}" class="form-control form-control-lg">
                    @error('name')
                    <label id="error-name" class="validation-error-label text-danger"
                           for="name">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <label for="dob" class="col-form-label col-form-label-lg">
                        Ngày sinh <span class="required">*</span>
                    </label>
                    <div class="input-group">
                    <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                        <input wire:model="dob" type="text" id="dob" value="{{ $this->dob }}"
                               class="form-control datepicker-basic datepicker-input">
                    </div>

                    @error('dob')
                    <label id="error-dob" class="validation-error-label text-danger"
                           for="dob">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <label for="code_id" class="col-form-label col-form-label-lg">
                        CCCD/CMT <span class="required">*</span>
                    </label>
                    <input wire:model.live="code_id" type="text" id="code_id" value="{{ $code_id }}" class="form-control form-control-lg">
                    @error('code_id')
                    <label id="error-code_id" class="validation-error-label text-danger"
                           for="code_id">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <label for="phone" class="col-form-label col-form-label-lg">
                        Số điện thoại <span class="required">*</span>
                    </label>
                    <input wire:model.live="phone" type="text" id="phone" value="{{ $phone }}" class="form-control  form-control-lg">
                    @error('phone')
                    <label id="error-name" class="validation-error-label text-danger"
                           for="phone">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary" @click="$wire.submit()">Gửi</button>

            </div>
        </div>
    @elseif($state == 'success')
        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{asset('assets/images/login.jpg')}}" class="w-80px" alt="">
                        <h3>Đăng ký thành công </h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <div class="d-flex gap-2">
                        <h3>Mã số may mắn của bạn là: {{ $memberId }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{asset('assets/images/login.jpg')}}" class="w-80px" alt="">
                        <h3>Bạn đã đăng ký tham gia chương trình vòng quay mắn</h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="card p-3 ">
                    <div class="d-flex gap-2">
                        <h3>Mã số may mắn của bạn là: {{ $memberId }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementStartDate = document.querySelector('#dob');
        if (dpBasicElementStartDate) {
            new Datepicker(dpBasicElementStartDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementStartDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-dob', { value: formattedDate })
            });
        }



    });
</script>
@endscript
