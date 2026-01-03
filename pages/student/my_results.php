<?php
require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Security.php';
require_once '../../classes/Result.php';

Security::requireStudent();

$resultId = intval($_GET['result_id'] ?? 0);
$studentId = $_SESSION['user_id'];

$resultObj = new Result();
$result = $resultObj->getById($resultId, $studentId);

$percentage = ($result['score'] / $result['total_questions']) * 100;

if ($percentage >= 80) {
    $message = 'Excellent !';
    $color = 'green';
} elseif ($percentage >= 60) {
    $message = 'Bien joué !';
    $color = 'yellow';
} else {
    $message = 'Continue !';
    $color = 'red';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat - Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

<div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">

    <div class="text-6xl mb-4">
        <?php if ($percentage >= 80): ?>
            🎉
        <?php elseif ($percentage >= 60): ?>
            👍
        <?php else: ?>
            💪
        <?php endif; ?>
    </div>
    
    <h1 class="text-3xl font-bold mb-2 text-<?= $color ?>-600"><?= $message ?></h1>
    <p class="text-gray-600 mb-6"><?= htmlspecialchars($result['quiz_titre']) ?></p>
    
    <div class="bg-<?= $color ?>-100 rounded-lg p-6 mb-6">
        <div class="text-5xl font-bold text-<?= $color ?>-600 mb-2">
            <?= round($percentage) ?>%
        </div>
        <div class="text-gray-600">
            <?= $result['score'] ?> bonnes réponses sur <?= $result['total_questions'] ?>
        </div>
    </div>
    
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-green-100 rounded p-3">
            <div class="text-2xl font-bold text-green-600"><?= $result['score'] ?></div>
            <div class="text-sm text-gray-600">Correctes</div>
        </div>
        <div class="bg-red-100 rounded p-3">
            <div class="text-2xl font-bold text-red-600"><?= $result['total_questions'] - $result['score'] ?></div>
            <div class="text-sm text-gray-600">Erreurs</div>
        </div>
    </div>
    
    <div class="space-y-3">
        <a href="dashboard.php" 
           class="block w-full px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700">
            <i class="fas fa-home mr-2"></i>Retour au tableau de bord
        </a>
        <a href="results.php" 
           class="block w-full px-6 py-3 border border-gray-300 rounded hover:bg-gray-50">
            <i class="fas fa-chart-bar mr-2"></i>Voir tous mes résultats
        </a>
    </div>
</div>

</body>
</html>