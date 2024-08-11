<div class="register-container ">
    @if($state == 'register')
        <div class="card">
            <div class="card-body p-md-5 p-2">
                <div class="row flex-md-row-reverse">

                    <div class="col-md-6 col-12">
                        <div class="form-register">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex align-items-center gap-1 justify-content-center mb-4 mt-2">
                                    <img src="{{asset('assets/images/VNUA.png')}}" class="h-64px" alt="">
                                    {{--                                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">--}}
                                </div>
                                <span class="d-block text-muted mb-3">CHƯƠNG TRÌNH VÒNG QUAY MAY MẮN</span>
                                <h4 class="mb-0">Thí sinh điền, gửi thông tin cá nhân để nhận được mã số may mắn</h4>
                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="name" class="col-form-label ">
                                    Họ và tên <span class="required">*</span>
                                </label>
                                <input wire:model.live="name" type="text" id="name" value="{{ $name }}"
                                       class="form-control ">
                                @error('name')
                                <label id="error-name" class="validation-error-label text-danger"
                                       for="name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="dob" class="col-form-label ">
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
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="code_id" class="col-form-label ">
                                    Số căn cước công dân/chứng minh nhân dân <span class="required">*</span>
                                </label>
                                <input wire:model.live="code_id" type="text" id="code_id" value="{{ $code_id }}"
                                       class="form-control">
                                @error('code_id')
                                <label id="error-code_id" class="validation-error-label text-danger"
                                       for="code_id">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="phone" class="col-form-label ">
                                    Số điện thoại <span class="required">*</span>
                                </label>
                                <input wire:model.live="phone" type="text" id="phone" value="{{ $phone }}"
                                       class="form-control">
                                @error('phone')
                                <label id="error-name" class="validation-error-label text-danger"
                                       for="phone">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mt-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" @click="$wire.submit()">
                                    <i class="ph-telegram-logo"></i>
                                    Gửi
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                        <div class="register-image-wrapper">
                            <img class="login-image" src="{{asset('assets/images/login.jpg')}}" alt="login">
                            <div class="line"></div>
                            <div class="login-note text-muted">
                                Đăng ký nhận mã số may mắn để nhận những phần quà hấp dẫn từ <br> Học viện Nông nghiệp Việt
                                Nam
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <livewire:client.lucky-register-success  memberId="{{$memberId}}" name="{{$name}}" code_id="{{$code_id}}" dob="{{$dob}}" phone="{{$phone}}" />
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
