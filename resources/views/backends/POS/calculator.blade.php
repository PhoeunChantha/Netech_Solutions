 <!-- Payment Modal -->
 <div class="modal" tabindex="-1" id="paymentModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Calculator Section -->
                <div class="payment-calculator">
                    <div class="form-group">
                        <label for="receiveAmount">Receive Amount*</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <input type="text" id="receiveAmount" class="form-control" value="20.00$">
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
                        <button class="btn btn-light">1000</button>

                        <button class="btn btn-light">1</button>
                        <button class="btn btn-light">2</button>
                        <button class="btn btn-light">3</button>
                        <button class="btn btn-light">2000</button>

                        <button class="btn btn-light">0</button>
                        <button class="btn btn-light">.</button>
                        <button class="btn btn-danger">X</button>
                        <button class="btn btn-light">5000</button>
                    </div>

                    <div class="form-group mt-3">
                        <label for="paymentMethod">Payment Method*</label>
                        <select id="paymentMethod" class="form-control">
                            <option>Cash</option>
                            <option>Bank transfer</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="paymentNotes">Payment Notes</label>
                        <textarea id="paymentNotes" class="form-control" rows="2" placeholder="Note"></textarea>
                    </div>

                    <button class="btn-done mt-2">Done</button>
                </div>

                <!-- Summary Section -->
                <div class="payment-summary">
                    <div class="summary-item">
                        Total Amount: <span class="text-danger">4.00$</span>
                    </div>
                    <div class="summary-item">
                        Receive Amount: <span class="text-success">5.00$</span>
                    </div>
                    <div class="summary-item">
                        Change Return: <span class="text-success">1.00$</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>