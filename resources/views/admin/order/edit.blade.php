@extends('admin.layouts.app')

@section('title', 'Sipariş Düzenle')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sipariş #{{ $order->id }} Düzenle</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Listeye Dön
        </a>
    </div>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Sipariş Ürünleri</h3>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered" id="items-table">
                            <thead>
                                <tr>
                                    <th>Ürün</th>
                                    <th width="150">Fiyat</th>
                                    <th width="100">Adet</th>
                                    <th width="120">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $index => $item)
                                <tr>
                                    <td>
                                        <select name="items[{{ $index }}][product_id]" class="form-control">
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $index }}][price]" class="form-control item-price" 
                                               value="{{ old('items.'.$index.'.price', $item->price) }}" 
                                               step="0.01" min="0" required>
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $index }}][quantity]" class="form-control item-quantity" 
                                               value="{{ old('items.'.$index.'.quantity', $item->quantity) }}" 
                                               min="1" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-item">
                                            <i class="fas fa-trash"></i> Sil
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <button type="button" class="btn btn-sm btn-success" id="add-item">
                                            <i class="fas fa-plus"></i> Ürün Ekle
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Sipariş Durumu</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3">
                            <label for="status">Durum</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach(\App\Models\Order::STATUSES as $value => $label)
                                    <option value="{{ $value }}" {{ old('status', $order->status) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="shipping_code">Kargo Kodu</label>
                            <input type="text" name="shipping_code" id="shipping_code" 
                                   class="form-control @error('shipping_code') is-invalid @enderror"
                                   value="{{ old('shipping_code', $order->shipping_code) }}">
                            @error('shipping_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="shipping_cost">Kargo Ücreti</label>
                            <input type="number" name="shipping_cost" id="shipping_cost" 
                                   class="form-control @error('shipping_cost') is-invalid @enderror"
                                   value="{{ old('shipping_cost', $order->shipping_cost ?? 0) }}" 
                                   step="0.01" min="0" required>
                            @error('shipping_cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Sipariş Özeti</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ürünler Toplamı:</span>
                            <span id="items-total">{{ number_format($order->items_total, 2) }} TL</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Kargo Ücreti:</span>
                            <span id="shipping-cost">{{ number_format($order->shipping_cost ?? 0, 2) }} TL</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Genel Toplam:</span>
                            <span id="total-amount">{{ number_format($order->total_amount, 2) }} TL</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Değişiklikleri Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize totals on page load
        updateTotals();
        
        // Add new item row
        $('#add-item').click(function() {
            const rowCount = $('#items-table tbody tr').length;
            const newRow = `
                <tr>
                    <td>
                        <select name="items[${rowCount}][product_id]" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[${rowCount}][price]" class="form-control item-price" 
                               value="{{ old('items.${rowCount}.price', '') }}" 
                               step="0.01" min="0" required>
                    </td>
                    <td>
                        <input type="number" name="items[${rowCount}][quantity]" class="form-control item-quantity" 
                               value="{{ old('items.${rowCount}.quantity', 1) }}" 
                               min="1" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-item">
                            <i class="fas fa-trash"></i> Sil
                        </button>
                    </td>
                </tr>
            `;
            $('#items-table tbody').append(newRow);
            updateTotals();
        });
        
        // Remove item row
        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            updateTotals();
        });

        // Update totals when inputs change
        $(document).on('change', '.item-price, .item-quantity, #shipping_cost', function() {
            updateTotals();
        });

        // Add the classes to existing inputs
        $('input[name$="[price]"]').addClass('item-price');
        $('input[name$="[quantity]"]').addClass('item-quantity');

        // Calculate and update totals
        function updateTotals() {
            let itemsTotal = 0;
            
            // Calculate items total
            $('#items-table tbody tr').each(function() {
                const price = parseFloat($(this).find('.item-price').val()) || 0;
                const quantity = parseInt($(this).find('.item-quantity').val()) || 0;
                itemsTotal += price * quantity;
            });
            
            // Get shipping cost
            const shippingCost = parseFloat($('#shipping_cost').val()) || 0;
            
            // Calculate total amount
            const totalAmount = itemsTotal + shippingCost;
            
            // Update the display
            $('#items-total').text(itemsTotal.toFixed(2) + ' TL');
            $('#shipping-cost').text(shippingCost.toFixed(2) + ' TL');
            $('#total-amount').text(totalAmount.toFixed(2) + ' TL');
        }
    });
</script>
@endpush
@endsection
