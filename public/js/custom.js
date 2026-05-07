// Custom UI JS: theme toggle, AOS init, back-to-top, small helpers
document.addEventListener('DOMContentLoaded', function(){
  // AOS
  if(window.AOS) AOS.init({duration:750,once:true,easing:'ease-out-cubic'});

  // pastel theme toggle (light/dim)
  const themeToggle = document.getElementById('themeToggle');
  function setDimMode(dim){
    if(dim){ document.body.classList.add('dim'); localStorage.setItem('dim','1'); }
    else { document.body.classList.remove('dim'); localStorage.removeItem('dim'); }
  }
  setDimMode(localStorage.getItem('dim') === '1');
  if(themeToggle){ themeToggle.addEventListener('click', function(){ setDimMode(!document.body.classList.contains('dim')); }); }

  // back to top
  const back = document.getElementById('backToTop');
  window.addEventListener('scroll', function(){ if(window.scrollY > 450) back.classList.remove('d-none'); else back.classList.add('d-none'); });
  if(back) back.addEventListener('click', function(){ window.scrollTo({top:0,behavior:'smooth'}); });

  // reading progress bar
  const prog = document.getElementById('readingProgress');
  if(prog){ window.addEventListener('scroll', function(){
    const h = document.documentElement.scrollHeight - window.innerHeight;
    const pct = h > 0 ? (window.scrollY / h) * 100 : 0;
    prog.style.width = pct + '%';
  }); }

  // floating shapes (minimal) - add decorative circles
  const shapes = document.createElement('div'); shapes.id='floatingShapes'; shapes.style.position='fixed'; shapes.style.inset='0'; shapes.style.pointerEvents='none'; shapes.style.zIndex='0'; document.body.appendChild(shapes);

  // object-fit fallback
  document.querySelectorAll('img.object-fit-cover').forEach(function(img){ if(!('objectFit' in document.documentElement.style)){ img.style.background = 'center/cover no-repeat'; } });

  // skeleton helper auto-hide after load
  window.addEventListener('load', function(){ document.querySelectorAll('.skeleton').forEach(s=>s.classList.remove('skeleton')); });

  // auto dismiss toast
  document.querySelectorAll('.toast.show').forEach(function(t){ setTimeout(()=>{ t.classList.remove('show'); },4200); });
});

// Tiny helper to reveal elements on ajax updates
function revealAOS(){ if(window.AOS) AOS.refresh(); }
