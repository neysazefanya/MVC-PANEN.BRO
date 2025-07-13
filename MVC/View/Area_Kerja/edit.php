<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Area Kerja</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        main {
            flex: 1;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Include Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>
        <main>
            <h3 class="mb-4">✏️ Edit Area Kerja</h3>
            <form method="POST">
                <input name="name" value="<?= htmlspecialchars($area['name']) ?>" class="form-control mb-3" required>
                <input name="size" value="<?= htmlspecialchars($area['size']) ?>" class="form-control mb-3" type="number" required>
                <input name="quantity_of_trees" value="<?= htmlspecialchars($area['quantity_of_trees']) ?>" class="form-control mb-3" required>
                <input name="type_of_soil" value="<?= htmlspecialchars($area['type_of_soil']) ?>" class="form-control mb-3" required>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="index.php?action=area" class="btn btn-secondary">Kembali</a>
            </form>
        </main>
    </div>
</body>
</html>
