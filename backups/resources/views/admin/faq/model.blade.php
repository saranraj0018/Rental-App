<div class="modal fade" id="add_faq_item" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_faq_label">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="faq_form">
                    <input type="hidden" name="faq_id" id="faq_id">
                    <div class="form-row w-100">
                        <label for="role">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Question">
                        <div class="invalid-feedback">
                            Please enter the Question.
                        </div>
                    </div>
                    <div class="form-row w-100">
                        <label for="role">Answer</label>
                        <textarea type="text" class="form-control" id="answer" name="answer" placeholder="Answer"></textarea>
                        <div class="invalid-feedback">
                            Please enter the Answer.
                        </div>
                    </div>
                    <div class="form-row mt-3 float-right">
                        <div class="form-group col-md-6">
                            <button type="submit" id="save_faq" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_faq_model" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm_delete_row">Delete</button>
            </div>
        </div>
    </div>
</div>

