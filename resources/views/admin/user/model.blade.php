<div class="modal fade" id="document_model" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="min-width: 900px">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">User Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 40vh; max-height: 80vh; overflow: hidden;">
                <div class="d-flex justify-content-between align-items-start gap-5" style="height: 100%">
                    <div class="w-50" style="border-right: 3px solid #0000002b; height: 100%">
                        <div class="p-3">
                            <div class="d-flex flex-wrap" id="documents"
                                style="justify-content: start; align-items: center; gap: 2em">
                            </div>
                        </div>
                    </div>

                    <div class="w-50">
                        <div class="p-3">
                            <div id="image_gallery" class="d-flex flex-wrap mb-5"
                                style="overflow: scroll; max-height: 70vh">
                                {{-- --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
