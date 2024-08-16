<div class="register-container">
    <div class="card">
        <div class="p-2 card-body p-md-5">
            <div class="row">
                <div class="mb-3 text-center">
                    <div class="gap-1 mt-2 mb-4 d-inline-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">
                    </div>
                    <h4 class="mb-0">TRA CỨU MÃ SỐ MAY MẮN</h4>
                    <span class="mb-3 d-block text-muted">Trong chương trình đăng ký tham gia học bổng để nhận nhiều phần quà hấp dẫn</span>
                    <div class="line" style="margin: 10px auto 20px; background: #e5e5e5; width: 50% ;height: 1px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 col-12 flex-column">
                    <div class="form-register">
                        <div class="mb-3 text-center">
                            <h5 class="mb-3 border-black d-block">Thông tin tra cứu</h5>
                        </div>
                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <label for="code_id" class="col-form-label">
                                Số căn cước công dân/chứng minh nhân dân <span class="required">*</span>
                            </label>
                            <input wire:model.live="code_id" type="text" id="code_id"
                                   class="form-control">
                            @error('code_id')
                                <label id="error-code_id" class="validation-error-label text-danger"
                                       for="code_id">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                            <label for="phone" class="col-form-label">
                                Số điện thoại <span class="required">*</span>
                            </label>
                            <input wire:model.live="phone" type="text" id="phone" value="{{ $phone }}"
                                   class="form-control">
                            @error('phone')
                                <label id="error-name" class="validation-error-label text-danger"
                                       for="phone">{{ $message }}</label>
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
                        <div class="mt-3 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 d-flex justify-content-between">
                            <a href="{{ route('lucky.register', ['campaign_id' => $campaignId]) }}" class="btn btn-warning">
                                <i class="search-logo"></i>
                                Đăng ký
                            </a>
                            <button type="button" class="btn btn-primary" @click="$wire.submit()">
                                <i class="ph-magnifying-glass"></i>
                                Tra cứu
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                    @if (is_null($member))
                        <div class="register-image-wrapper">
                            <img class="login-image" src="{{ asset('assets/images/search.jpg') }}" alt="login">
                            <div class="line"></div>
                        </div>
                    @else
                        <div class="col-md-6 col-12 w-100">
                            <div class="mb-3 text-center">
                                <h5 class="mb-3">Kết quả tra cứu</h5>
                            </div>
                            <div class="form-register" id="capture">
                                <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                    <div class="info-general">
                                        <div class="info-other">
                                            <p><b>Họ tên:</b> {{ $member->name }}</p>
                                            <p><b>Ngày sinh:</b> {{ $dobFormat }}</p>
                                            <p><b>CCCD/CMT:</b> {{ $member->code_id }}</p>
                                            <p><b>Số điện thoại:</b> {{ $member->phone }}</p>
                                            <p><b>Các chương trình học bổng đã đăng ký:</b>
                                                @foreach ($member->scholarships ?? [] as $item)
                                                    {{ $scholarshipsLabel[$item] }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-center info-lucky-number">
                                        <div class="lucky-number-title">
                                            <h6>Mã số may mắn của bạn</h6>
                                        </div>
                                        <div class="lucky-number-success" id="lucky-number">
                                            {{ $member->id }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5 d-flex justify-content-center">
                                <button type="button" class="btn btn-success" id="captureBtn">
                                    <i class="ph-download"></i>
                                    Tải ảnh
                                </button>
                            </div>
                        </div>
                        @script
                            <script>
                                $(document).ready(function() {
                                    $(document).on("click","#captureBtn",function() {
                                        html2canvas($('#capture')[0]).then(function(canvas) {
                                            var link = document.createElement('a');
                                            link.download = 'lucky-number.png';
                                            link.href = canvas.toDataURL();
                                            link.click();
                                        });
                                    });
                                });
                            </script>
                        @endscript
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $(document).ready(function() {
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
                dpBasicElementStartDate.addEventListener('changeDate', function(event) {
                    const selectedDate = new Date(event.detail.date);
                    const formattedDate = formatDateToString(selectedDate);
                    Livewire.dispatch('update-dob', {
                        value: formattedDate
                    })
                });
            }
        });
    </script>
@endscript
