<?php
/**
 * PARTIAL: Navigation Etudiant
 * Barre de navigation pour les Etudiants
 */
require_once '../../classes/Security.php';

// Calculer les initiales
$userName = $userName ?? $_SESSION['user_nom'] ?? 'User';
$initials = strtoupper(substr($userName, 0, 1) . substr(explode(' ', $userName)[1] ?? '', 0, 1));

// Déterminer le chemin de base selon l'emplacement du fichier
$basePath = '';
if (strpos($_SERVER['PHP_SELF'], '/student/') !== false) {
    $basePath = '../';
}
?>
<!-- Navigation Etudiant -->
<nav class="bg-white shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-green-600"></i>
                    <span class="ml-2 text-2xl font-bold text-gray-900">Qodex</span>
                    <span class="ml-3 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Etudiant</span>
                </div>
                
                <!-- Menu Principal -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <!-- Dashboard -->
                    <a href="<?= $basePath ?>student/dashboard.php" 
                       class="<?= ($currentPage ?? '') === 'dashboard2' ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <i class="fas fa-home mr-2"></i>Tableau de bord
                    </a>
                    
                    <!-- Mes Quiz -->
                    <a href="<?= $basePath ?>student/available_quizzes.php" 
                       class="<?= ($currentPage ?? '') === 'available_quizzes' ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <i class="fas fa-folder mr-2"></i>Mes Quiz
                    </a>
                    
                    <!-- Mes Résultats -->
                    <a href="<?= $basePath ?>student/my_results.php" 
                       class="<?= ($currentPage ?? '') === 'resultats' ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Mes Résultats
                    </a>
                </div>
            </div>
            
            <!-- Profil & Déconnexion -->
            <div class="flex items-center">
                <div class="flex items-center space-x-4">
                    <!-- Avatar -->
                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold">
                        <?= $initials ?>
                    </div>
                    
                    <!-- Nom (caché sur mobile) -->
                    <div class="hidden md:block">
                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($userName) ?></div>
                        <div class="text-xs text-green-500">Etudiant</div>
                    </div>
                    
                    <!-- Bouton Déconnexion -->
                    <a href="<?= $basePath ?>auth/logout.php?token=<?= Security::generateCSRFToken() ?>" 
                       class="text-red-600 hover:text-red-700" title="Déconnexion">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
