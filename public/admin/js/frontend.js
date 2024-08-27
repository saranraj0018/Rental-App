$(function () {
    'use strict'

    $(document).ready(function() {
        $(".select2-auto-tokenize").select2();
        let imageUploadCount = 3;

        function readURL(input, previewId) {
            const [file] = input.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('car_pic_1').addEventListener('change', function() {
            readURL(this, 'image_preview_1');
        });

        document.getElementById('car_pic_2').addEventListener('change', function() {
            readURL(this, 'image_preview_2');
        });

        document.getElementById('car_pic_3').addEventListener('change', function() {
            readURL(this, 'image_preview_3');
        });

        // Add more image upload sections vertically
        // document.getElementById('add-more-images').addEventListener('click', function() {
        //     imageUploadCount++;
        //     const container = document.getElementById('image-upload-container');
        //     const newImageUpload = `
        //     <div class="image-upload-section mb-3">
        //         <div class="border p-2 rounded text-center">
        //             <img id="image_preview_${imageUploadCount}" src="#" alt="Your Image" class="img-fluid mb-2 d-none" style="max-height: 150px;">
        //             <input type="file" class="form-control" name="image_car[]" id="car_pic_${imageUploadCount}" accept=".png, .jpg, .jpeg" >
        //         </div>
        //     </div>
        // `;
        //     container.insertAdjacentHTML('beforeend', newImageUpload);
        //
        //     // Add event listener for the new file input
        //     document.getElementById(`car_pic_${imageUploadCount}`).addEventListener('change', function() {
        //         readURL(this, `image_preview_${imageUploadCount}`);
        //     });
        // });

        $('.select2-auto-tokenize').select2({
            dropdownParent: $('.card-body form'),
            tags: true,
            tokenSeparators: [','],
            placeholder: "Enter Car Features",
            allowClear: true
        });
        // Validate the form before submission


        $('#banner_section').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission for validation

            let isValid = true;

            // Define the elements and their conditions
            let fields = [
                { id: '#description', condition: (val) => val.trim() === '' },
                { id: '#social_description', condition: (val) => val.trim() === '' },
                { id: '#features', condition: (val) => !val || val.length === 0 }, // Validate array for features
            ];

            let imageInputs = $('input[name="image_car[]"]');
            let selectedImages = 0;

            if (imageInputs.length) {
                imageInputs.each(function() {
                    if ($(this).val()) {
                        selectedImages++;
                    }
                });

                if (selectedImages < 3) {
                    isValid = false;
                    imageInputs.each(function() {
                        if (!$(this).val()) {
                            $(this).addClass('is-invalid');
                        }
                    });
                } else {
                    imageInputs.removeClass('is-invalid');
                }
            } else {
                isValid = false;
                console.error('No image input fields found.');
            }

            fields.forEach(function(field) {
                let element = $(field.id);
                let parent = element.closest('.form-group');

                if (element.length) {
                    let value = element.val();
                    if (field.condition(value)) {
                        parent.find('.invalid-feedback').show();
                        element.addClass('is-invalid');
                        parent.addClass('is-invalid');
                        isValid = false;
                    } else {
                        parent.find('.invalid-feedback').hide();
                        element.removeClass('is-invalid');
                        parent.removeClass('is-invalid');
                    }
                } else {
                    console.error('Element not found: ' + field.id);
                }
            });
            if (isValid) {
                this.submit(); // Submit the form if validation passes
            }
        });
    });
});
