       <?php
        // session_start();
        require_once '../../config/database.php';
        require_once '../../classes/Database.php';
        require_once '../../classes/Question.php';

        $id = $_GET["id"];
        $quizQue = new Question();
        $dataQuestions = $quizQue->getAllByQuiz($id);
        $titreQuestions = $quizQue->getQuizTitre($id);
        $totalQuestions = $quizQue->countByQuiz($id);
        ?>
       <!-- Quiz Taking Interface -->
       <?php include '../partials/header.php'; ?>
       <div id="takeQuiz" class="student-section ">
           <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
               <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                   <div class="flex justify-between items-center">
                       <div>
                           <?php foreach ($titreQuestions as $key): ?>
                               <h1 class="text-3xl font-bold mb-2" id="quizTitle"><?= $key['titre'] ?></h1>
                           <?php endforeach ?>
                           <p class="text-green-100">Question <span id="currentQuestion">1</span> sur <span id="totalQuestions"><?= $totalQuestions ?></span></p>
                       </div>
                       <div class="text-right">
                           <div class="text-sm text-green-100 mb-1">Temps restant</div>
                           <div class="text-3xl font-bold" id="timer">30:00</div>
                       </div>
                   </div>
               </div>
           </div>
           <?php foreach ($dataQuestions as $key): ?>
               <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                   <div class="bg-white rounded-xl shadow-lg p-8">
                       <h3 class="text-2xl font-bold text-gray-900 mb-6" id="questionText">
                           <?= $key['question'] ?>
                       </h3>

                       <div class="space-y-4">
                           <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                               <div class="flex items-center">
                                   <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 option-radio">
                                       <div class="w-4 h-4 rounded-full bg-green-600 hidden option-selected"></div>
                                   </div>
                                   <span class="text-lg"><?= $key['option1'] ?></span>
                               </div>
                           </div>

                           <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                               <div class="flex items-center">
                                   <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 option-radio">
                                       <div class="w-4 h-4 rounded-full bg-green-600 hidden option-selected"></div>
                                   </div>
                                   <span class="text-lg"><?= $key['option2'] ?></span>
                               </div>
                           </div>

                           <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                               <div class="flex items-center">
                                   <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 option-radio">
                                       <div class="w-4 h-4 rounded-full bg-green-600 hidden option-selected"></div>
                                   </div>
                                   <span class="text-lg"><?= $key['option3'] ?></span>
                               </div>
                           </div>

                           <div class="answer-option p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                               <div class="flex items-center">
                                   <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 option-radio">
                                       <div class="w-4 h-4 rounded-full bg-green-600 hidden option-selected"></div>
                                   </div>
                                   <span class="text-lg"><?= $key['option4'] ?></span>
                               </div>
                           </div>
                       </div>
                       <div class="flex justify-between mt-8">
                           <button class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                               <i class="fas fa-arrow-left mr-2"></i>Précédent
                           </button>
                           <button class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                               Suivant<i class="fas fa-arrow-right ml-2"></i>
                           </button>
                       </div>
                   </div>
               </div>
           <?php endforeach ?>
       </div>