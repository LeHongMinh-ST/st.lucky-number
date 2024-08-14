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
        @foreach ($members as $member)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
                <td>{{ $member->code_id }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->scholarshipLabel }}</td>
                <td class="text-center">{{ $member->id }}</td>
                <td>{{ $member->created_at->format('H:i d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
