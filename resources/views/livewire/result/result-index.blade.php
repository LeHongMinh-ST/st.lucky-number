<div>
    <div class="card">
        <div class="py-3 card-header d-flex justify-content-between">
            <div class="gap-2 d-flex">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <div class="gap-2 d-flex">
                <div>
                    @if (count($members) > 0)
                        <button type="button" class="px-2 btn btn-success btn-icon" @click="$wire.export()">
                            <i class="px-1 ph-microsoft-excel-logo"></i><span>Xuất excel</span>
                        </button>

                        <button type="button" class="px-2 btn btn-danger btn-icon" @click="$wire.openResetResultModal()">
                            <i class="px-1 ph-warning"></i><span>Đặt lại</span>
                        </button>
                    @endif
                    <button type="button" class="px-2 btn btn-light btn-icon" @click="$wire.$refresh">
                        <i class="px-1 ph-arrows-clockwise"></i><span>Tải lại</span>
                    </button>
                </div>

            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table">
                <thead>
                <tr class="table-light">
                    <th>STT</th>
                    @if($campaign?->type == \App\Enums\CampaignType::Students)
                        <th>Mã sinh viên</th>
                    @endif
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    @if($campaign?->type == \App\Enums\CampaignType::Students)
                        <th>Lớp</th>
                    @endif
                    <th>CCCD/CMT</th>
                    <th>Số điện thoại</th>
                    @if($campaign->type == \App\Enums\CampaignType::Students)
                        <th>Email</th>
                        <th>Số điện thoaại phụ huynh</th>
                    @endif
                    <th class="text-center">Mã số may mắn</th>
                    <th>Giải thưởng</th>
                </tr>
                </thead>
                <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->index + 1 + $members->perPage() * ($members->currentPage() - 1) }}</td>
                        @if($campaign?->type == \App\Enums\CampaignType::Students)
                            <td>{{ $member?->code }}</td>
                        @endif
                        <td>{{ $member->name }}</td>
                        <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
                        @if($campaign->type == \App\Enums\CampaignType::Students)
                            <td>{{ $member->class }}</td>
                        @endif
                        <td>{{ $member->code_id }}</td>
                        <td>{{ $member->phone }}</td>
                        @if($campaign->type == \App\Enums\CampaignType::Students)
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->family_phone }}</td>
                        @endif
                        <td class="text-center">{{ $member->id }}</td>
                        <td class="bold">{{ $member->giftResult->gift->name }}</td>
                        {{--                        <td>{{ $member->created_at->format('d/m/Y') }}</td> --}}
                    </tr>
                @empty
                    <x-table-empty :colspan="7"/>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $members->links('vendor.pagination.theme') }}

</div>
@script
<script>

    window.addEventListener('openResetResultModal', () => {
        new swal({
            title: "Bạn có chắc chắn?",
            text: "Dữ liệu sau khi đặt lại không thể phục hồi!",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Đồng ý!",
            cancelButtonText: "Đóng!"
        }).then((value) => {
            if (value.isConfirmed) {
                Livewire.dispatch('resetResult')
            }
        })
    })


</script>
@endscript
