<div>
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="d-flex gap-2">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <div class="d-flex gap-2">
                <div>
                    @if(count($members)> 0)
                        <button type="button" class="btn btn-success btn-icon px-2" @click="$wire.export()">
                            <i class="ph-microsoft-excel-logo px-1"></i><span>Xuất excel</span>
                        </button>
                    @endif

{{--                    <button type="button" class="btn btn-danger btn-icon px-2" @click="$wire.$refresh">--}}
{{--                        <i class="ph-warning px-1"></i><span>Đặt lại</span>--}}
{{--                    </button>--}}
                    <button type="button" class="btn btn-light btn-icon px-2" @click="$wire.$refresh">
                        <i class="ph-arrows-clockwise px-1"></i><span>Tải lại</span>
                    </button>
                </div>

            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table fs-table ">
                <thead>
                <tr class="table-light">
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>CCCD/CMT</th>
                    <th>Số điện thoại</th>
                    <th  class="text-center">Mã số dự thưởng</th>
                    <th>Giải thưởng</th>
                </tr>
                </thead>
                <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->index + 1 + $members->perPage() * ($members->currentPage() - 1)   }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
                        <td>{{ $member->code_id }}</td>
                        <td>{{ $member->phone }}</td>
                        <td class="text-center">{{ $member->id }}</td>
                        <td class="bold">{{ $member->giftResult->gift->name }}</td>
                        {{--                        <td>{{ $member->created_at->format('d/m/Y') }}</td>--}}
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

