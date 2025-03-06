<style>
    .nav-tabs .nav-link.active {
        background-color: #1077B8;
        color: white;
    }
</style>
<div class="modal fade" id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="itemDiscountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemDiscountModalLabel">{{ __('Apply Discount') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="discount-form">
                    <div class="row col-md-12">
                        <div class="form-group">
                            <label for="product-name" class="font-weight-bold">{{ __('Product Name') }}:</label>
                            <span id="product-name" class="form-control-plaintext">{{ __('Dell Desktop') }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="subtotal" class="font-weight-bold">{{ __('Total Price') }}</label>
                            <input type="text" class="form-control" id="subtotal-input" name="subtotal-input" value=""
                                readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="discount-percent" class="font-weight-bold">{{ __('Discount') }}</label>
                            <ul class="nav nav-tabs" id="discount-type" role="tablist">
                                <li class="nav-item button-tab">
                                    <a class="nav-link active" id="discount-percent-tab" data-toggle="tab"
                                        href="#discount-percent" role="tab" aria-controls="discount-percent"
                                        aria-selected="true">{{ __('Percent') }}</a>
                                </li>
                                <li class="nav-item button-tab">
                                    <a class="nav-link" id="discount-amount-tab" data-toggle="tab"
                                        href="#discount-amount" role="tab" aria-controls="discount-amount"
                                        aria-selected="false">{{ __('Amount') }}</a>
                                </li>
                            </ul>

                            <input type="text" id="discount-type-input" name="discount_type" value="percent">

                            <div class="tab-content" id="discount-type-content">
                                <div class="tab-pane fade show active" id="discount-percent" role="tabpanel" aria-labelledby="discount-percent-tab">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="discount-percent-input"
                                            name="discount_percent" value="" placeholder="Enter discount percent">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-percentage"></i> <!-- Percent Icon -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="tab-pane fade" id="discount-amount" role="tabpanel" aria-labelledby="discount-amount-tab">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="discount-amount-input"
                                            name="discount_amount" value="" placeholder="Enter discount amount">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i> <!-- Dollar Icon -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="apply-discount">{{ __('Apply') }}</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#discount-percent-tab').click(function() {
                $('#discount-type-input').val('percent');
            });
            $('#discount-amount-tab').click(function() {
                $('#discount-type-input').val('amount');
            });
        });
    </script>
@endpush
