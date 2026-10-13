// elemen halaman profil
const profileBanner = document.getElementById('profile-banner');
const profileAvatarImg = document.getElementById('profile-avatar-img');
const profileAvatarDefault = document.querySelector('#profile-avatar .avatar-default');
const profileName = document.getElementById('profile-name');
const profileDesc = document.getElementById('profile-desc');

// elemen popup
const overlay = document.getElementById('modal-overlay');
const btnOpenEdit = document.getElementById('btn-open-edit');
const editForm = document.getElementById('edit-form');
const editName = document.getElementById('edit-name');
const editBio = document.getElementById('edit-bio');

const modalBanner = document.getElementById('modal-banner');
const bannerInput = document.getElementById('banner-input');
const btnRemoveBanner = document.getElementById('btn-remove-banner');

const avatarInput = document.getElementById('avatar-input');
const modalAvatarImg = document.getElementById('modal-avatar-img');
const modalAvatarDefault = document.getElementById('modal-avatar-default');

// nilai yang sedang disimpan (dipakai di halaman profil)
let savedBanner = null; // dataURL atau null
let savedAvatar = null; // dataURL atau null

// nilai sementara selama popup terbuka (baru disimpan saat Confirm)
let draftBanner = null;
let draftAvatar = null;

// helper tampilan
function showBanner(el, src) {
    if (src) {
        el.style.backgroundImage = 'url("' + src + '")';
        el.style.backgroundSize = 'cover';
        el.style.backgroundPosition = 'center';
    } else {
        // kembali ke banner bawaan dari CSS
        el.style.backgroundImage = '';
        el.style.backgroundSize = '';
        el.style.backgroundPosition = '';
    }
}

function showAvatar(imgEl, defaultEl, src) {
    if (src) {
        imgEl.src = src;
        imgEl.classList.remove('hidden');
        defaultEl.classList.add('hidden');
    } else {
        imgEl.src = '';
        imgEl.classList.add('hidden');
        defaultEl.classList.remove('hidden');
    }
}

// baca file gambar -> dataURL
function readImage(file, callback) {
    if (!file) return;

    if (!file.type.startsWith('image/')) {
        alert('File harus berupa gambar!');
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        callback(e.target.result);
    };
    reader.readAsDataURL(file);
}

// buka / tutup popup
function openModal() {
    draftBanner = savedBanner;
    draftAvatar = savedAvatar;

    editName.value = profileName.textContent.trim();
    editBio.value = profileDesc.textContent.trim();

    showBanner(modalBanner, draftBanner);
    showAvatar(modalAvatarImg, modalAvatarDefault, draftAvatar);

    overlay.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    editName.focus();
}

function closeModal() {
    overlay.classList.add('hidden');
    document.body.classList.remove('no-scroll');
    bannerInput.value = '';
    avatarInput.value = '';
}

btnOpenEdit.addEventListener('click', openModal);

// klik area gelap di luar popup = tutup
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeModal();
});

// tombol Esc = tutup
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !overlay.classList.contains('hidden')) {
        closeModal();
    }
});

// upload banner
bannerInput.addEventListener('change', function () {
    readImage(this.files[0], function (src) {
        draftBanner = src;
        showBanner(modalBanner, draftBanner);
    });
});

btnRemoveBanner.addEventListener('click', function () {
    draftBanner = null;
    bannerInput.value = '';
    showBanner(modalBanner, null);
});

// upload foto profil
avatarInput.addEventListener('change', function () {
    readImage(this.files[0], function (src) {
        draftAvatar = src;
        showAvatar(modalAvatarImg, modalAvatarDefault, draftAvatar);
    });
});

// confirm
editForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const nama = editName.value.trim();
    if (!nama) {
        editName.focus();
        return;
    }

    profileName.textContent = nama;
    profileDesc.textContent = editBio.value.trim();

    savedBanner = draftBanner;
    savedAvatar = draftAvatar;

    showBanner(profileBanner, savedBanner);
    showAvatar(profileAvatarImg, profileAvatarDefault, savedAvatar);

    closeModal();
});
