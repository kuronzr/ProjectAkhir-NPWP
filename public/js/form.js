const MIN_GAMBAR = 3;   // minimal gambar (ubah ke 0 kalau opsional)
const MAX_GAMBAR = 10;  // maksimal gambar

const input = document.getElementById('gambar');
const dropzone = document.getElementById('dropzone');
const previewList = document.getElementById('preview-list');
const info = document.getElementById('gambar-info');
const errorMsg = document.getElementById('gambar-error');

let files = [];

function showError(msg) {
  errorMsg.textContent = msg;
  errorMsg.classList.toggle('hidden', !msg);
}

// samakan isi <input type="file"> dengan daftar `files` supaya ikut terkirim
function syncInput() {
  const dt = new DataTransfer();
  files.forEach((f) => dt.items.add(f));
  input.files = dt.files;
}

function render() {
  previewList.querySelectorAll('img').forEach((img) => URL.revokeObjectURL(img.src));
  previewList.innerHTML = '';

  files.forEach((file, i) => {
    const item = document.createElement('div');
    item.className = 'preview-container';

    const img = document.createElement('img');
    img.src = URL.createObjectURL(file);
    img.alt = 'Preview ' + file.name;

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'btn-remove';
    btn.title = 'Hapus Gambar';
    btn.textContent = 'x';
    btn.addEventListener('click', () => {
      files.splice(i, 1);
      syncInput();
      render();
    });

    item.append(img, btn);
    previewList.appendChild(item);
  });

  info.textContent = `${files.length} gambar dipilih (minimal ${MIN_GAMBAR}, maksimal ${MAX_GAMBAR})`;
}

function addFiles(list) {
  let ditolak = false;

  for (const file of list) {
    if (!file.type.startsWith('image/')) { ditolak = true; continue; }
    const kembar = files.some((f) => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified);
    if (kembar) continue;
    if (files.length >= MAX_GAMBAR) { showError(`Maksimal ${MAX_GAMBAR} gambar.`); break; }
    files.push(file);
  }

  if (ditolak) showError('Hanya file gambar yang diperbolehkan.');
  else if (files.length < MAX_GAMBAR) showError('');

  syncInput();
  render();
}

// pilih lewat dialog "choose file" (bisa pilih banyak sekaligus)
input.addEventListener('change', () => addFiles([...input.files]));

// seret & lepas
['dragenter', 'dragover'].forEach((ev) =>
  dropzone.addEventListener(ev, (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
  })
);
['dragleave', 'drop'].forEach((ev) =>
  dropzone.addEventListener(ev, (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
  })
);
dropzone.addEventListener('drop', (e) => addFiles([...e.dataTransfer.files]));

// validasi minimal gambar
document.querySelector('.form-container form').addEventListener('submit', (e) => {
  if (files.length < MIN_GAMBAR) {
    e.preventDefault();
    showError(`Minimal ${MIN_GAMBAR} gambar harus diunggah (sekarang ${files.length}).`);
    errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
});

render();
