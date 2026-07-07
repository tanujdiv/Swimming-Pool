@extends('layouts.admin')

@section('content')

<div class="settings-box">
    <h2 class="mb-4">Pool Settings</h2>

    <form method="POST" action="{{ route('setting.store') }}">
        @csrf

        <label class="form-label">Pool Name</label>
        <input class="form-control mb-3" name="name" value="{{ $pool->name ?? '' }}" placeholder="Enter Pool Name">

        <label class="form-label">Pool Type</label>
        <input class="form-control mb-3" name="type" value="{{ $pool->type ?? '' }}" placeholder="Indoor / Outdoor">

        <label class="form-label">Pool Length (ft / m)</label>
        <input class="form-control mb-3" name="length" value="{{ $pool->length ?? '' }}" placeholder="Enter Length">

        <label class="form-label">Pool Width (ft / m)</label>
        <input class="form-control mb-3" name="width" value="{{ $pool->width ?? '' }}" placeholder="Enter Width">

        <label class="form-label">Minimum Depth</label>
        <input class="form-control mb-3" name="min_depth" value="{{ $pool->min_depth ?? '' }}" placeholder="Example: 3 ft">

        <label class="form-label">Maximum Depth</label>
        <input class="form-control mb-3" name="max_depth" value="{{ $pool->max_depth ?? '' }}" placeholder="Example: 8 ft">

        <label class="form-label">Pool Capacity</label>
        <input class="form-control mb-3" name="capacity" value="{{ $pool->capacity ?? 50 }}" placeholder="Maximum People">

        <label class="form-label">Pool Description</label>
        <textarea class="form-control mb-3" name="description" placeholder="Describe pool...">{{ $pool->description ?? '' }}</textarea>

        <label class="form-label">Pool Rules</label>
        <textarea class="form-control mb-3" name="rules" placeholder="Enter rules...">{{ $pool->rules ?? '' }}</textarea>

        <hr class="my-4">

        <h4 class="mb-3">Pricing Settings</h4>

        <label class="form-label">Adult Price / Hour (₹)</label>
        <input class="form-control mb-3" name="adult_price" value="{{ $setting->adult_price ?? 200 }}">

        <label class="form-label">Child Price / Hour (₹)</label>
        <input class="form-control mb-3" name="child_price" value="{{ $setting->child_price ?? 120 }}">

        <label class="form-label">Full Pool Price (₹)</label>
        <input class="form-control mb-3" name="full_pool_price" value="{{ $setting->full_pool_price ?? 8000 }}">

        <hr class="my-4">


    <h4 class="mb-4">
        Payment Settings
    </h4>

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">

                Enable Online Payment

            </label>

            <div class="form-check form-switch">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="pay_online"

                    @checked($setting->pay_online)
                >

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">

                Enable Pay On Pool

            </label>

            <div class="form-check form-switch">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="pay_on_pool"

                    @checked($setting->pay_on_pool)
                >

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <label class="form-label">

                Offline Charge

            </label>

            <input
                type="number"
                step="0.01"
                name="offline_charge"

                class="form-control"

                value="{{ old('offline_charge',$setting->offline_charge) }}"
            >

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">

                Gateway Charge

            </label>

            <input
                type="number"
                step="0.01"
                name="gateway_charge"

                class="form-control"

                value="{{ old('gateway_charge',$setting->gateway_charge) }}"
            >

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">

                GST %

            </label>

            <input
                type="number"
                step="0.01"
                name="gst_percentage"

                class="form-control"

                value="{{ old('gst_percentage',$setting->gst_percentage) }}"
            >

        </div>

    </div>

        <hr class="my-4">


        <h4 class="mb-3">Duration Settings</h4>

        <label class="form-label">Minimum Duration (Hours)</label>
        <input class="form-control mb-3" name="min_duration" value="{{ $setting->min_duration ?? 1 }}">

        <label class="form-label">Maximum Duration (Hours)</label>
        <input class="form-control mb-3" name="max_duration" value="{{ $setting->max_duration ?? 4 }}">

        <label class="form-label">Step Minutes</label>
        <input class="form-control mb-3" name="step_minutes" value="{{ $setting->step_minutes ?? 30 }}">

        <hr class="my-4">

        <h4 class="mb-3">Feature Toggles</h4>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="children_enabled"
                {{ ($setting && $setting->children_enabled) ? 'checked' : '' }}>
            <label class="form-check-label">Enable Children Booking</label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="full_pool_enabled"
                {{ ($setting && $setting->full_pool_enabled) ? 'checked' : '' }}>
            <label class="form-check-label">Enable Full Pool Booking</label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="booking_enabled"
                {{ ($setting && $setting->booking_enabled) ? 'checked' : '' }}>
            <label class="form-check-label">Enable Booking</label>
        </div>

        <button class="btn btn-primary px-4">Save Settings</button>
    </form>
</div>

@endsection