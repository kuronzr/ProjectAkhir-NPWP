// FAQ: klik pertanyaan untuk buka / tutup jawabannya
document.querySelectorAll('.faq-q').forEach((btn) => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq-item');
    const terbuka = item.classList.toggle('open');
    btn.setAttribute('aria-expanded', terbuka);
  });
});

// Menu "FAQ" di navbar (about.html#faq): langsung scroll ke paling bawah halaman
function keBawah() {
  window.scrollTo(0, document.documentElement.scrollHeight);
}

// dibuka dari halaman lain, atau tautan #faq dibuka langsung
window.addEventListener('load', () => {
  if (location.hash === '#faq') keBawah();
});
window.addEventListener('hashchange', () => {
  if (location.hash === '#faq') keBawah();
});

// diklik saat sudah berada di halaman About (hash sama tidak memicu hashchange)
document.querySelectorAll('a[href$="#faq"]').forEach((a) => {
  a.addEventListener('click', (e) => {
    if (new URL(a.href).pathname === location.pathname) {
      e.preventDefault();
      history.replaceState(null, '', '#faq');
      keBawah();
    }
  });
});
