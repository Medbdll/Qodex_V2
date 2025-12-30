           <?php

            require_once '../../config/database.php';
            $currentPage = 'available_quizzes';
            ?>
           <!-- Category Quizzes List -->
           <?php include '../partials/header.php'; ?>
           <?php include '../partials/nav_etudiant.php'; ?>
           <div id="categoryQuizzes" class="student-section ">
               <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
                   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                       <button class="text-white hover:text-green-100 mb-4">
                           <i class="fas fa-arrow-left mr-2"></i>Retour aux catégories
                       </button>
                       <h1 class="text-4xl font-bold mb-2" id="categoryTitle">HTML/CSS</h1>
                       <p class="text-xl text-green-100">Sélectionnez un quiz pour commencer</p>
                   </div>
               </div>

               <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                   <div id="quizListContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                       <!-- Quiz cards will be loaded dynamically -->
                   </div>
               </div>
           </div>