 <!-- Payment Modal -->
 <div class="modal" tabindex="-1" id="payment_modal">
     <div class="modal-dialog modal-xl modal-dialog-centered ">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">{{ __('Payment') }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form id="order_form" method="post">
                 <div class="modal-body">
                     <input type="hidden" id="customer_id" name="customer_id" value="">
                     <div class="col-md-12">
                         <table class="table table-bordered">
                             <thead>
                                 <tr>
                                     <th>{{ __('Product') }}</th>
                                     <th>{{ __('Quantity') }}</th>
                                     <th>{{ __('Subtotal') }}</th>
                                 </tr>
                             </thead>
                             <tbody id="order-details-body">
                                 <!-- Order details will be appended here -->
                             </tbody>
                         </table>
                     </div>
                     <!-- Calculator Section -->
                     <div class="col-md-9">
                         <div class="row d-flex justify-content-center">
                             <div class="col-md-6 payment-calculator">
                                 <div class="form-group">
                                     <label for="receiveAmount">{{ __('Receive Amount') }}*</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                         </div>
                                         <input type="text" name="recieve_amount" id="recieve_amount"
                                             class="form-control" value="">
                                     </div>
                                 </div>
                                 <div class="calc-buttons d-flex flex-wrap">
                                     <!-- Calculator Buttons -->
                                     <button class="btn btn-light">7</button>
                                     <button class="btn btn-light">8</button>
                                     <button class="btn btn-light">9</button>
                                     <button class="btn btn-light">100</button>
                                     <button class="btn btn-light">500</button>

                                     <button class="btn btn-light">4</button>
                                     <button class="btn btn-light">5</button>
                                     <button class="btn btn-light">6</button>
                                     <button class="btn btn-light">50</button>
                                     <button class="btn btn-light">1000</button>

                                     <button class="btn btn-light">1</button>
                                     <button class="btn btn-light">2</button>
                                     <button class="btn btn-light">3</button>
                                     <button class="btn btn-light">20</button>
                                     <button class="btn btn-light">2000</button>

                                     <button class="btn btn-light">0</button>
                                     <button class="btn btn-light">.</button>
                                     <button class="btn btn-danger">Clear</button>
                                     <button class="btn btn-light">10</button>
                                     <button class="btn btn-light">5000</button>
                                 </div>
                             </div>
                             <div class="col-md-6 payment-calculator">
                                 <div class="form-group">
                                     <label for="paymentMethod">{{ __('Payment Method') }}*</label>
                                     <select id="paymentMethod" name="payment_method" class="form-control">
                                         <option value="Cash">Cash</option>
                                         <option value="Bank">Bank transfer</option>
                                     </select>
                                 </div>

                                 <div class="form-group mt-5">
                                     <label for="paymentNotes">{{ __('Payment Notes') }}</label>
                                     <textarea id="paymentNotes" name="payment_notes" class="form-control" rows="3" placeholder="Note"></textarea>
                                 </div>
                                 <button type="button" id="confirm-payment-btn"
                                     class="btn-done mt-2">{{ __('Done') }}</button>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <!-- Summary Section -->
                         <div class="payment-summary">
                             <div class="summary-item">
                                 {{ __('Total Amount') }}: <span class="text-danger" id="payment_display">4.00$</span>
                                 <input type="text" id="hidden_payment_display" name="hidden_payment_display"
                                     value="">
                             </div>
                             <div class="summary-item">
                                 {{ __('Recieve Amount') }}: <span class="text-success"
                                     id="recieve_display">0.00$</span>
                                 <input type="text" id="hidden_recieve_display" name="hidden_recieve_display"
                                     value="0.00$">
                             </div>
                             <div class="summary-item">
                                 {{ __('Change Return') }}: <span class="text-success" id="change_return">0.00$</span>
                                 <input type="text" id="hidden_change_return" name="hidden_change_return"
                                     value="0.00$">
                             </div>
                             <div class="due-amount">
                                 {{ __('Due Amount') }}: <span class="text-danger" id="due_amount">0.00$</span>
                                 <input type="text" id="hidden_due_amount" name="hidden_due_amount"
                                     value="0.00$">
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 @push('js')
     <script>
         $(document).ready(function() {
             $('.calc-buttons .btn').on('click', function() {
                 const buttonValue = $(this).text();
                 let currentAmount = $('#recieve_amount').val().replace('$', '').trim();

                 if (buttonValue === 'X') {
                     currentAmount = '';
                 } else if (buttonValue === '.') {
                     if (!currentAmount.includes('.')) {
                         currentAmount += '.';
                     }
                 } else if (!isNaN(buttonValue)) {
                     currentAmount += buttonValue;
                 }

                 const formattedAmount = `$ ${currentAmount || ''}`;
                 $('#recieve_amount').val(formattedAmount);
                 $('#recieve_display').text(formattedAmount);
                 $('#hidden_recieve_display').val(currentAmount || '0.00');

                 const totalAmount = parseFloat($('#hidden_payment_display').val().replace('$', '')
                     .trim()) || 0;
                 const recieveAmount = parseFloat($('#hidden_recieve_display').val().trim()) || 0;

                 let changeReturn = 0;
                 let dueAmount = 0;

                 if (!recieveAmount || recieveAmount < totalAmount) {
                     dueAmount = totalAmount - (recieveAmount || 0);
                     changeReturn = 0;
                 } else {
                     changeReturn = recieveAmount - totalAmount;
                     dueAmount = 0;
                 }

                 const formattedChange = `$ ${changeReturn.toFixed(2)}`;
                 const formattedDue = `$ ${dueAmount.toFixed(2)}`;

                 $('#change_return').text(changeReturn > 0 ? formattedChange : '$ 0.00');
                 $('#hidden_change_return').val(changeReturn.toFixed(2));
                 $('#due_amount').text(formattedDue);
                 $('#hidden_due_amount').val(dueAmount.toFixed(2));
             });
             $('#recieve_amount').on('input', function() {
                 let currentAmount = $(this).val().replace('$', '');

                 currentAmount = currentAmount.replace(/[^0-9.]/g, '');

                 const parts = currentAmount.split('.');
                 if (parts.length > 2) {
                     currentAmount = parts[0] + '.' + parts.slice(1).join(
                         '');
                 }

                 const formattedAmount = `$ ${currentAmount || ''}`;
                 $('#recieve_amount').val(formattedAmount);
                 $('#recieve_display').text(formattedAmount);
                 $('#hidden_recieve_display').val(currentAmount || '0.00');

                 const totalAmount = parseFloat($('#hidden_payment_display').val().replace('$', '')
                     .trim()) || 0;
                 const recieveAmount = parseFloat($('#hidden_recieve_display').val().trim()) || 0;

                 let changeReturn = 0;
                 let dueAmount = 0;

                 if (!recieveAmount || recieveAmount < totalAmount) {
                     dueAmount = totalAmount - (recieveAmount || 0);
                     changeReturn = 0;
                 } else {
                     changeReturn = recieveAmount - totalAmount;
                     dueAmount = 0;
                 }

                 const formattedChange = `$ ${changeReturn.toFixed(2)}`;
                 const formattedDue = `$ ${dueAmount.toFixed(2)}`;

                 $('#change_return').text(changeReturn > 0 ? formattedChange : '$ 0.00');
                 $('#hidden_change_return').val(changeReturn.toFixed(2));
                 $('#due_amount').text(formattedDue);
                 $('#hidden_due_amount').val(dueAmount.toFixed(2));
             });

             $('#recieve_amount').on('keypress', function(e) {
                 const charCode = e.which || e.keyCode;
                 const charStr = String.fromCharCode(charCode);

                 if (!/[0-9.]/.test(charStr) && charCode !== 8) {
                     e.preventDefault();
                 }

                 if (charStr === '.' && $(this).val().includes('.')) {
                     e.preventDefault();
                 }
             });
         });
     </script>
     <script>
         $('#confirm-payment-btn').on('click', function() {

             const totalAmount = $('#hidden_payment_display').val();
             const recieveAmount = $('#hidden_recieve_display').val();
             const changeReturn = $('#hidden_change_return').val();
             const dueAmount = $('#hidden_due_amount').val();
             const paymentMethod = $('#paymentMethod').val();
             const paymentNotes = $('#paymentNotes').val();
             const customerId = $('#customer_id').val();

             const productOrders = [];

             $('#product-table tr').each(function() {
                 productOrders.push({
                     product_id: $(this).data('product-id'),
                     quantity: $(this).find('.quantity').text(),
                     subtotal: $(this).find('.subtotal').text().replace('$', '')
                 });
             });

             $.ajax({
                 url: '{{ route('admin.pos_store') }}',
                 method: 'POST',
                 data: {
                     customer_id: customerId,
                     payment_method: paymentMethod,
                     payment_notes: paymentNotes,
                     change_return: changeReturn,
                     due_amount: dueAmount,
                     recieve_amount: recieveAmount,
                     orders: productOrders,
                     total: totalAmount,
                     _token: $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function(response) {
                     toastr.success('Order placed successfully!');
                     $('#payment_modal').modal('hide');
                     setTimeout(function() {
                         location.reload();
                     }, 5000);
                 },
                 error: function() {
                     toastr.error('Failed to place order. Please try again.');
                 }
             });
         });
     </script>
 @endpush
