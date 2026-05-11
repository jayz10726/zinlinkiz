<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Zinlink Tech — Admin Secure Login</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    background: #0a0f1e;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    font-family: system-ui, -apple-system, sans-serif;
    position: relative;
    overflow: hidden;
  }

  .circuit-canvas {
    position: fixed;
    inset: 0;
    pointer-events: none;
  }

  .scanline {
    position: fixed;
    left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(55,138,221,0.4), transparent);
    animation: scan 4s linear infinite;
    pointer-events: none;
    z-index: 1;
  }
  @keyframes scan { 0%{top:-2px} 100%{top:102%} }

  .login-card {
    width: 100%;
    max-width: 400px;
    position: relative;
    z-index: 2;
  }

  .brand {
    text-align: center;
    margin-bottom: 2rem;
  }

  .icon-ring {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    border: 1.5px solid #378ADD;
    background: rgba(55,138,221,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    position: relative;
  }
  .icon-ring::before {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 1px solid rgba(55,138,221,0.2);
  }
  .icon-ring::after {
    content: '';
    position: absolute;
    inset: -12px;
    border-radius: 50%;
    border: 1px solid rgba(55,138,221,0.1);
  }

  .brand-title {
    font-size: 24px;
    font-weight: 600;
    color: #e8f2fc;
    letter-spacing: 0.04em;
  }
  .brand-sub {
    font-size: 12px;
    color: #378ADD;
    margin-top: 4px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
  }

  .card-body {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(55,138,221,0.25);
    border-radius: 16px;
    padding: 2rem;
    position: relative;
  }

  .corner {
    position: absolute;
    width: 12px; height: 12px;
    border-color: #378ADD;
    border-style: solid;
    opacity: 0.7;
  }
  .corner-tl { top: -1px; left: -1px; border-width: 2px 0 0 2px; border-radius: 4px 0 0 0; }
  .corner-tr { top: -1px; right: -1px; border-width: 2px 2px 0 0; border-radius: 0 4px 0 0; }
  .corner-bl { bottom: -1px; left: -1px; border-width: 0 0 2px 2px; border-radius: 0 0 0 4px; }
  .corner-br { bottom: -1px; right: -1px; border-width: 0 2px 2px 0; border-radius: 0 0 4px 0; }

  .field-group { margin-bottom: 1.25rem; }
  .field-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #378ADD;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 6px;
  }

  .field-wrap { position: relative; }
  .field-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.5;
  }

  .field-input {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(55,138,221,0.2);
    border-radius: 8px;
    padding: 12px 14px 12px 42px;
    font-size: 14px;
    color: #e8f2fc;
    outline: none;
    transition: border-color 0.2s, background 0.2s;
    font-family: inherit;
  }
  .field-input::placeholder { color: rgba(232,242,252,0.3); }
  .field-input:focus {
    border-color: rgba(55,138,221,0.6);
    background: rgba(55,138,221,0.08);
  }

  .toggle-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(55,138,221,0.6);
    padding: 4px;
    display: flex;
  }
  .toggle-btn:hover { color: #378ADD; }

  .row-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }
  .remember-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: rgba(232,242,252,0.55);
    cursor: pointer;
  }
  .remember-wrap input { accent-color: #378ADD; cursor: pointer; }
  .forgot-link {
    font-size: 12px;
    color: #378ADD;
    text-decoration: none;
    opacity: 0.8;
    letter-spacing: 0.03em;
  }
  .forgot-link:hover { opacity: 1; text-decoration: underline; }

  .login-btn {
    width: 100%;
    padding: 13px;
    border-radius: 8px;
    border: 1px solid #378ADD;
    background: rgba(55,138,221,0.15);
    color: #e8f2fc;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.06em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s, border-color 0.2s, transform 0.1s;
    font-family: inherit;
    text-transform: uppercase;
  }
  .login-btn:hover {
    background: rgba(55,138,221,0.28);
    border-color: #85B7EB;
  }
  .login-btn:active { transform: scale(0.98); }
  .login-btn.loading { pointer-events: none; opacity: 0.7; }

  .status-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 1.5rem;
    font-size: 11px;
    color: rgba(232,242,252,0.35);
    letter-spacing: 0.05em;
  }
  .status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #1D9E75;
    animation: pulse 2s ease-in-out infinite;
    flex-shrink: 0;
  }
  @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

  .divider {
    height: 1px;
    background: rgba(55,138,221,0.12);
    margin: 1.5rem 0;
    position: relative;
  }
  .divider-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #0d1525;
    padding: 0 10px;
    font-size: 10px;
    color: rgba(55,138,221,0.5);
    letter-spacing: 0.1em;
  }

  .footer-text {
    text-align: center;
    font-size: 11px;
    color: rgba(232,242,252,0.2);
    margin-top: 1.5rem;
    letter-spacing: 0.04em;
  }

  .error-msg {
    display: none;
    background: rgba(163,45,45,0.15);
    border: 1px solid rgba(163,45,45,0.35);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    color: #F09595;
    margin-bottom: 1rem;
    letter-spacing: 0.02em;
  }
  .error-msg.show { display: flex; align-items: center; gap: 8px; }

  @keyframes spin { to { transform: rotate(360deg); } }
