<div class="mb-3 col-md-{{ $field->col ?? '12' }}">
    <label for="{{ $field->name }}" class="form-label">{{ $field->label ?? $field->name }}</label>
    <ul id="media">
        <li>test1</li>
        <li>test2</li>
        <li>test3</li>
        <li>test45</li>
    </ul>
    <div id="drag-drop-area"></div>
    @error($field->name)
        <p class="invalid-feedback" id="{{ $field->name }}-error">{{ $message }}</p>
    @enderror
</div>
<script>
    var uppy = new Uppy()
        .use(Dashboard, {
            inline: true,
            target: '#drag-drop-area'
        })
        .use(Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})
        .use(ImageEditor, {
            target: Dashboard,
            quality: 0.8,
    })

    uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
    })
</script>
