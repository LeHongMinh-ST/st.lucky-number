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

                    <button  type="button" class="btn btn-primary btn-icon px-2" @click="$wire.openCreateModal()">
                        <i class="ph-plus-circle px-1"></i><span>Thêm mới</span>
                    </button>
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
                    <th>Tên giải thưởng</th>
                    <th>Số lượng</th>
                    <th>Số thứ tự quay</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($gifts as $gift)
                    <tr>
                        <td>{{ $loop->index + 1 + $gifts->perPage() * ($gifts->currentPage() - 1)   }}</td>
                        <td>{{ $gift->name }}</td>
                        <td>{{ $gift->quantity }}</td>
                        <td>{{ $gift->order }}</td>
                        <td>{{ $gift->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="dropdown ">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#"  wire:click="openUpdateModal({{ $gift->id }})" type="button"  class="dropdown-item">
                                        <i class="ph-note-pencil px-1"></i>
                                        Chỉnh sửa
                                    </a>
                                    <a type="button" wire:click="openDeleteModal({{ $gift->id }})" href="#" class="dropdown-item">
                                        <i class="ph-trash px-1"></i>
                                        Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-table-empty :colspan="6"/>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $gifts->links('vendor.pagination.theme') }}

    <livewire:gift.gift-create :campaignId="$campaignId" />
    <livewire:gift.gift-update  :giftId="$giftId" />

</div>
@script
<script>
    window.addEventListener('open-create-gift-modal', () => {
        $('#create-gift').modal('show')
    })
    window.addEventListener('open-update-gift-modal', () => {
        $('#update-gift').modal('show')
    })

    window.addEventListener('close-modal-create-gift', () => {
        $('#create-gift').modal('hide')
    })
    window.addEventListener('close-modal-update-gift', () => {
        $('#update-gift').modal('hide')
    })
    window.addEventListener('openDeleteGiftModal', () => {
        new swal({
            title: "Bạn có chắc chắn?",
            text: "Dữ liệu sau khi xóa không thể phục hồi!",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Đồng ý!",
            cancelButtonText: "Đóng!"
        }).then((value) => {
            if (value.isConfirmed) {
                Livewire.dispatch('deleteGift')
            }
        })
    })


</script>
@endscript
