
<div class="card-body py-0 table-wrapper">
    <table id="transactionTable" class="table table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Transaction Type') }}</th>
                <th>{{ __('Product Name') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Transaction Date') }}</th>
                <th>{{ __('Total Amount') }}</th>
                <th>{{ __('Description') }}</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
        <tfoot class="" style="background-color: #D2D6DE;">
            <tr>
                <td colspan="5" class="text-right"></td>
                <td colspan="1"><strong>{{ __('Total: ') }} <span id="total-amount-transaction">$0.00</span></strong></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>
    </table>
</div>
