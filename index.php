<?php
include 'db.php';

// Fetch all code snippets to display on the home page
$stmt = $pdo->query("SELECT * FROM snippets ORDER BY created_at DESC");
$snippets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Clipboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/themes/prism.css" rel="stylesheet" />
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        h1 { text-align: center; }
        pre { background-color: #f4f4f4; padding: 10px; }
        .snippet { margin-bottom: 20px; }
        .add-snippet { text-align: center; margin-top: 20px; }
        a { text-decoration: none; color: #333; }
        a:hover { color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Code Clipboard</h1>
        <div class="add-snippet">
            <a href="add_snippet.php">Add New Snippet</a>
        </div>

        <h2>Recent Snippets</h2>
        <?php if ($snippets): ?>
            <?php foreach ($snippets as $snippet): ?>
                <div class="snippet">
                    <h3><?= htmlspecialchars($snippet['title']) ?> (<?= htmlspecialchars($snippet['language']) ?>)</h3>
                    <pre><code class="language-<?= htmlspecialchars($snippet['language']) ?>"><?= htmlspecialchars($snippet['content']) ?></code></pre>
                    <p>Added on: <?= htmlspecialchars($snippet['created_at']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No snippets available. <a href="add_snippet.php">Add a new snippet</a></p>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/prism.min.js"></script>
</body>
</html>
