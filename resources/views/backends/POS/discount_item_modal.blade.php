<div class="modal fade" id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="itemDiscountModalLabel" aria-hidden="true">
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
                            <span id="product-name" class="form-control-plaintext">{{__('Dell Desktop')}}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="unit-price" class="font-weight-bold">{{ __('Unit Price') }}</label>
                            <input type="text" class="form-control" id="unit-price" name="unit_price" value="1.00$" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="discount-percent" class="font-weight-bold">{{ __('Discount Percent') }}</label>
                            <input type="number" class="form-control" id="discount-percent" name="discount_percent" value="" placeholder="Enter discount percent">
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
