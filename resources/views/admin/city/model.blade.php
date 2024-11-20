<div class="modal fade" id="city_model" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="city_label">Create City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="city_form">
                    <div class="form-row">
                        <input type="hidden" name="city_id">
                        <div class="form-group col-md-6">
                            <label for="city_status">Status</label>
                            <select id="city_status" name="city_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Deactivated</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <label for="city_name">City Name (Search and Select)</label>
                            <input type="text" id="city_name" name="city_name" class="form-control" placeholder="Search for location">
                            <div class="invalid-feedback">Please enter the City.</div>
                            <div id="map_canvas" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <div class="form-row mt-3 float-right">
                        <button type="submit" id="save_city" class="btn btn-primary mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_city" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="confirm_delete">Delete</button>
            </div>
        </div>
    </div>
</div>



