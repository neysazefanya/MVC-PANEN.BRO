<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['karyawan', 'admin'])) {
    header("Location: index.php?action=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
           
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .main-content {
          background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            padding: 40px;
            margin: 30px;
            backdrop-filter: blur(8px);
        }

        h2 {
            color: #f0fdf4;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .breadcrumb-title {
            font-weight: 600;
            font-size: 18px;
            color:rgb(25, 185, 73);
        }

        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color:rgb(45, 187, 64);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #f0fdf4;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #d1fae5;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            border-color: #bbf7d0;
            box-shadow: none;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .btn-success {
            background-color: #16a34a;
            border-color: #15803d;
        }

        .btn-success:hover {
            background-color: #15803d;
            border-color: #065f46;
        }

        .alert {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .page-breadcrumb {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

        <main class="w-100">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-4 mt-3 px-3">
                <div class="breadcrumb-title"><i class="fas fa-user-circle me-2"></i>Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php?action=jadwal-saya">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End Breadcrumb -->

            <div class="main-content">
                <h2><i class="fas fa-user-edit me-2"></i>Update Profil</h2>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form action="index.php?action=update-profile" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email aktif" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?= htmlspecialchars($user['username'] ?? '') ?>">
                        </div>
                        <?php if ($_SESSION['user']['role'] !== 'admin'): ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Availability Time</label>
                                <input type="text" name="availability_time" class="form-control" placeholder="Contoh: 08:00 - 16:00" value="<?= htmlspecialchars($user['availability_time'] ?? '') ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="form-control" placeholder="********">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
