<x-client-layout>
    <div class="content register-container">

        <form action="{{ route('lucky.handleCheckKey', ['campaign_id' => $campaignId]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="card p-3 ">
                        <label for="name" class="col-form-label col-form-label-lg">
                            Key
                        </label>
                        <input name="key" type="text" id="name" class="form-control form-control-lg">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit"  class="btn btn-success">Gửi</button>
                </div>
            </div>
        </form>
    </div>
</x-client-layout>
