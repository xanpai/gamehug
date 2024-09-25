<script src="{{ asset('build/vendor/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        content_css: "{{ Vite::asset('resources/scss/app.scss') }}",
        branding: false,
        height: '600px',
        automatic_uploads: true,
        file_picker_types: 'image',
        plugins: 'anchor code autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount quickbars',
        toolbar: 'inserttabs | code | undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        image_advtab: true,
        image_dimensions: false,
        object_resizing: true,
        quickbars_selection_toolbar: 'alignleft aligncenter alignright | quicklink h2 h3 blockquote',
        quickbars_insert_toolbar: 'image media table',
        valid_elements: '*[*]',
        extended_valid_elements: 'img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],a[href|target|rel]',
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
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
            };
            input.click();
        },
        setup: function(editor) {
            editor.on('NodeChange', function(e) {
                if (e.element.nodeName === 'IMG') {
                    editor.dom.addClass(e.element,
                        'max-w-full h-auto inline-block align-top mx-4 my-4');
                }
            });

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
    });

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
