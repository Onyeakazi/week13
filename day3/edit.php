<?php
require_once 'config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch existing record
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim(htmlspecialchars($_POST['title'] ?? ''));
    $content = trim(htmlspecialchars($_POST['content'] ?? ''));

    if (empty($title) || empty($content)) {
        $error = 'Both Title and Content are required fields.';
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        header("Location: index.php?status=updated");
        exit;
    }
}

require_once 'includes/header.php';
?>

<div class="max-w-2xl mx-auto bg-gray-800 border border-gray-700 p-8 rounded shadow-lg">
  <h1 class="text-2xl font-bold mb-6">Edit Blog Post</h1>

  <?php if (!empty($error)): ?>
    <div class="mb-4 p-3 bg-red-900/60 border border-red-600 text-red-200 rounded text-sm">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="edit.php?id=<?= $post['id'] ?>">
    <div class="mb-4">
      <label class="block text-gray-300 font-semibold mb-2">Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required class="w-full bg-gray-900 border border-gray-700 rounded p-3 text-white focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-6">
      <label class="block text-gray-300 font-semibold mb-2">Content</label>
      <textarea name="content" rows="6" required class="w-full bg-gray-900 border border-gray-700 rounded p-3 text-white focus:outline-none focus:border-blue-500"><?= htmlspecialchars($post['content']) ?></textarea>
    </div>

    <div class="flex gap-4">
      <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 text-white px-5 py-2.5 rounded font-semibold transition">Save Changes</button>
      <a href="index.php" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-5 py-2.5 rounded font-semibold transition">Cancel</a>
    </div>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>