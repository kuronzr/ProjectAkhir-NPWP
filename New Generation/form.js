const inputGambar = document.getElementById('gambar');
const uploadBox = document.querySelector('.border_kotak');
const previewContainer = document.getElementById('preview-container');
const imagePreview = document.getElementById('image-preview');
const btnRemove = document.getElementById('btn-remove');

// saat file dipilih
inputGambar.addEventListener('change', function () {
    const file = this.files[0];

    if (!file) {
        resetPreview();
        return;
    }

    // pastiin file yang dipilih benar-benar gambar
    if (!file.type.startsWith('image/')) {
        alert('File harus berupa gambar!');
        resetPreview();
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        uploadBox.classList.add('hidden');            // kotak + disembunyikan
        previewContainer.classList.remove('hidden');  // preview ditampilkan
    };
    reader.readAsDataURL(file);
});

// saat tombol X diklik
btnRemove.addEventListener('click', resetPreview);

function resetPreview() {
    inputGambar.value = '';   // kosongkan input file
    imagePreview.src = '';
    previewContainer.classList.add('hidden');
    uploadBox.classList.remove('hidden');
}
