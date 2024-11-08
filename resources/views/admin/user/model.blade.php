<div class="modal fade" id="document_model" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">User Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <!-- Image 1 Section -->
                <div id="image_section_1" class="mb-3">
                    <img id="car_image_preview1" src="{{ asset('storage/user-documents/placeholder1.png') }}" alt="Document Image 1" class="img-fluid mb-2" style="max-height: 300px;">
                    <p id="no_image_text1" class="text-muted" style="display: none;">No Image 1 available</p>
                </div>
                <!-- Image 2 Section -->
                <div id="image_section_2" class="mb-3">
                    <img id="car_image_preview2" src="{{ asset('storage/user-documents/placeholder2.png') }}" alt="Document Image 2" class="img-fluid mb-2" style="max-height: 300px;">
                    <p id="no_image_text2" class="text-muted" style="display: none;">No Image 2 available</p>
                </div>
            </div>
        </div>
    </div>
</div>