</style>
</head>
<body>

<canvas class="circuit-canvas" id="circuitCanvas"></canvas>
<div class="scanline"></div>

<div class="login-card">
  <div class="brand">
    <div class="icon-ring">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
        <rect x="3" y="3" width="8" height="8" rx="1.5" stroke="#378ADD" stroke-width="1.5"/>
        <rect x="17" y="3" width="8" height="8" rx="1.5" stroke="#378ADD" stroke-width="1.5"/>
        <rect x="3" y="17" width="8" height="8" rx="1.5" stroke="#378ADD" stroke-width="1.5"/>
        <rect x="17" y="17" width="8" height="8" rx="1.5" fill="#378ADD" opacity="0.3" stroke="#378ADD" stroke-width="1.5"/>
        <circle cx="14" cy="14" r="2" fill="#378ADD"/>
        <line x1="11" y1="7" x2="14" y2="7" stroke="#378ADD" stroke-width="1"/>
        <line x1="14" y1="7" x2="14" y2="12" stroke="#378ADD" stroke-width="1"/>
        <line x1="17" y1="21" x2="14" y2="21" stroke="#378ADD" stroke-width="1"/>
        <line x1="14" y1="21" x2="14" y2="16" stroke="#378ADD" stroke-width="1"/>
        <line x1="7" y1="11" x2="7" y2="14" stroke="#378ADD" stroke-width="1"/>
        <line x1="7" y1="14" x2="12" y2="14" stroke="#378ADD" stroke-width="1"/>
        <line x1="21" y1="17" x2="21" y2="14" stroke="#378ADD" stroke-width="1"/>
        <line x1="21" y1="14" x2="16" y2="14" stroke="#378ADD" stroke-width="1"/>
      </svg>
    </div>
    <div class="brand-title">Zinlink Tech</div>
    <div class="brand-sub">Secure Admin Portal</div>
  </div>

  <div class="card-body">
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    <div class="error-msg" id="errorMsg">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
        <circle cx="7" cy="7" r="6" stroke="#F09595" stroke-width="1.2"/>
        <line x1="7" y1="4" x2="7" y2="7.5" stroke="#F09595" stroke-width="1.5" stroke-linecap="round"/>
        <circle cx="7" cy="10" r="0.8" fill="#F09595"/>
      </svg>
      <span id="errorText">Invalid credentials. Access denied.</span>
    </div>

    <!-- Swap this form action with your Laravel route -->
    <form method="POST" action="{{ route('login') }}" id="loginForm">
      @csrf

      <div class="field-group">
        <label class="field-label">Access ID</label>
        <div class="field-wrap">
          <svg class="field-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <rect x="2" y="6" width="12" height="8" rx="1.5" stroke="rgba(55,138,221,0.8)" stroke-width="1.2"/>
            <path d="M5 6V4.5a3 3 0 016 0V6" stroke="rgba(55,138,221,0.8)" stroke-width="1.2"/>
            <circle cx="8" cy="10" r="1.2" fill="rgba(55,138,221,0.8)"/>
          </svg>
          <input id="emailInput" name="email" class="field-input" type="email" placeholder="admin@zinlinktech.com" required autocomplete="email"/>
        </div>
      </div>

      <div class="field-group">
        <label class="field-label">Auth Key</label>
        <div class="field-wrap">
          <svg class="field-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <circle cx="6" cy="8" r="4" stroke="rgba(55,138,221,0.8)" stroke-width="1.2"/>
            <circle cx="6" cy="8" r="1.5" fill="rgba(55,138,221,0.8)"/>
            <path d="M10 8h4M12 6v4" stroke="rgba(55,138,221,0.8)" stroke-width="1.2" stroke-linecap="round"/>
          </svg>
          <input id="passInput" name="password" class="field-input" type="password" placeholder="••••••••••••" required autocomplete="current-password" style="padding-right:42px;"/>
          <button class="toggle-btn" id="toggleBtn" type="button" onclick="togglePass()">
            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M1 8c1.5-3 4-4.5 7-4.5S13.5 5 15 8c-1.5 3-4 4.5-7 4.5S2.5 11 1 8z" stroke="currentColor" stroke-width="1.2"/>
              <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.2"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="row-options">
        <label class="remember-wrap">
          <input type="checkbox" name="remember" id="rememberMe"/>
          Keep me signed in
        </label>
        <a href="#" class="forgot-link">Reset access</a>
      </div>

      <button class="login-btn" id="loginBtn" type="submit">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M5 7h7M9 5l3 2-3 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 3H3a1 1 0 00-1 1v6a1 1 0 001 1h2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
        <span>Authenticate</span>
      </button>

    </form>

    <div class="divider"><span class="divider-label">SYSTEM STATUS</span></div>

    <div class="status-bar">
      <div class="status-dot"></div>
      All systems nominal &nbsp;•&nbsp; Encrypted &nbsp;•&nbsp; v3.2.1
    </div>
  </div>

  <div class="footer-text">© 2026 Zinlink Tech — Restricted Access</div>
