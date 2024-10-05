<div class="register-container">
    @if ($state == 'register')
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
                                    {{--                                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt=""> --}}
                                </div>
                                <h4 class="mb-0">ĐĂNG KÝ THAM GIA HỌC BỔNG ĐỂ NHẬN NHIỀU PHẦN QUÀ HẤP DẪN</h4>
                                <span class="mb-3 d-block text-muted">Thí sinh đăng ký tham gia học bổng bằng cách điền, gửi thông tin cá nhân để nhận được mã số may mắn. Học viện sẽ tổ chức quay số trúng thưởng vào ngày nhập học và trao quà cho các thí sinh trúng thưởng</span>
                            </div>
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="name" class="col-form-label">
                                    Họ và tên <span class="required">*</span>
                                </label>
                                <input wire:model.live="name" type="text" id="name" value="{{ $name }}"
                                       class="form-control">
                                @error('name')
                                <label id="error-name" class="validation-error-label text-danger"
                                       for="name">{{ $message }}</label>
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
                            <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                                <label for="code_id" class="col-form-label">
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
                                <label for="phone" class="col-form-label">
                                    Đăng ký tham gia nhận học bổng
                                </label>
                                {{-- <input wire:model.live="phone" type="text" id="phone" value="{{ $phone }}" --}}
                                {{--       class="form-control"> --}}
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_du_hoc_nuoc_ngoai" wire:model="scholarships"
                                           id="hoc_bong_du_hoc_nuoc_ngoai">
                                    <label class="ms-2" for="hoc_bong_du_hoc_nuoc_ngoai">Học bổng du học nước
                                        ngoài</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_sinh_vien_tai_nang" wire:model="scholarships"
                                           id="hoc_bong_sinh_vien_tai_nang">
                                    <label class="ms-2" for="hoc_bong_sinh_vien_tai_nang">Học bổng sinh viên tài
                                        năng</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_toi_yeu_que_huong" wire:model="scholarships"
                                           id="hoc_bong_toi_yeu_que_huong">
                                    <label class="ms-2" for="hoc_bong_toi_yeu_que_huong">Học bổng tôi yêu quê
                                        hương</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_toi_yeu_hvn" wire:model="scholarships"
                                           id="hoc_bong_toi_yeu_hvn">
                                    <label class="ms-2" for="hoc_bong_toi_yeu_hvn">Học bổng tôi yêu HVN</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_sinh_vien_toan_cau" wire:model="scholarships"
                                           id="hoc_bong_sinh_vien_toan_cau">
                                    <label class="ms-2" for="hoc_bong_sinh_vien_toan_cau">Học bổng sinh viên toàn
                                        cầu</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_khoi_nghiep_vnua" wire:model="scholarships"
                                           id="hoc_bong_khoi_nghiep_vnua">
                                    <label class="ms-2" for="hoc_bong_khoi_nghiep_vnua">Học bổng khởi nghiệp
                                        VNUA</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_thap_sang_uoc_mo_nong_nghiep"
                                           wire:model="scholarships" id="hoc_bong_thap_sang_uoc_mo_nong_nghiep">
                                    <label class="ms-2" for="hoc_bong_thap_sang_uoc_mo_nong_nghiep">Học bổng thắp sáng
                                        ước mơ nông nghiệp</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_khuyen_khich_hoc_tap"
                                           wire:model="scholarships" id="hoc_bong_khuyen_khich_hoc_tap">
                                    <label class="ms-2" for="hoc_bong_khuyen_khich_hoc_tap">Học bổng khuyến khích học
                                        tập</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" value="hoc_bong_tai_tro_cua_doanh_nghiep"
                                           wire:model="scholarships" id="hoc_bong_tai_tro_cua_doanh_nghiep">
                                    <label class="ms-2" for="hoc_bong_tai_tro_cua_doanh_nghiep">Học bổng tài trợ của
                                        doanh nghiệp</label>
                                </div>

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
    @else
        <livewire:client.lucky-register-success memberId="{{ $memberId }}" name="{{ $name }}" code_id="{{ $code_id }}"
                                                dob="{{ $dob }}" phone="{{ $phone }}" :scholarships="$scholarships"/>
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
                Livewire.dispatch('update-dob', {
                    value: formattedDate
                })
            });
        }


    });
</script>
@endscript
