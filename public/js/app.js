// View: createuser
document.addEventListener('DOMContentLoaded', function() {
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Asigna el evento change al input de tipo file
    document.getElementById('url').addEventListener('change', function() {
        previewImage(this);
    });
});

