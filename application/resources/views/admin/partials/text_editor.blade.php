@push('plugins')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    const quill = new Quill('#description-editor', {
        theme: 'snow'
    });

    // Load old value (for validation errors)
    const hiddenInput = document.getElementById('description');
    if (hiddenInput.value) {
        quill.root.innerHTML = hiddenInput.value;
    }

    // Sync editor content to hidden input
    quill.on('text-change', function () {
        hiddenInput.value = quill.root.innerHTML;
    });
</script>
@endpush
