document.addEventListener('DOMContentLoaded', function () {
    var typeSelect = document.getElementById('ab_type');
    var linkField = document.getElementById('ab_link');

    function toggleLinkField() {
        if (typeSelect.value === 'link') {
            linkField.disabled = false;
        } else {
            linkField.disabled = true;
        }
    }

    typeSelect.addEventListener('change', toggleLinkField);
    toggleLinkField();
});
