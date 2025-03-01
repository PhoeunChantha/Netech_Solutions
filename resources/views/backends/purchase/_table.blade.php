<style>
    .discount-status {
        position: absolute;
        margin-right: 10px;
    }
</style>
<div class="card-body py-0 table-wrapper">
    <table id="purchaseTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Supplier Name') }}</th>
                <th>{{ __('Product Name') }}</th>
                <th>{{ __('QTY') }}</th>
                <th>{{ __('Unit Cost') }}</th>
                <th>{{ __('Total Cost') }}</th>
                <th>{{ __('Purchase Date') }}</th>
                <th>{{ __('Purchase Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="5" class="text-right"></td>
                <td colspan="1"><strong>{{ __('Total Cost: ') }} <span id="totalCost">$0.00</span></strong></td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>
</div>
