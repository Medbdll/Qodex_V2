<?php
require_once '../../config/database.php';
require_once '../../classes/Database.php';
require_once '../../classes/Security.php';
require_once '../../classes/Question.php';
require_once '../../classes/Quiz.php';

Security::requireStudent();

$quizId = intval($_GET['id'] ?? 0);
$studentId = $_SESSION['user_id'];
$quizObj = new Quiz();
$quiz = $quizObj->getById($quizId);
$questionObj = new Question();
$questions = $questionObj->getAllByQuiz($quizId);
$totalQuestions = count($questions);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quiz - <?= htmlspecialchars($quiz['titre']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">

<div class="bg-green-600 text-white p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold"><?= htmlspecialchars($quiz['titre']) ?></h1>
        <p>Question <span id="questionNumber">1</span> sur <?= $totalQuestions ?></p>
    </div>
</div>

<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 id="questionText" class="text-xl font-bold mb-6"></h2>
        <div id="optionsContainer" class="space-y-3"></div>
        
        <div class="flex justify-between mt-8">
            <button id="prevBtn" onclick="goToPrevious()" 
                    class="px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">
                ← Précédent
            </button>
            
            <button id="nextBtn" onclick="goToNext()" 
                    class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Suivant →
            </button>
            
            <button id="finishBtn" onclick="finishQuiz()" 
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 hidden">
                Terminer
            </button>
        </div>
    </div>
</div>

<script>

const questions = <?= json_encode($questions) ?>;
const quizId = <?= $quizId ?>;
const studentId = <?= $studentId ?>;
const csrfToken = '<?= Security::generateCSRFToken() ?>';

let currentIndex = 0;
let answers = {}; 
window.onload = function() {
    showQuestion(0);
};

function showQuestion(index) {
    const question = questions[index];
    
    document.getElementById('questionText').textContent = question.question;
    document.getElementById('questionNumber').textContent = index + 1;
    
    const container = document.getElementById('optionsContainer');
    container.innerHTML = ''; 
    
    for (let i = 1; i <= 4; i++) {
        const div = document.createElement('div');
        div.className = 'p-4 border-2 rounded cursor-pointer hover:bg-green-50';
        
        if (answers[question.id] === i) {
            div.className += ' border-green-500 bg-green-50';
        } else {
            div.className += ' border-gray-200';
        }
        
        div.onclick = function() { selectAnswer(question.id, i); };
        div.innerHTML = `
            <div class="flex items-center">
                <span class="w-8 h-8 rounded-full border-2 mr-3 flex items-center justify-center ${answers[question.id] === i ? 'bg-green-600 border-green-600 text-white' : 'border-gray-300'}">
                    ${answers[question.id] === i ? '✓' : i}
                </span>
                <span>${question['option' + i]}</span>
            </div>
        `;
        container.appendChild(div);
    }
    
    updateButtons();
}

function selectAnswer(questionId, optionNumber) {
    answers[questionId] = optionNumber;
    showQuestion(currentIndex); 
}

function goToNext() {
    if (currentIndex < questions.length - 1) {
        currentIndex++;
        showQuestion(currentIndex);
    }
}

function goToPrevious() {
    if (currentIndex > 0) {
        currentIndex--;
        showQuestion(currentIndex);
    }
}

function updateButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const finishBtn = document.getElementById('finishBtn');
    
    prevBtn.disabled = (currentIndex === 0);
    prevBtn.className = currentIndex === 0 ? 'px-6 py-2 bg-gray-200 rounded opacity-50' : 'px-6 py-2 bg-gray-300 rounded hover:bg-gray-400';
    
    if (currentIndex === questions.length - 1) {
        nextBtn.classList.add('hidden');
        finishBtn.classList.remove('hidden');
    } else {
        nextBtn.classList.remove('hidden');
        finishBtn.classList.add('hidden');
    }
}

function finishQuiz() {
    const answeredCount = Object.keys(answers).length;
    
    if (answeredCount < questions.length) {
        const confirm = window.confirm(
            `Vous avez répondu à ${answeredCount} questions sur ${questions.length}.\n` +
            `Voulez-vous vraiment terminer ?`
        );
        if (!confirm) return;
    }
    
    let score = 0;
    questions.forEach(function(q) {
        if (answers[q.id] === q.correct_option) {
            score++;
        }
    });
    
    const formData = new FormData();
    formData.append('csrf_token', csrfToken);
    formData.append('quiz_id', quizId);
    formData.append('student_id', studentId);
    formData.append('score', score);
    formData.append('total_questions', questions.length);
    
    fetch('../../actions/submit_quiz.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'my_results.php?result_id=' + data.result_id;
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(error => {
        alert('Erreur de connexion');
        console.error(error);
    });
}
</script>

</body>
</html>