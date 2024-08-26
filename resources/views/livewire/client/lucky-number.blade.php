<div class="container">
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="header text-center">
                    <h1>QUAY SỐ TRÚNG THƯỞNG</h1>
                </div>
                <div class="lucky-content text-center">
                    <div id="lucky" class="lucky-number" wire:ignore>000</div>
                </div>
                <div class="lucky-action text-center">
                   @if($giftCurrent)
                        <button class="btn btn-primary btn-lg" @if($isLoading) disabled="disabled" @endif id="btn-start"
                                wire:click="startLucky()">
                            <i class="ph-arrow-clockwise"></i> {{ $firstStart ? "Quay" : "Quay lại" }}
                        </button>
                    @endif
                    @if(!$isLoading && !$firstStart)
                        <button class="btn btn-success btn-lg" wire:click="saveResult({{$giftCurrent->id}})">
                            <i class="ph-arrow-circle-right"></i> Tiếp tục
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <div class="header text-center">
                    <h1>Quay lần {{ $turn }}</h1>

                </div>
                <div class="gift-content text-center">
                    {{ $giftCurrent ? \App\Helpers\Helpers::formatNumber($giftCurrent?->quantity ?? 0) : ''}}  {{ $giftCurrent ? ($giftCurrent->name . ($giftCurrent?->quantity ? "/giải": '')) : "Đã hết giải thưởng" }}
                </div>


            </div>
        </div>
    </div>
    <audio preload="auto" id="bg-sound" src="https://tbit.vn/cdn/chiec-non-ky-dieu.mov" loop />
</div>

@script
<script>
    const audio = document.getElementById("bg-sound");
    $wire.on('start-lucky', (e) => {
        $("#btn-start").prop("disabled", "disabled");
        audio.play();
        spinEffects(e[0].number)
    });

    function spinEffects(number) {
        const output = $('#lucky');
        const started = new Date().getTime();
        const duration = 1000 * 10.5;
        const animationTimer = setInterval(function () {
            if (new Date().getTime() - started > duration) {
                clearInterval(animationTimer);
                $("#btn-start").removeAttr("disabled");
                $wire.dispatch('endLoading');
                output.text('' + number);
                audio.pause();

            } else {
                output.text(
                    generateNumber()
                );
            }
        }, 10);
    }

    function generateNumber() {
        const number = Math.floor(Math.random() * 100000) + 1;
        let numberStr = '' + number;
        while (numberStr.length < 3) {
            numberStr = '0' + numberStr;
        }
        return numberStr;
    }


</script>
@endscript
