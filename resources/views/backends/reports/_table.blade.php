<div class="card-body pt-0 table-wrapper">
    <table id="sellreportTable" class="table table-hover table-responsive no-wrap">
        <thead>
            <tr>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Invoice No.') }}</th>
                <th>{{ __('Customer Name') }}</th>
                <th>{{ __('Total Item') }}</th>
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Payment Method') }}</th>
                <th>{{ __('Discount') }}</th>
                <th>{{ __('Total before discount') }}</th>
                <th>{{ __('Total Amount') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="8" class="text-right"></td>
                <td colspan=""><strong>{{ __('Total: ') }} <span id="totalamount">$0.00</span></strong></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>
    </table>
</div>
