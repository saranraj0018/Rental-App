@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form id="banner_section" action="{{ route('banner.save') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xl-4">
                                <div id="image-upload-container">
                                    <!-- Initial Image Upload Sections -->
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_1" src="#" alt="Your Image" class="img-fluid mb-2 d-none" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="car_pic_1" accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                        </div>
                                    </div>
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_2" src="#" alt="Your Image" class="img-fluid mb-2 d-none" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="car_pic_2" accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                        </div>
                                    </div>
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_3" src="#" alt="Your Image" class="img-fluid mb-2 d-none" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="car_pic_3" accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload an image.</div>
                                        </div>
                                    </div>
                                </div>
{{--                                <button type="button" id="add-more-images" class="btn btn-secondary mb-3">Add More Images</button>--}}
                            </div>

                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Title</label>
                                    <textarea name="title" id="title" rows="3" class="form-control" placeholder="Title"></textarea>
                                    <div class="invalid-feedback">Please provide a title.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Car description"></textarea>
                                    <div class="invalid-feedback">Please provide a description.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Features</label>
                                    <small class="ml-2 mt-2 text-facebook">Separate multiple features by <code>,</code>(comma) or <code>enter</code> key</small>
                                    <select name="features[]" class="form-control select2-auto-tokenize" multiple="multiple" id="features">
                                    </select>
                                    <div class="invalid-feedback">Please select at least one feature.</div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('admin/css/frontend.css')}}">
@endsection
@section('customJs')
    <script src="{{asset("admin/js/frontend.js")}}"></script>
@endsection
