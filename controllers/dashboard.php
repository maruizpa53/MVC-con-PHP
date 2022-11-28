<?php

require_once 'models/phoenixmodel.php';
require_once 'models/categoriesmodel.php'; 
class Dashboard extends SessionController{

  private $user;

  function __construct(){
      parent::__construct();
      $this->user = $this->getUserSessionData();
      error_log('Dashboard::construct -> Inicio de Dashboard');
  }

  function render(){
    error_log('Dashboard::render -> Carga el index deL Dashboard');

    $phoenixModel = new PhoenixModel();
    $phoenix = $this->getPhoenix(5);
    $categories = $this->getCategories();

    $this->view->render('dashboard/index', [
      'user' => $this->user,
      'phoenix' => $phoenix,
      'categories' => $categories
    ]);
  }

  private function getPhoenix($n = 0){
    if($n < 0) return NULL;

    $phoenix = new PhoenixModel();
    return $phoenix->getByUserIdAndLimit($this->user->getId(), $n);
  }

  private function getCategories(){
    $res = [];
    $categoriesModel = new CategoriesModel();
    $phoenixModel = new PhoenixModel();

    $categories = $categoriesModel->getAll();

    foreach($categories as $category){
      $categoryArray = [];
    }
    return $res;
  }

}
?>