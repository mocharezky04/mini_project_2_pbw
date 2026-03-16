<?php
require __DIR__ . '/config/koneksi.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$profile = [
    'name' => 'Nama Belum Diisi',
    'title' => 'Judul Belum Diisi',
    'summary' => 'Ringkasan belum diisi.',
    'about' => 'Tentang saya belum diisi.'
];
$profileResult = mysqli_query($conn, "SELECT name, title, summary, about FROM profile ORDER BY id ASC LIMIT 1");
if ($profileResult && mysqli_num_rows($profileResult) > 0) {
    $profile = mysqli_fetch_assoc($profileResult);
}

$socialLinks = [];
$socialResult = mysqli_query($conn, "SELECT platform, url, icon_class FROM social_links ORDER BY id ASC");
if ($socialResult) {
    while ($row = mysqli_fetch_assoc($socialResult)) {
        $socialLinks[] = $row;
    }
}

$instagramUrl = '';
$linkedinUrl = '';
foreach ($socialLinks as $link) {
    $platform = strtolower($link['platform'] ?? '');
    if ($platform === 'instagram') {
        $instagramUrl = $link['url'];
    }
    if ($platform === 'linkedin') {
        $linkedinUrl = $link['url'];
    }
}

$skills = [];
$skillsResult = mysqli_query($conn, "SELECT id, skill_name, percentage, color_class FROM skills ORDER BY id ASC");
if ($skillsResult) {
    while ($row = mysqli_fetch_assoc($skillsResult)) {
        $skills[] = $row;
    }
}

$experiences = [];
$expResult = mysqli_query($conn, "SELECT id, content FROM experience ORDER BY id ASC");
if ($expResult) {
    while ($row = mysqli_fetch_assoc($expResult)) {
        $experiences[] = $row;
    }
}

$certificates = [];
$certResult = mysqli_query($conn, "SELECT id, title, description, image_path FROM certificates ORDER BY id ASC");
if ($certResult) {
    while ($row = mysqli_fetch_assoc($certResult)) {
        $certificates[] = $row;
    }
}

$colorMap = [
    'bg-primary' => 'f-blue',
    'bg-info' => 'f-cyan',
    'bg-secondary' => 'f-gray',
    'bg-success' => 'f-green',
    'bg-warning' => 'f-yellow',
    'bg-danger' => 'f-red'
];

$tools = [
    ['icon' => 'bi-terminal', 'label' => 'Linux'],
    ['icon' => 'bi-wifi', 'label' => 'Wireshark'],
    ['icon' => 'bi-search', 'label' => 'Nmap'],
    ['icon' => 'bi-bar-chart', 'label' => 'Splunk'],
    ['icon' => 'bi-code-slash', 'label' => 'Python'],
    ['icon' => 'bi-braces', 'label' => 'Java'],
    ['icon' => 'bi-shield-check', 'label' => 'SIEM'],
    ['icon' => 'bi-bug', 'label' => 'CTF Tools'],
    ['icon' => 'bi-globe', 'label' => 'HTML/CSS'],
    ['icon' => 'bi-phone', 'label' => 'Flutter']
];