</div>

<script>
function togglePass() {
  const inp = document.getElementById('passInput');
  const showing = inp.type === 'text';
  inp.type = showing ? 'password' : 'text';
  document.getElementById('eyeIcon').innerHTML = showing
    ? '<path d="M1 8c1.5-3 4-4.5 7-4.5S13.5 5 15 8c-1.5 3-4 4.5-7 4.5S2.5 11 1 8z" stroke="currentColor" stroke-width="1.2"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.2"/>'
    : '<path d="M1 8c1.5-3 4-4.5 7-4.5S13.5 5 15 8c-1.5 3-4 4.5-7 4.5S2.5 11 1 8z" stroke="currentColor" stroke-width="1.2"/><line x1="1" y1="1" x2="15" y2="15" stroke="currentColor" stroke-width="1.2"/>';
}

document.getElementById('loginForm').addEventListener('submit', function() {
  const btn = document.getElementById('loginBtn');
  btn.classList.add('loading');
  btn.innerHTML = `
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="animation:spin 0.8s linear infinite">
      <circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.3" stroke-dasharray="20 15"/>
    </svg>
    <span>Authenticating...</span>`;
});

(function drawCircuits() {
  const canvas = document.getElementById('circuitCanvas');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  const ctx = canvas.getContext('2d');
  const W = canvas.width, H = canvas.height;

  ctx.strokeStyle = 'rgba(55,138,221,0.12)';
  ctx.lineWidth = 1;

  const nodes = [];
  for (let i = 0; i < 35; i++) {
    nodes.push({ x: Math.random() * W, y: Math.random() * H });
  }

  nodes.forEach(n => {
    const near = nodes.filter(m => m !== n && Math.hypot(m.x - n.x, m.y - n.y) < 160);
    near.slice(0, 2).forEach(m => {
      const mx = (n.x + m.x) / 2;
      ctx.beginPath();
      ctx.moveTo(n.x, n.y);
      ctx.lineTo(mx, n.y);
      ctx.lineTo(mx, m.y);
      ctx.lineTo(m.x, m.y);
      ctx.stroke();
    });
  });

  nodes.forEach(n => {
    ctx.beginPath();
    ctx.arc(n.x, n.y, 2.5, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(55,138,221,0.35)';
    ctx.fill();
  });

  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    drawCircuits();
  });
})();
</script>

</body>
</html>