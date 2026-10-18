document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. LOGIKA MODAL PREVIEW GAMBAR FULLSCREEN
    // ==========================================
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('imgExpanded');
    const btnBack = document.getElementById('btnBackViewer');
    const filenameEl = document.getElementById('viewerFilename');

    document.querySelectorAll('.img-previewable').forEach((img) => {
        img.addEventListener('click', function () {
            if (!modal || !modalImg) return;

            modalImg.src = this.src;

            const srcPath = this.src;
            let fileName = srcPath.substring(srcPath.lastIndexOf('/') + 1);
            try {
                fileName = decodeURIComponent(fileName);
            } catch (e) {
                console.error(e);
            }

            if (filenameEl) {
                filenameEl.textContent = fileName || 'preview_gambar.jpg';
            }

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModalImage() {
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    if (btnBack) {
        btnBack.addEventListener('click', closeModalImage);
    }

    // ==========================================
    // 2. LOGIKA MODAL POPUP KONTAK / KLAIM
    // ==========================================
    const contactModal = document.getElementById('contactModal');
    const btnCloseContact = document.getElementById('btnCloseContact');
    const modalTitle = document.getElementById('modalTitle');
    const modalNama = document.getElementById('modalNama');
    const modalNoHp = document.getElementById('modalNoHp');

    // Sembunyikan modal kontak saat pertama kali dimuat
    if (contactModal) {
        contactModal.classList.add('hidden');
    }

    // Menggunakan Event Delegation agar klik tombol .btn-kontak selalu terdeteksi
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-kontak');
        if (btn) {
            e.preventDefault();

            const nama = btn.getAttribute('data-nama') || '-';
            const noHp = btn.getAttribute('data-nohp') || 'Tidak dicantumkan';
            const tipe = btn.getAttribute('data-tipe');

            if (modalTitle) {
                modalTitle.textContent = (tipe === 'menemukan') ? 'Klaim Barang' : 'Hubungi Pelapor';
            }
            if (modalNama) {
                modalNama.textContent = nama;
            }
            if (modalNoHp) {
                modalNoHp.textContent = noHp;

                // Format nomor HP ke tautan WhatsApp jika ada
                if (noHp && noHp !== 'Tidak dicantumkan') {
                    let formattedNo = noHp.replace(/[^0-9]/g, '');
                    if (formattedNo.startsWith('0')) {
                        formattedNo = '62' + formattedNo.slice(1);
                    }
                    modalNoHp.href = 'https://wa.me/' + formattedNo;
                } else {
                    modalNoHp.removeAttribute('href');
                }
            }

            if (contactModal) {
                contactModal.classList.remove('hidden');
            }
        }
    });

    // Fungsi Tutup Modal Kontak
    function closeModalContact() {
        if (contactModal) {
            contactModal.classList.add('hidden');
        }
    }

    if (btnCloseContact) {
        btnCloseContact.addEventListener('click', closeModalContact);
    }

    // Tutup Modal Kontak saat area latar/luar diklik
    if (contactModal) {
        contactModal.addEventListener('click', function (e) {
            if (e.target === contactModal) {
                closeModalContact();
            }
        });
    }

    // ==========================================
    // 3. TUKAR TOMBOL ESCAPE (TUTUP KEDUA MODAL)
    // ==========================================
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModalImage();
            closeModalContact();
        }
    });
});