$profileImage = 'images/images1.jpg';
$initials = '';
$nameParts = preg_split('/\s+/', trim($profile['name']));
foreach ($nameParts as $part) {
    if ($part !== '') {
        $initials .= strtoupper(substr($part, 0, 1));
    }
}
$initials = $initials !== '' ? $initials : 'SI';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= e($profile['name']); ?> — Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($profile['summary']); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css'); ?>">
</head>
<body>
    <div id="loader">
        <div class="loader-box">
            <div class="loader-title">INITIALIZING PORTFOLIO</div>
            <div class="loader-bar"><div class="loader-fill" id="loader-fill"></div></div>
            <div class="loader-pct" id="loader-pct">0%</div>
            <div class="loader-sub">booting modules...</div>
        </div>
    </div>

    <div id="cursor-dot"></div>
    <div id="cursor-ring"></div>
    <div id="scroll-bar"></div>
    <canvas id="particles"></canvas>

    <nav id="navbar">
        <div class="nav-brand"><span>&gt;_</span> <?= e($profile['name']); ?></div>
        <ul class="nav-links">
            <li><a href="#home" class="nav-link active">[ home ]</a></li>
            <li><a href="#about" class="nav-link">[ about ]</a></li>
            <li><a href="#certificates" class="nav-link">[ certs ]</a></li>
            <li><a href="admin.php" class="nav-link">[ admin ]</a></li>
        </ul>
    </nav>

    <section id="home">
        <div class="hero-inner">
            <div class="status-badge"><div class="status-dot"></div>AVAILABLE FOR OPPORTUNITIES</div>

            <div class="float-badges">
                <span class="float-badge fb1"><i class="bi bi-lock-fill" aria-hidden="true"></i> CTF Player</span>
                <span class="float-badge fb2"><i class="bi bi-shield-shaded" aria-hidden="true"></i> Blue Team</span>
                <span class="float-badge fb3"><i class="bi bi-terminal-fill" aria-hidden="true"></i> Linux User</span>
                <span class="float-badge fb4"><i class="bi bi-broadcast-pin" aria-hidden="true"></i> SOC Learner</span>
                <div class="profile-ring">
                    <img src="<?= e($profileImage); ?>" alt="Profile" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="fallback-av" style="display:none;"><?= e($initials); ?></div>
                </div>
            </div>

            <h1 class="glitch" data-text="<?= e($profile['name']); ?>"><?= e($profile['name']); ?></h1>
            <p class="hero-role">&lt; <?= e($profile['title']); ?> <span>/&gt;</span></p>
            <p class="hero-desc"><?= e($profile['summary']); ?></p>

            <div class="terminal-line">
                <span class="prompt">$</span><span id="typed"></span><span class="cursor"></span>
            </div>

            <div class="hero-btns">
                <?php if ($instagramUrl): ?>
                    <a href="<?= e($instagramUrl); ?>" target="_blank" class="btn-mag acc" data-magnetic>
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                <?php endif; ?>
                <?php if ($linkedinUrl): ?>
                    <a href="<?= e($linkedinUrl); ?>" target="_blank" class="btn-mag ghost" data-magnetic>
                        <i class="bi bi-linkedin"></i> LinkedIn
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <div id="stats">
        <div class="stats-inner">
            <div class="stat-item reveal">
                <div class="stat-num" data-target="<?= count($experiences); ?>">0</div>
                <div class="stat-label">EXPERIENCES</div>
            </div>
            <div class="stat-item reveal" style="transition-delay:.1s">
                <div class="stat-num" data-target="<?= count($certificates); ?>">0</div>
                <div class="stat-label">CERTIFICATES</div>
            </div>
            <div class="stat-item reveal" style="transition-delay:.2s">
                <div class="stat-num" data-target="<?= count($skills); ?>">0</div>
                <div class="stat-label">SKILLS TRACKED</div>
            </div>
        </div>
    </div>

    <div class="divider-wrap" style="background:var(--bg);">
        <svg viewBox="0 0 1440 48" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0 L1440 48 L1440 0 Z" fill="#0d1520"/>
        </svg>
    </div>

    <section id="about">
        <div class="reveal">
            <p class="section-label">// about_me</p>
            <h2 class="section-title">Who Am I?</h2>
            <div class="section-line"></div>
        </div>
        <p class="about-desc"><?= nl2br(e($profile['about'])); ?></p>

        <div class="about-grid">
            <div class="panel reveal" id="skill-panel" style="transition-delay:.1s">
                <p class="panel-title">SKILLS</p>
                <?php if (count($skills) === 0): ?>
                    <p class="empty-note">// no skills found</p>
                <?php else: ?>
                    <?php foreach ($skills as $s): ?>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name"><?= e($s['skill_name']); ?></span>
                                <span class="skill-pct"><?= (int)$s['percentage']; ?>%</span>
                            </div>
                            <div class="skill-track">
                                <div class="skill-fill <?= $colorMap[$s['color_class']] ?? 'f-blue'; ?>" data-pct="<?= (int)$s['percentage']; ?>"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="panel reveal" style="transition-delay:.2s">
                <p class="panel-title">EXPERIENCE</p>
                <?php if (count($experiences) === 0): ?>
                    <p class="empty-note">// no experiences found</p>
                <?php else: ?>
                    <?php foreach ($experiences as $exp): ?>
                        <div class="exp-item">
                            <div class="exp-bullet"></div>
                            <p class="exp-text"><?= e($exp['content']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="panel reveal" style="margin-top:24px;transition-delay:.3s">
            <p class="panel-title">TOOLS & TECH</p>
            <div class="tools-grid">
                <?php foreach ($tools as $tool): ?>
                    <span class="tool-chip"><i class="bi <?= e($tool['icon']); ?>"></i> <?= e($tool['label']); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="divider-wrap" style="background:var(--surface);">
        <svg viewBox="0 0 1440 48" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48 L1440 0 L1440 48 Z" fill="#080d14"/>
        </svg>
    </div>

    <section id="certificates">
        <div class="reveal">
            <p class="section-label">// certificates</p>
            <h2 class="section-title">Credentials</h2>
            <div class="section-line"></div>
        </div>

        <div class="cert-grid">
            <?php if (count($certificates) === 0): ?>
                <p class="empty-note">// no certificates found</p>
            <?php else: ?>
                <?php foreach ($certificates as $i => $cert): ?>
                    <div class="cert-card reveal" style="transition-delay:<?= $i * 0.08; ?>s">
                        <div class="cert-img-wrap">
                            <?php if (!empty($cert['image_path'])): ?>
                                <img src="<?= e($cert['image_path']); ?>" alt="<?= e($cert['title']); ?>" onerror="this.parentElement.innerHTML='<div class=cert-placeholder>???</div>'">
                            <?php else: ?>
                                <div class="cert-placeholder">???</div>
                            <?php endif; ?>
                        </div>
                        <div class="cert-body">
                            <span class="cert-tag">CERTIFICATE</span>
                            <h3 class="cert-title"><?= e($cert['title']); ?></h3>
                            <p class="cert-desc"><?= e($cert['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p class="footer-copy">&copy; 2025 <span><?= e($profile['name']); ?></span> — Portfolio</p>
        <div class="footer-links">
            <?php foreach ($socialLinks as $link): ?>
                <a href="<?= e($link['url']); ?>" target="_blank"><i class="<?= e($link['icon_class']); ?>"></i></a>
            <?php endforeach; ?>
            <a href="mailto:"><i class="bi bi-envelope"></i></a>
        </div>
    </footer>

    <script src="script.js?v=<?= filemtime('script.js'); ?>" defer></script>
</body>
</html>

