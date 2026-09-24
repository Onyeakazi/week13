<?php
require_once 'config/db.php';
require_once 'includes/header.php';

// Fetch all blog posts sorted newest first
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (isset($_GET['status'])): ?>
  <div class="mb-6 p-4 rounded bg-green-900/60 border border-green-600 text-green-200">
    <?php
      if ($_GET['status'] === 'created') echo "✅ Blog post published successfully!";
      elseif ($_GET['status'] === 'updated') echo "✏️ Blog post updated successfully!";
      elseif ($_GET['status'] === 'deleted') echo "🗑️ Blog post deleted successfully!";
    ?>
  </div>
<?php endif; ?>

<div class="flex justify-between items-center mb-6">
  <h1 class="text-3xl font-bold">All Blog Posts</h1>
  Total Posts: <?= count($posts) ?>
</div>

<?php if (empty($posts)): ?>
  <div class="bg-gray-800 border border-gray-700 p-8 rounded text-center text-gray-400">
    <p>No blog posts found. Click <strong>+ New Post</strong> above to publish your first article!</p>
  </div>
<?php else: ?>
  <div class="grid gap-6">
    <?php foreach ($posts as $post): ?>
      <div class="bg-gray-800 border border-gray-700 p-6 rounded shadow-lg flex justify-between items-start">
        <div class="pr-4">
          <h2 class="text-2xl font-bold text-blue-400 mb-2"><?= htmlspecialchars($post['title']) ?></h2>
          <p class="text-gray-300 mb-4 whitespace-pre-line"><?= htmlspecialchars($post['content']) ?></p>
          <small class="text-gray-500">Posted on: <?= $post['created_at'] ?></small>
        </div>
        <div class="flex gap-2 shrink-0">
          <a href="edit.php?id=<?= $post['id'] ?>" class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1.5 rounded text-xs font-semibold">Edit</a>
          <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this post?');">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1.5 rounded text-xs font-semibold">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>