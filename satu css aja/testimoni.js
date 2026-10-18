// preview gambar pada form testimoni
const input = document.getElementById('gambar');
const box = document.querySelector('.border_kotak');
const preview = document.getElementById('preview-container');
const img = document.getElementById('image-preview');
const btnRemove = document.getElementById('btn-remove');

function reset() {
  if (img.src.startsWith('blob:')) URL.revokeObjectURL(img.src);
  input.value = '';
  img.src = '';
  preview.classList.add('hidden');
  box.classList.remove('hidden');
}

input.addEventListener('change', () => {
  const file = input.files[0];
  if (!file) return reset();
  if (!file.type.startsWith('image/')) {
    alert('File harus berupa gambar.');
    return reset();
  }
  if (img.src.startsWith('blob:')) URL.revokeObjectURL(img.src);
  img.src = URL.createObjectURL(file);
  preview.classList.remove('hidden');
  box.classList.add('hidden');
});

img.addEventListener('click', () => input.click());
btnRemove.addEventListener('click', reset);
