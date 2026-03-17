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



    <!-- Row 2: Flat Rate and Helper Note -->
    <div class="flex flex-row gap-6">
        <!-- Left: Flat Rate Input -->
        <div class="flex-1">
            <form action="{{ route('admin.shipping.update') }}" method="POST">
                @csrf
                <div class="section-card h-full">
                    <div class="card-header">Shipping Rates</div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-1">Inside Dhaka</label>
                            <input type="number" step="0.01" name="shipping_inside_dhaka" class="flat-rate-input" value="{{ get_setting('shipping_inside_dhaka', '0') }}" placeholder="Amount">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-1">Dhaka Sub District</label>
                            <input type="number" step="0.01" name="shipping_sub_inside_dhaka" class="flat-rate-input" value="{{ get_setting('shipping_sub_inside_dhaka', '0') }}" placeholder="Amount">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-1">Outside Dhaka</label>
                            <input type="number" step="0.01" name="shipping_outside_dhaka" class="flat-rate-input" value="{{ get_setting('shipping_outside_dhaka', '0') }}" placeholder="Amount">
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
                        Set specific shipping rates for different zones. These rates will be applied during checkout based on customer selection.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
