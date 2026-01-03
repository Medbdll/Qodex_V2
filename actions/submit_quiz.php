<?php
require_once '../config/database.php';
require_once '../classes/Database.php';
require_once '../classes/Security.php';
require_once '../classes/Result.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode incorrecte']);
    exit();
}
if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
    echo json_encode(['success' => false, 'message' => 'Sécurité invalide']);
    exit();
}

$quizId = intval($_POST['quiz_id'] ?? 0);
$studentId = intval($_POST['student_id'] ?? 0);
$score = intval($_POST['score'] ?? 0);
$totalQuestions = intval($_POST['total_questions'] ?? 0);

if ($quizId <= 0 || $studentId <= 0 || $totalQuestions <= 0) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit();
}

if ($studentId !== $_SESSION['user_id']) {
    echo json_encode(['success' => false, 'message' => 'Accès refusé']);
    exit();
}

$resultObj = new Result();
$resultId = $resultObj->save($quizId, $studentId, $score, $totalQuestions);

if ($resultId) {
    echo json_encode([
        'success' => true,
        'message' => 'Quiz soumis avec succès',
        'result_id' => $resultId,
        'score' => $score,
        'total_questions' => $totalQuestions
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l\'enregistrement'
    ]);
}
?>