<!-- Modal for "Without Price" -->
<div class="modal fade" id="without-price-modal" tabindex="-1" role="dialog" aria-labelledby="withoutPriceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withoutPriceLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Car swap completed successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for "With Price" -->
<div class="modal fade" id="with-price-modal" tabindex="-1" role="dialog" aria-labelledby="withPriceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withPriceLabel">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="amount" name="amount">
            <div class="modal-body" id="calculated-amount">

            </div>
            <p id="payment_success" class="text-success"></p>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="send_payment">Send Payment Link</button>
                <button type="button" class="btn btn-primary without_price" id="swap_car">Swap Car</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
