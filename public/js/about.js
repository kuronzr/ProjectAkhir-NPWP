document.querySelectorAll('.faq-q').forEach((btn) => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq-item');
    const terbuka = item.classList.toggle('open');
    btn.setAttribute('aria-expanded', terbuka);
  });
});

// scroll ke bawah saat #faq dibuka
function keBawah() {
  window.scrollTo(0, document.documentElement.scrollHeight);
}

window.addEventListener('load', () => {
  if (location.hash === '#faq') keBawah();
});
window.addEventListener('hashchange', () => {
  if (location.hash === '#faq') keBawah();
});

document.querySelectorAll('a[href$="#faq"]').forEach((a) => {
  a.addEventListener('click', (e) => {
    if (new URL(a.href).pathname === location.pathname) {
      e.preventDefault();
      history.replaceState(null, '', '#faq');
      keBawah();
    }
  });
});