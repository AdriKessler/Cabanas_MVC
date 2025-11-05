// js/menu.js
(function(){
  const btn  = document.getElementById('menuToggle');
  const pane = document.getElementById('menuList');

  if (!btn || !pane) return; // seguridad

  function open()  { pane.hidden = false; btn.setAttribute('aria-expanded', 'true'); }
  function close() { pane.hidden = true;  btn.setAttribute('aria-expanded', 'false'); }
  function toggle(){ pane.hidden ? open() : close(); }

  btn.addEventListener('click', (e) => { e.stopPropagation(); toggle(); });

  document.addEventListener('click', (e) => {
    if (!pane.hidden && !e.target.closest('.menu-dd')) close();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !pane.hidden) { close(); btn.focus(); }
  });
})();
