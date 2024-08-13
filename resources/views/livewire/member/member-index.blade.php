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
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>CCCD/CMT</th>
                        <th>Số điện thoại</th>
                        <th>Học bổng đăng ký</th>
                        <th class="text-center">Mã số may mắn</th>
                        <th class="text-center">Ngày đăng ký</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>{{ $loop->index + 1 + $members->perPage() * ($members->currentPage() - 1) }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>

                            <td>{{ $member->code_id }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->scholarshipLabel }}</td>
                            <td class="text-center">{{ $member->id }}</td>
                            <td>{{ $member->created_at->format('H:m d/m/Y') }}</td>

                        </tr>
                    @empty
                        <x-table-empty :colspan="8" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $members->links('vendor.pagination.theme') }}


</div>
