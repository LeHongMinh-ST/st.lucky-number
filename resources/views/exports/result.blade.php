<table class="table fs-table ">
    <thead>
    <tr class="table-light">
        <th>STT</th>
        <th  class="text-center">Mã số dự thưởng</th>
        <th>Họ và tên</th>
        <th>CCCD/CMT</th>
        <th>Số điện thoại</th>
        <th>Ngày sinh</th>
        <th>Quà</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($members as $member)
        <tr>
            <td>{{ $loop->index }}</td>
            <td class="text-center">{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->code_id }}</td>
            <td>{{ $member->phone }}</td>
            <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
            <td class="bold">{{ $member->giftResult->gift->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
