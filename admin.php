<?php
require __DIR__ . '/config/koneksi.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

function e($value)
{
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

$flash = null;
$status = $_GET['status'] ?? '';
if (is_string($status) && $status !== '') {
    $flashMap = [
        'skill_added' => ['type' => 'success', 'text' => 'Skill berhasil ditambahkan.'],
        'skill_deleted' => ['type' => 'success', 'text' => 'Skill berhasil dihapus.'],
        'skill_failed' => ['type' => 'error', 'text' => 'Gagal menambah skill. Coba lagi.'],
        'exp_added' => ['type' => 'success', 'text' => 'Experience berhasil ditambahkan.'],
        'exp_deleted' => ['type' => 'success', 'text' => 'Experience berhasil dihapus.'],
        'exp_failed' => ['type' => 'error', 'text' => 'Gagal menambah experience. Coba lagi.'],
        'cert_added' => ['type' => 'success', 'text' => 'Certificate berhasil ditambahkan.'],
        'cert_deleted' => ['type' => 'success', 'text' => 'Certificate berhasil dihapus.'],
        'cert_failed' => ['type' => 'error', 'text' => 'Gagal menambah certificate. Pastikan file valid.']
    ];
    if (isset($flashMap[$status])) {
        $flash = $flashMap[$status];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - <?php echo e($profile['name']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Outfit:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
</head>

<body class="admin-page">

    <nav id="navbar">
        <div class="nav-brand"><span>&gt;_</span> <?php echo e($profile['name']); ?></div>
        <ul class="nav-links">
            <li><a href="index.php#home" class="nav-link">[ home ]</a></li>
            <li><a href="index.php#about" class="nav-link">[ about ]</a></li>
            <li><a href="index.php#certificates" class="nav-link">[ certs ]</a></li>
            <li><a href="admin.php" class="nav-link active">[ admin ]</a></li>
        </ul>
    </nav>

    <?php if ($flash) { ?>
        <div class="toast-wrap">
            <div class="toast-pop toast-<?php echo e($flash['type']); ?>" role="status" aria-live="polite">
                <span class="toast-dot" aria-hidden="true"></span>
                <span><?php echo e($flash['text']); ?></span>
            </div>
        </div>
    <?php } ?>

    <section id="admin" class="py-5 reveal">
        <div class="container">
            <h2 class="section-title text-center mb-3 anim-1">Admin (Tambah / Hapus)</h2>
            <p class="text-center mb-5 admin-lead anim-2">Bagian ini untuk menambah dan menghapus skill, experience, dan
                certificate.</p>

            <div class="row g-4 admin-grid">
                <div class="col-md-4">
                    <div class="sticker-card admin-card">
                        <div class="admin-card-title">
                            <span class="sticker-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
                            <h5 class="section-subtitle">Tambah Skill</h5>
                        </div>
                        <form action="actions/aksi_tambah_skill.php" method="post" class="d-grid gap-2">
                            <input type="text" name="skill_name" class="form-control" placeholder="Nama skill" required>
                            <input type="number" name="percentage" class="form-control" placeholder="Persentase (0-100)"
                                min="0" max="100" required>
                            <select name="color_class" class="form-select" required>
                                <option value="bg-primary">Biru (bg-primary)</option>
                                <option value="bg-info">Biru Muda (bg-info)</option>
                                <option value="bg-secondary">Abu (bg-secondary)</option>
                                <option value="bg-success">Hijau (bg-success)</option>
                                <option value="bg-warning">Kuning (bg-warning)</option>
                                <option value="bg-danger">Merah (bg-danger)</option>
                            </select>
                            <button type="submit" class="btn btn-candy">Tambah Skill</button>
                        </form>

                        <hr>
                        <h6>Hapus Skill</h6>
                        <div class="admin-list">
                            <ul class="experience-list">
                                    <?php foreach ($skills as $skill) { ?>
                                    <li>
                                        <span
                                            class="badge-pop <?php echo e($skill['color_class']); ?> text-white"><?php echo e($skill['percentage']); ?>%</span>
                                        <span class="admin-item-text"><?php echo e($skill['skill_name']); ?></span>
                                        <a class="btn btn-outline-candy btn-sm"
                                            href="actions/aksi_hapus_skill.php?id=<?php echo e($skill['id']); ?>"
                                            onclick="return confirm('Hapus skill ini?')">Hapus</a>
                                    </li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sticker-card admin-card">
                        <div class="admin-card-title">
                            <span class="sticker-icon"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
                            <h5 class="section-subtitle">Tambah Experience</h5>
                        </div>
                        <form action="actions/aksi_tambah_experience.php" method="post" class="d-grid gap-2">
                            <textarea name="content" class="form-control" rows="4" placeholder="Isi experience"
                                required></textarea>
                            <button type="submit" class="btn btn-candy">Tambah Experience</button>
                        </form>

                        <hr>
                        <h6>Hapus Experience</h6>
                        <div class="admin-list">
                            <ul class="experience-list">
                                    <?php foreach ($experiences as $exp) { ?>
                                    <li>
                                        <span class="badge-pop badge-pop-accent">EXP</span>
                                        <span class="admin-item-text"><?php echo e($exp['content']); ?></span>
                                        <a class="btn btn-outline-candy btn-sm"
                                            href="actions/aksi_hapus_experience.php?id=<?php echo e($exp['id']); ?>"
                                            onclick="return confirm('Hapus experience ini?')">Hapus</a>
                                    </li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sticker-card admin-card">
                        <div class="admin-card-title">
                            <span class="sticker-icon"><i class="bi bi-award" aria-hidden="true"></i></span>
                            <h5 class="section-subtitle">Tambah Certificate</h5>
                        </div>
                        <form action="actions/aksi_tambah_certificate.php" method="post" enctype="multipart/form-data"
                            class="d-grid gap-2">
                            <input type="text" name="title" class="form-control" placeholder="Judul certificate"
                                required>
                            <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi"
                                required></textarea>
                            <label class="file-input">
                                <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp"
                                    required>
                                <span class="file-btn">Choose File</span>
                                <span class="file-name" data-default="No file chosen">No file chosen</span>
                            </label>
                            <button type="submit" class="btn btn-candy">Tambah Certificate</button>
                        </form>

                        <hr>
                        <h6>Hapus Certificate</h6>
                        <div class="admin-list">
                            <ul class="experience-list">
                                    <?php foreach ($certificates as $cert) { ?>
                                    <li>
                                        <span class="badge-pop badge-pop-secondary">CERT</span>
                                        <span class="admin-item-text"><?php echo e($cert['title']); ?></span>
                                        <a class="btn btn-outline-candy btn-sm"
                                            href="actions/aksi_hapus_certificate.php?id=<?php echo e($cert['id']); ?>"
                                            onclick="return confirm('Hapus certificate ini?')">Hapus</a>
                                    </li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-4 footer-pop">
        &copy; 2025 <?php echo e($profile['name']); ?> | Portfolio Website
    </footer>

    <script>
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealTargets = document.querySelectorAll('.sticker-card, .form-control, .form-select, .btn, .section-title');

        revealTargets.forEach((el) => el.classList.add('reveal'));
        document.querySelectorAll('.sticker-card').forEach((el) => el.classList.add('is-card'));
        document.querySelectorAll('.section-title').forEach((el) => el.classList.add('is-title'));
        document.querySelectorAll('.btn').forEach((el) => el.classList.add('is-button'));

        function triggerPageAnim() {
            document.body.classList.remove('page-animate');
            void document.body.offsetWidth;
            document.body.classList.add('page-animate');
        }

        document.querySelectorAll('.file-input input[type="file"]').forEach((input) => {
            const wrapper = input.closest('.file-input');
            const label = wrapper ? wrapper.querySelector('.file-name') : null;
            const defaultText = label ? label.getAttribute('data-default') : '';
            input.addEventListener('change', () => {
                if (!label) return;
                const file = input.files && input.files[0] ? input.files[0].name : '';
                label.textContent = file || defaultText;
            });
        });

        const toast = document.querySelector('.toast-pop');
        if (toast) {
            setTimeout(() => toast.classList.add('show'), 60);
            setTimeout(() => toast.classList.add('hide'), 3200);
        }

        if (!prefersReduced) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            document.querySelectorAll('.reveal').forEach((el, idx) => {
                el.style.transitionDelay = `${Math.min(idx * 0.1, 0.3)}s`;
                observer.observe(el);
            });
        } else {
            document.querySelectorAll('.reveal').forEach((el) => el.classList.add('reveal-in'));
        }

        window.addEventListener('load', triggerPageAnim);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
