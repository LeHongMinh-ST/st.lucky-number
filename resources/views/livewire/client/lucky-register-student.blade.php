<div class="register-container">
    @if ($state == 'search')
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
                                    <a href="http://st-dse.vnua.edu.vn">
                                        <img src="{{ asset('assets/images/logoST.jpg') }}" class="h-64px" alt="">
                                    </a>
                                </div>
                                <h4 class="mb-0">Chương trình quay số may mắn</h4>
                                <span class="mb-3 d-block text-muted">Sinh viên đăng ký tham gia quay thưởng bằng cách điền, gửi thông tin cá nhân để nhận được mã số may mắn. Khoa sẽ tổ chức quay số trúng thưởng và trao quà cho các thí sinh trúng thưởng</span>
                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="name" class="col-form-label">
                                    Mã sinh viên<span class="required">*</span>
                                </label>
                                <input wire:model.live="code" type="text" id="name" value="{{ $code }}"
                                       class="form-control">
                                @error('code')
                                <label id="error-code" class="validation-error-label text-danger"
                                       for="code">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="dob" class="col-form-label">
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

                            <div class="mt-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 d-flex justify-content-end">
                                <button wire:loading wire:target="check" type="button" class="btn btn-primary">
                                    <i class="ph-circle-notch spinner"></i>
                                    Kiểm tra
                                </button>
                                <button wire:loading.remove type="button" class="btn btn-primary" wire:click="check()">
                                    <i class="ph-telegram-logo"></i>
                                    Đăng nhập
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                        <div class="register-image-wrapper">
                            <img class="login-image" src="{{ asset('assets/images/login.jpg') }}" alt="login">
                            <div class="line"></div>
                            {{-- <div class="login-note text-muted"> --}}
                            {{--    Đăng ký nhận mã số may mắn để nhận những phần quà hấp dẫn từ <br> Học viện Nông nghiệp Việt --}}
                            {{--    Nam --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($state == 'register')
        <livewire:client.lucky-register-student-update :code="$code" :campaignId="$campaignId"/>
    @else
        <livewire:client.lucky-register-student-success :code="$code" :campaignId="$campaignId"/>
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
                if (event.detail.date) {
                    const formattedDate = formatDateToString(selectedDate);
                    Livewire.dispatch('update-dob', {
                        value: formattedDate
                    })
                }
            });
        }
    });
</script>
@endscript
