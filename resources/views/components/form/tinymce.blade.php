<script src="{{ asset('build/vendor/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        content_css: "{{ Vite::asset('resources/scss/app.scss') }}",
        branding: false,
        height: '600px',
        automatic_uploads: true,
        plugins: 'anchor code visualchars autolink advlist charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount quickbars',
        toolbar: 'inserttabs | code | visualchars | undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        image_advtab: true,
        image_dimensions: false,
        object_resizing: true,
        quickbars_selection_toolbar: 'alignleft aligncenter alignright | quicklink h2 h3 blockquote',
        quickbars_insert_toolbar: 'image media table',
        valid_elements: '*[*]',
        extended_valid_elements: 'img[class|src|alt|title|style|data-*],a[href|target|rel|style]',
        rel_list: [{
            title: 'No Follow',
            value: 'nofollow'
        }],
        link_default_rel: 'nofollow',
        formats: {
            alignleft: {
                selector: 'img',
                classes: 'float-left mr-4 mb-4'
            },
            aligncenter: {
                selector: 'img',
                classes: 'mx-auto block'
            },
            alignright: {
                selector: 'img',
                classes: 'float-right ml-4 mb-4'
            },
        },
        setup: function(editor) {
            // Apply Tailwind CSS classes to images
            editor.on('NodeChange', function(e) {
                if (e.element.nodeName === 'IMG') {
                    // Add responsive classes to the image
                    editor.dom.setAttrib(e.element, 'class',
                        'max-w-full h-auto inline-block align-top mx-4 my-4');
                }
            });

            // Remove <p> tags wrapping images
            editor.on('BeforeSetContent', function(e) {
                if (e.content) {
                    e.content = e.content.replace(/<p>\s*(<img[^>]+>)\s*<\/p>/g, '$1');
                }
            });

            // Your existing inserttabs button code...
            editor.ui.registry.addButton('inserttabs', {
                text: 'Insert Tabs',
                onAction: function() {
                    editor.windowManager.open({
                        title: 'Insert Tabs',
                        body: {
                            type: 'panel',
                            items: [{
                                type: 'input',
                                name: 'tab_titles',
                                label: 'Tab Titles (comma-separated)'
                            }]
                        },
                        buttons: [{
                                type: 'cancel',
                                text: 'Close'
                            },
                            {
                                type: 'submit',
                                text: 'Insert',
                                primary: true
                            }
                        ],
                        onSubmit: function(api) {
                            const data = api.getData();
                            const titles = data.tab_titles.split(',').map(title =>
                                title.trim());
                            let content = '[tabs]\n\n';

                            titles.forEach((title, index) => {
                                content +=
                                    `[tab title="${title}"]\n\nContent for ${title}\n\n[/tab]\n\n`;
                            });

                            content += '[/tabs]';

                            editor.insertContent(content);
                            api.close();
                        }
                    });
                }
            });
        },
        file_picker_callback: function(callback, value, meta) {
            if (meta.filetype === 'image') {
                // Create an input element for file selection
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.setAttribute('multiple', 'multiple'); // Allow multiple file selection

                // Listen for file selection
                input.onchange = function() {
                    var files = input.files;

                    // Process each selected file
                    Array.from(files).forEach(function(file) {
                        // Create a new FormData object
                        var formData = new FormData();
                        formData.append('file', file);
                        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token

                        // Make the AJAX request
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('image.upload') }}', true);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                        // Include cookies in the request to maintain the session
                        xhr.withCredentials = true;

                        xhr.onload = function() {
                            if (xhr.status !== 200) {
                                alert('HTTP Error: ' + xhr.status);
                                return;
                            }

                            var json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.location !== 'string') {
                                alert('Invalid JSON: ' + xhr.responseText);
                                return;
                            }

                            // Insert the uploaded image into the editor
                            tinymce.activeEditor.insertContent('<img src="' + json
                                .location + '" />');
                        };

                        xhr.onerror = function() {
                            alert('Image upload failed due to a XHR Transport error. Code: ' +
                                xhr.status);
                        };

                        // Send the form data
                        xhr.send(formData);
                    });
                };

                // Trigger the file input click
                input.click();
            }
        },
    });

    // Your existing settings-editor initialization...
    tinymce.init({
        selector: '.settings-editor',
        content_css: "{{ Vite::asset('resources/scss/app.scss') }}",
        branding: false,
        height: '400px',
        menubar: false,
        plugins: 'autolink charmap lists searchreplace visualblocks wordcount',
        toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | align lineheight | numlist bullist indent outdent | removeformat',
        rel_list: [{
            title: 'No Follow',
            value: 'nofollow'
        }],
        link_default_rel: 'nofollow',
    });
</script>
