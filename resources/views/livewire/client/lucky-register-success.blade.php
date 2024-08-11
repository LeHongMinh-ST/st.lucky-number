<div class="card">
    <div class="card-body p-md-5 p-2">
        <div class="row ">
            <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                <div class="register-image-wrapper">
                    <img class="login-image" src="{{asset('assets/images/re_success.jpg')}}" alt="login">
                    <div class="line"></div>
                    <div class="login-note text-muted">
                        Hãy nhớ chụp lại con số may mắn của mình để tham gia nhận những phần quà đặc biệt từ Học
                        viện Nông Nghiệp Việt Nam
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-register" id="capture">
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center gap-1 justify-content-center mb-4 mt-2">
                            <img src="{{asset('assets/images/VNUA.png')}}" class="h-64px" alt="">
                            <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                            {{--                                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">--}}
                        </div>
                        <span class="d-block text-muted">Vòng quay may mắn</span>
                        <h5 class="mb-0">Đăng ký thành công <i class="ph-check-circle"></i></h5>
                    </div>
                    <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                        <div class="info-general">
                            <div class="info-name">
                                <p style="font-size: 24px"> Xin chào <b style="font-size: 36px">{{ $name }}</b>
                                </p>
                                <p>Chúc mừng bạn đã đăng ký tham gia chương trình vòng quay may mắn thành
                                    công!</p>
                            </div>
                            <div class="info-other">
                                <p><b>Thông tin tham dự: </b></p>
                                <p>Ngày sinh: {{ $dob }}</p>
                                <p>CCCD/CMT: {{$code_id}}</p>
                                <p>Số điện thoại: {{ $phone }}</p>
                            </div>
                        </div>
                        <div class="info-lucky-number text-center mt-5">
                            <div class="lucky-number-title">
                                <h5>Số may mắn của bạn</h5>
                            </div>
                            <div class="lucky-number-success" id="lucky-number">
                                {{$memberId}}
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

        </div>
    </div>
</div>
@script
<script>



    $('#captureBtn').on('click', function() {
        html2canvas($('#capture')[0]).then(function(canvas) {

            var link = document.createElement('a');
            link.download = 'lucky-number.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    });
</script>
@endscript
