<x-client-layout>
    <div class="content d-flex justify-content-center align-items-center">

        @if($campaign->type == \App\Enums\CampaignType::News)
            <livewire:client.lucky-register  campaignId="{{$campaign->id}}" />

        @else
            <livewire:client.lucky-register-student  campaignId="{{$campaign->id}}" />
        @endif

    </div>
</x-client-layout>
