<div class="card">
    <div class="card-body p-md-5 p-2">
        <div class="row ">
            <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
                <div class="register-image-wrapper">
                    <img class="login-image" src="{{asset('assets/images/re_success.jpg')}}" alt="login">
                    <div class="line"></div>
                    <div class="login-note text-danger">
                        <i>Lưu ý: Hãy nhớ chụp lại ảnh mã số may mắn trên màn hình hoặc tải về máy ảnh mã số may mắn của mình để tham gia nhận những phần quà đặc biệt từ Học
                            viện Nông Nghiệp Việt Nam</i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-register" id="capture">
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center gap-1 justify-content-center mb-4 mt-2">
                            <a href="https://vnua.edu.vn">
                                <img src="{{ asset('assets/images/VNUA.png') }}" class="h-64px" alt="">
                            </a>
                            {{--                                <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">--}}
                        </div>
                        <h5 class="mb-3">CHƯƠNG TRÌNH HỌC BỔNG NĂM 2024</h5>
                        <h5 class=" mb-3">Đăng ký thành công <i class="ph-check-circle"></i></h5>

                    </div>
                    <div class="mb-2 ps-2 pe-2 ps-md-3 pe-md-3 ps-lg-5 pe-lg-5">
                        <div class="info-general">
                            <div class="info-name">
                                <p style="font-size: 24px"> Xin chào bạn <b style="font-size: 36px">{{ $name }}</b>
                                </p>
                                <p>Cám ơn bạn đã đăng ký tham gia chương trình học bổng năm 2024 của Học viện Nông nghiệp Việt Nam!
                                    <br> Dưới đây là thông tin đăng ký và mã số may mắn của bạn:</p>
                            </div>
                            <div class="info-other">
                                <p>Ngày sinh: {{ $dob }}</p>
                                <p>CCCD/CMT: {{$code_id}}</p>
                                <p>Số điện thoại: {{ $phone }}</p>
                                <p>Các chương trình học bổng đã đăng ký:
                                @foreach($scholarships as $item)
                                    {{$scholarshipsLabel[$item]}}
                                        @if(!$loop->last)
                                            ,
                                        @endif
                                @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="info-lucky-number text-center mt-5">
                            <div class="lucky-number-title">
                                <h5>Mã số may mắn của bạn</h5>
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
