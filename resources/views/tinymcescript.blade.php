{{-- tinymce --}}
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        if (!window.tinymce) return;
        tinymce.init({
            selector: '.tinymce',
            height: 300,
            maxContentSize: 157286400,
            remove_script_host: false,
            paste_data_images: true,
            plugins: 'advlist autolink lists link image charmap preview searchreplace visualblocks code codesample fullscreen insertdatetime media table',
            toolbar: 'fullscreen code preview | undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | forecolor backcolor removeformat | link image media codesample',
            font_formats: 'Segoe UI=Segoe UI;',
            fontsize_formats: '8px 9px 10px 11px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 66px 68px 70px 72px 74px 76px 78px 80px 82px 84px 86px 88px 90px 92px 94px 96px',
            file_picker_types: 'file image video media',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*,video/*');
                input.onchange = function () {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    }
                };
                input.click();
            },
            setup: function (editor) {
                // Keep underlying textarea in sync so validations work
                editor.on('change input keyup undo redo', function () {
                    tinymce.triggerSave();
                });
            }
        });

        // Ensure all forms trigger TinyMCE to save back to textareas on submit
        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function () {
                if (window.tinymce) {
                    tinymce.triggerSave();
                }
            });
        });
    });
</script>
