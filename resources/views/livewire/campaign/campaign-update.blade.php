<div>
    <div class="card card-body">
       <div class="row">
           <div class="col-md-9 col-12">
               <h6 class="fw-semibold">{{$name}}</h6>
               <p class="mb-3">Key: {{ $key }}</a></p>
               <p class="mb-3">Link đăng ký: <a href="{{ route('lucky.register', $campaignId) }}">{{ route('lucky.register', $campaignId) }}</a></p>
               <p class="mb-3">Link vòng quay: <a href="{{ route('lucky.number', $campaignId) }}">{{ route('lucky.number', $campaignId) }}</a></p>
           </div>
           <div class="col-md-3 col-12 d-flex justify-content-end">
               <a href="{{route('admin.campaigns.index')}}" type="button" class="btn btn-warning d-block" style="height: max-content"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
           </div>
       </div>


    </div>

    <div class="card card-body">

        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#js-tab1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                    Thông tin chung
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a href="#js-tab2" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    Phần thưởng
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a href="#js-tab3" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    Người chơi
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#js-tab4" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    Kết quả
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="js-tab1" role="tabpanel">
                <livewire:campaign.campaign-update-general :campaignId="$campaignId"/>
            </div>

            <div class="tab-pane fade" id="js-tab2" role="tabpanel">
                <livewire:gift.gift-index :campaignId="$campaignId" />

            </div>

            <div class="tab-pane fade" id="js-tab3" role="tabpanel">
                <livewire:member.member-index :campaignId="$campaignId" />

            </div>

            <div class="tab-pane fade" id="js-tab4" role="tabpanel">
                <livewire:result.result-index :campaignId="$campaignId" />

            </div>
        </div>
    </div>
</div>
