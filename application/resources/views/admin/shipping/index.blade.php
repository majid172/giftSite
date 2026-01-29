@extends('admin.layouts.app')

@push('css')
<style>
    .kartly-settings-container {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }
    .kartly-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
    }
    .card-body {
        padding: 24px;
    }
    .custom-radio-group {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .radio-label {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        color: #64748b;
        font-size: 14px;
        transition: color 0.2s;
    }
    .radio-label:hover {
        color: #3b82f6;
    }
    .radio-input {
        width: 18px;
        height: 18px;
        border: 2px solid #cbd5e1;
        cursor: pointer;
    }
    .radio-input:checked {
        border-color: #3b82f6;
        background-color: #3b82f6;
    }
    .save-btn {
        background: #1e40af;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.2s;
    }
    .save-btn:hover {
        background: #1e3a8a;
    }
    .note-text {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
    }
    .note-item {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .note-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .note-label {
        font-weight: 600;
        color: #475569;
    }
    .flat-rate-input {
        width: 100%;
        background: #f1f5f9;
        border: 1px solid transparent;
        border-radius: 4px;
        padding: 10px 16px;
        color: #334155;
        font-size: 14px;
    }
    .flat-rate-input:focus {
        outline: none;
        background: #ffffff;
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="kartly-settings-container">
    <div class="kartly-title">
        <i class="icon-[tabler--truck-delivery]"></i>
        Shipping & Delivery
    </div>

    <!-- Row 1: Shipping Options and Helper Note -->
    <div class="flex flex-row gap-6 mb-6">
        <!-- Left: Shipping Options -->
        <form action="{{ route('admin.shipping.update') }}" method="POST" class="flex-1">
            @csrf
            <div class="section-card h-full">
                <div class="card-header">Shipping Options</div>
                <div class="card-body">
                    <div class="custom-radio-group">
                        <label class="radio-label">
                            <input type="radio" name="shipping_type" value="flat_rate" class="radio-input" {{ get_setting('shipping_type', 'flat_rate') == 'flat_rate' ? 'checked' : '' }}>
                            Flat Rate Shipping Cost
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="shipping_type" value="product_wise" class="radio-input" {{ get_setting('shipping_type') == 'product_wise' ? 'checked' : '' }}>
                            Product Wise Shipping Cost
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="shipping_type" value="profile_based" class="radio-input" {{ get_setting('shipping_type') == 'profile_based' ? 'checked' : '' }}>
                            Based on Shipping Profiles
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="shipping_type" value="location_based" class="radio-input" {{ get_setting('shipping_type') == 'location_based' ? 'checked' : '' }}>
                            Location Based Shipping Cost
                        </label>
                    </div>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </div>
        </form>

        <!-- Right: Options Note -->
        <div class="section-card h-full flex-1">
            <div class="card-header">Note</div>
            <div class="card-body">
                <div class="note-text">
                    <div class="note-item">
                        <span class="note-label">Flat Rate Shipping Cost Calculation:</span> How many products a customer purchase, doesn't matter. Shipping cost is fixed.
                    </div>
                    <div class="note-item">
                        <span class="note-label">Product Wise Shipping Cost Calculation:</span> Shipping cost is calculate by addition of each product shipping cost.
                    </div>
                    <div class="note-item">
                        <span class="note-label">Profile Wise Shipping Cost Calculation:</span> Shipping cost is calculate by selection of each product shipping profile.
                    </div>
                    <div class="note-item">
                        <span class="note-label">Location Based Shipping Cost Calculation:</span> How many products a customer purchase, doesn't matter. Shipping cost is based on shipping location.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Flat Rate and Helper Note -->
    <div class="flex flex-row gap-6">
        <!-- Left: Flat Rate Input -->
        <div class="flex-1">
            <form action="{{ route('admin.shipping.update') }}" method="POST">
                @csrf
                <div class="section-card h-full">
                    <div class="card-header">Flat Rate Shipping Cost</div>
                    <div class="card-body">
                        <div class="mb-4">
                            <input type="number" step="0.01" name="shipping_flat_rate" class="flat-rate-input" value="{{ get_setting('shipping_flat_rate', '0') }}" placeholder="Amount">
                        </div>
                        <button type="submit" class="save-btn">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right: Flat Rate Note -->
        <div class="flex-1">
            <div class="section-card h-full">
                <div class="card-header">Note</div>
                <div class="card-body">
                    <div class="note-text">
                        Flat rate shipping cost is applicable if Flat Rate Shipping Cost is enabled.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
