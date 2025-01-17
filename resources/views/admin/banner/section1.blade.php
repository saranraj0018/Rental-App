@extends('admin.layout.app')
@section('content')
    @php
        $data = !empty($frontend) && optional($frontend)->data_values ? json_decode($frontend->data_values, true) : [];
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $features = !empty($data['features']) ? json_decode($data['features'], true) : [];

        $images = $frontend->frontendImage ?? [];
        $image1 = $images[0]->name ?? '';
        $image2 = $images[1]->name ?? '';
        $image3 = $images[2]->name ?? '';
    @endphp

    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form id="banner_section" action="{{ route('banner.save') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xl-4">
                                <div id="image-upload-container">
                                    <!-- Initial Image Upload Sections -->
                                    <input type="hidden" name="banner_id" id="banner_id" value="{{ $frontend->id ?? 0 }}">
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_1" src="{{ asset('storage/section1-image-car/' . $image1) }}" alt="Your Image" class="img-fluid mb-2 @if(empty($image1)) d-none @endif" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="image_car"  accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload Minimum 3 image.</div>
                                        </div>
                                    </div>
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_2" src="{{ asset('storage/section1-image-car/' . $image2) }}" alt="Your Image" class="img-fluid mb-2 @if(empty($image2)) d-none @endif" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="image_car" accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload Minimum 3 image.</div>
                                        </div>
                                    </div>
                                    <div class="image-upload-section mb-3">
                                        <div class="border p-2 rounded text-center">
                                            <img id="image_preview_3" src="{{ asset('storage/section1-image-car/' . $image3) }}" alt="Your Image" class="img-fluid mb-2 @if(empty($image3)) d-none @endif" style="max-height: 150px;">
                                            <input type="file" class="form-control" name="image_car[]" id="image_car" accept=".png, .jpg, .jpeg">
                                            <div class="invalid-feedback">Please upload Minimum 3 image.</div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <button type="button" id="add-more-images" class="btn btn-secondary mb-3">Add More Images</button>--}}
                            </div>

                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Title</label>
                                    <textarea name="title" id="title" rows="3" class="form-control" placeholder="Title">{{ $title ?? '' }}</textarea>
                                    <div class="invalid-feedback">Please provide a title.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Car description">{{ $description ?? '' }}</textarea>
                                    <div class="invalid-feedback">Please provide a description.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">Features</label>
                                    <small class="ml-2 mt-2 text-facebook">Separate multiple features by <code>,</code>(comma) or <code>enter</code> key</small>
                                    <select name="features[]" class="form-control select2-auto-tokenize" multiple="multiple" id="features">
                                        @if(!empty($features))
                                            @foreach($features as $option)
                                                <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">Please select at least one feature.</div>
                                </div>
                                @if (in_array('banner_section_update', getAdminPermissions()))
                                <div class="form-group">
                                    <button type="submit" id="banner_save" class="btn btn-primary btn-block btn-lg">Update</button>
                                </div>
                                   @endif
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
