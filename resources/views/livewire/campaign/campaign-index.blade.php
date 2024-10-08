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
                    <a href="{{route('admin.campaigns.create')}}" type="button" class="btn btn-primary btn-icon px-2">
                        <i class="ph-plus-circle px-1"></i><span>Thêm mới</span>
                    </a>
                </div>
                <div>
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
                    <th>Tên chiến dịch</th>
                    <th>Loại</th>
                    <th>Key</th>
                    <th>Link vòng quay</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($campaigns as $campaign)
                    <tr>
                        <td>{{ $loop->index + 1 + $campaigns->perPage() * ($campaigns->currentPage() - 1)   }}</td>
                        <td><a href="{{route('admin.campaigns.edit', $campaign->id)}}">{{ $campaign->name }}</a></td>
                        <td><span class="badge @if($campaign->type === \App\Enums\CampaignType::News) bg-success @else bg-info @endif ">
                                {{ \App\Enums\CampaignType::getDescription($campaign->type) }}
                            </span></td>
                        <td>{{ $campaign->key }}</td>
                        <td><a target="_blank" href="{{ route('lucky.number', ['campaign_id' => $campaign->id]) }}">{{ route('lucky.number', ['campaign_id' => $campaign->id]) }}</a></td>
                        <td>{{ $campaign->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="dropdown ">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{route('admin.campaigns.edit', $campaign->id)}}" class="dropdown-item">
                                        <i class="ph-note-pencil px-1"></i>
                                        Chỉnh sửa
                                    </a>
                                    <a type="button" @click="$wire.openDeleteModal({{ $campaign->id }})" class="dropdown-item">
                                        <i class="ph-trash px-1"></i>
                                        Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-table-empty :colspan="4"/>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $campaigns->links('vendor.pagination.theme') }}
</div>
