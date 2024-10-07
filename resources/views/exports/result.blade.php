<table class="table fs-table ">
    <thead>
    <tr class="table-light">
        <th>STT</th>
        <th>Họ và tên</th>
        <th>Mã sinh viên</th>
        <th>Ngày sinh</th>
        <th>CCCD/CMT</th>
        <th>Số điện thoại</th>
        <th  class="text-center">Mã số may mắn</th>

        <th>Giải thưởng</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($members as $member)
        <tr>
            <td>{{ $loop->index + 1}}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member?->code ?? '' }}</td>
            <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
            <td>{{ $member->code_id }}</td>
            <td>{{ $member->phone }}</td>
            <td class="text-center">{{ $member->id }}</td>
            <td class="bold">{{ $member->giftResult->gift->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
