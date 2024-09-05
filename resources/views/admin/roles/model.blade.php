<div class="modal fade" id="add_user_role" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_role_label">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_role_form">
                    <div class="form-row w-75">
                        <label for="role">User Role</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="role">
                        <div class="invalid-feedback">
                            Please enter the Role.
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" id="save_user_role" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--Edit User Role with permission--}}

<div class="modal fade" id="edit_user_role" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_role_label">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_role_edit_form">
                    <div class="form-row w-50">
                        <label for="register_number">User</label>
                        <input type="text" class="form-control" id="user_role" disabled>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-12">
                            <label for="roles">Car Listing:</label>
                            <div id="roles">
                                <!-- Example checkboxes -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="car_list_tab" value="car_list_tab" name="role[]">
                                    <label class="form-check-label" for="car_list_tab">
                                        Car Listing Tab
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="car_list_add" value="car_list_add" name="role[]">
                                    <label class="form-check-label" for="car_list_add">
                                        Add-cars
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="car_list_add_model" value="car_list_add_model" name="role[]">
                                    <label class="form-check-label" for="car_list_add_model">
                                        Add-models
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_list_edit" id="car_list_edit" name="role[]">
                                    <label class="form-check-label" for="car_list_edit">
                                        Edit-cars
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_list_model_edit" id="car_list_model_edit" name="role[]">
                                    <label class="form-check-label" for="car_list_model_edit">
                                        Edit-cars-model
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_list_delete" id="car_list_delete" name="role[]">
                                    <label class="form-check-label" for="car_list_delete">
                                        Delete-cars
                                    </label>
                                </div>
                                <!-- Add more checkboxes as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-12">
                            <label for="roles">Car Availability:</label>
                            <div id="roles">
                                <!-- Example checkboxes -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_av_tab" id="car_av_tab" name="role[]">
                                    <label class="form-check-label" for="car_av_tab">
                                        Car Availability Tab
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_av_add" id="car_av_add" name="role[]">
                                    <label class="form-check-label" for="car_av_add">
                                        Add-cars-block
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="car_av_edit" id="car_av_edit" name="role[]">
                                    <label class="form-check-label" for="car_av_edit">
                                        Edit-cars-block
                                    </label>
                                </div>
                                <!-- Add more checkboxes as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-12">
                            <label for="roles">Role:</label>
                            <div id="roles">
                                <!-- Example checkboxes -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="role_tab" id="role_tab" name="role[]">
                                    <label class="form-check-label" for="role_tab">
                                        User Role Tab
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="role_add" id="role_add" name="role[]">
                                    <label class="form-check-label" for="role_add">
                                        Add-role
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="role_edit" id="role_edit" name="role[]">
                                    <label class="form-check-label" for="role_edit">
                                        Edit-role
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="role_delete" id="role_delete"  name="role[]">
                                    <label class="form-check-label" for="role_delete">
                                        Delete-role
                                    </label>
                                </div>
                                <!-- Add more checkboxes as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-12">
                            <label for="roles">Hub:</label>
                            <div id="roles">
                                <!-- Example checkboxes -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="hub_list" id="hub_list" name="role[]">
                                    <label class="form-check-label" for="hub_list">
                                        Hub List Tab
                                    </label>
                                </div>
                                <!-- Add more checkboxes as needed -->
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="role_id"  name="role_id">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" id="update_user_role" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_role_model" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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

