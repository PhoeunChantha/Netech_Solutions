<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body py-0 table-wrapper">
    <table id="purchaseTable" class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Supplier Name') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Purchase Status') }}</th>
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Grand Total') }}</th>
                <th>{{ __('Payment Due') }}</th>
                <th>{{ __('Purchase Paid') }}</th>
                <th>{{ __('Added By') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot style="background-color: #D2D6DE;">
            <tr>
                <td colspan="5" class="text-right"><strong></strong></td>
                <td>
                    <Strong>{{ __('Grand Total: ') }}</Strong><br>
                    <strong><span id="totalpurchase">$0.00</span></strong>
                </td>
                <td>
                    <Strong>{{ __('Payment Due: ') }}</Strong><br>
                    <strong><span id="totalpurchasedue">$0.00</span></strong>
                </td>
                <td>
                    <Strong>{{ __('Purchase Paid Total: ') }}</Strong><br>
                    <strong><span id="totalpurchasepaid">$0.00</span></strong></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</div>
