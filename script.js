(function () {
  const loader = document.getElementById('loader');
  const fill = document.getElementById('loader-fill');
  const pct = document.getElementById('loader-pct');
  if (!loader || !fill || !pct) return;
  let n = 0;
  const iv = setInterval(() => {
    n = Math.min(n + Math.random() * 18, 99);
    fill.style.width = n + '%';
    pct.textContent = Math.floor(n) + '%';
  }, 80);
  window.addEventListener('load', () => {
    clearInterval(iv);
    fill.style.width = '100%';
    pct.textContent = '100%';
    setTimeout(() => loader.classList.add('hide'), 400);
  });
  setTimeout(() => loader.classList.add('hide'), 2200);
})();

(function () {
  const isCoarse = window.matchMedia('(pointer: coarse)').matches;
  if (isCoarse || window.innerWidth < 768) return;
  const dot = document.getElementById('cursor-dot');
  const ring = document.getElementById('cursor-ring');
  if (!dot || !ring) return;
  let rx = 0;
  let ry = 0;
  document.addEventListener('mousemove', (e) => {
    dot.style.left = e.clientX + 'px';
    dot.style.top = e.clientY + 'px';
    rx += (e.clientX - rx) * 0.12;
    ry += (e.clientY - ry) * 0.12;
    ring.style.left = rx + 'px';
    ring.style.top = ry + 'px';
  });
  (function lerp() {
    const dx = parseFloat(dot.style.left || 0);
    const dy = parseFloat(dot.style.top || 0);
    rx += (dx - rx) * 0.12;
    ry += (dy - ry) * 0.12;
    ring.style.left = rx + 'px';
    ring.style.top = ry + 'px';
    requestAnimationFrame(lerp);
  })();
})();

(function () {
  const bar = document.getElementById('scroll-bar');
  if (!bar) return;
  window.addEventListener('scroll', () => {
    const pct = (scrollY / (document.body.scrollHeight - innerHeight)) * 100;
    bar.style.width = pct + '%';
  }, { passive: true });
})();

(function () {
  const c = document.getElementById('particles');
  if (!c) return;
  const ctx = c.getContext('2d');
  function resize() {
    c.width = innerWidth;
    c.height = innerHeight;
  }
  resize();
  addEventListener('resize', resize);
  const pts = Array.from({ length: 90 }, () => ({
    x: Math.random() * innerWidth,
    y: Math.random() * innerHeight,
    vx: (Math.random() - 0.5) * 0.28,
    vy: (Math.random() - 0.5) * 0.28,
    r: Math.random() * 1.5 + 0.5,
    o: Math.random() * 0.45 + 0.1
  }));
  function draw() {
    ctx.clearRect(0, 0, c.width, c.height);
    pts.forEach((p) => {
      p.x += p.vx;
      p.y += p.vy;
      if (p.x < 0) p.x = c.width;
      if (p.x > c.width) p.x = 0;
      if (p.y < 0) p.y = c.height;
      if (p.y > c.height) p.y = 0;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(0,200,255,${p.o})`;
      ctx.fill();
    });
    pts.forEach((a, i) => pts.slice(i + 1).forEach((b) => {
      const d = Math.hypot(a.x - b.x, a.y - b.y);
      if (d < 130) {
        ctx.beginPath();
        ctx.moveTo(a.x, a.y);
        ctx.lineTo(b.x, b.y);
        ctx.strokeStyle = `rgba(0,200,255,${0.07 * (1 - d / 130)})`;
        ctx.lineWidth = 0.5;
        ctx.stroke();
      }
    }));
    requestAnimationFrame(draw);
  }
  draw();
})();

(function () {
  const links = document.querySelectorAll('.nav-link');
  const sections = document.querySelectorAll('section[id]');
  if (!links.length || !sections.length) return;
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        links.forEach((l) => l.classList.remove('active'));
        const a = document.querySelector(`.nav-link[href="#${e.target.id}"]`);
        if (a) a.classList.add('active');
      }
    });
  }, { threshold: 0.4 });
  sections.forEach((s) => obs.observe(s));
})();

(function () {
  const lines = [
    'whoami --verbose',
    'sudo apt install blue-team-skills',
    'nmap -sV --open target.local',
    'tail -f /var/log/soc/events.log',
    'grep -i "anomaly" /var/log/auth.log'
  ];
  let li = 0;
  let ci = 0;
  let del = false;
  const el = document.getElementById('typed');
  if (!el) return;
  function type() {
    const cur = lines[li];
    if (!del) {
      el.textContent = cur.slice(0, ++ci);
      if (ci === cur.length) {
        del = true;
        setTimeout(type, 1800);
        return;
      }
    } else {
      el.textContent = cur.slice(0, --ci);
      if (ci === 0) {
        del = false;
        li = (li + 1) % lines.length;
        setTimeout(type, 400);
        return;
      }
    }
    setTimeout(type, del ? 38 : 76);
  }
  setTimeout(type, 2200);
})();

(function () {
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) e.target.classList.add('visible');
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach((el) => obs.observe(el));
})();

(function () {
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.skill-fill').forEach((b) => {
          b.style.width = b.dataset.pct + '%';
        });
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.25 });
  document.querySelectorAll('#skill-panel').forEach((p) => obs.observe(p));
})();

(function () {
  function countUp(el) {
    const target = Number(el.dataset.target || 0);
    let cur = 0;
    const step = Math.max(1, Math.ceil(target / 40));
    const iv = setInterval(() => {
      cur = Math.min(cur + step, target);
      el.textContent = cur;
      if (cur >= target) clearInterval(iv);
    }, 40);
  }
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('[data-target]').forEach(countUp);
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.4 });
  document.querySelectorAll('.stat-item').forEach((el) => obs.observe(el));
})();

(function () {
  const isCoarse = window.matchMedia('(pointer: coarse)').matches;
  if (isCoarse) return;
  document.querySelectorAll('[data-magnetic]').forEach((btn) => {
    btn.addEventListener('mousemove', (e) => {
      const r = btn.getBoundingClientRect();
      const x = e.clientX - r.left - r.width / 2;
      const y = e.clientY - r.top - r.height / 2;
      btn.style.transform = `translate(${x * 0.25}px, ${y * 0.3}px)`;
    });
    btn.addEventListener('mouseleave', () => {
      btn.style.transition = 'transform .5s cubic-bezier(.34,1.56,.64,1)';
      btn.style.transform = 'translate(0,0)';
      setTimeout(() => (btn.style.transition = ''), 500);
    });
    btn.addEventListener('mouseenter', () => {
      btn.style.transition = 'transform .1s ease';
    });
  });
})();
