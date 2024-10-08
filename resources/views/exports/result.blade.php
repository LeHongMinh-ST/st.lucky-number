<table class="table fs-table ">
    <thead>
    <tr class="table-light">
        <th>STT</th>
        @if($campaign->type == \App\Enums\CampaignType::Students)
            <th>Mã sinh viên</th>
        @endif
        <th>Họ và tên</th>
        <th>Ngày sinh</th>
        @if($campaign->type == \App\Enums\CampaignType::Students)
            <th>Lớp</th>
        @endif
        <th>CCCD/CMT</th>
        <th>Số điện thoại</th>
        @if($campaign->type == \App\Enums\CampaignType::Students)
            <th>Email</th>
            <th>Số điện thoaại phụ huynh</th>
        @endif
        <th  class="text-center">Mã số may mắn</th>
        <th>Giải thưởng</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($members as $member)
        <tr>
            <td>{{ $loop->index + 1}}</td>
            @if($campaign->type == \App\Enums\CampaignType::Students)
                <td>{{ $member?->code ?? '' }}</td>
            @endif
            <td>{{ $member->name }}</td>
            @if($campaign->type == \App\Enums\CampaignType::Students)
                <td>{{ $member->class }}</td>
            @endif
            <td>{{ \Carbon\Carbon::make($member->dob)->format('d/m/Y') }}</td>
            <td>{{ $member->code_id }}</td>
            <td>{{ $member->phone }}</td>
            @if($campaign->type == \App\Enums\CampaignType::Students)
                <td>{{ $member->email }}</td>
                <td>{{ $member->family_phone }}</td>
            @endif
            <td class="text-center">{{ $member->id }}</td>
            <td class="bold">{{ $member->giftResult->gift->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
