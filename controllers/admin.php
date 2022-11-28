<?php

class Admin extends SessionController{

  function __construct()
  {
    parent::__construct();
  }

  function render(){
    $stats = $this->getStatistics();

    $this->view->render('admin/index', [
      'stats' => $stats
    ]);
  }

  function createCategory(){
    $this->view->render('admin/create-category');
  }

  function newCategory(){
    if($this->existPOST(['name', 'color'])){
      $name = $this->getPost('name');
      $color = $this->getPost('color');

      $categoriesModel = new CategoriesModel();

      if(!$categoriesModel->exists($name)){
          $categoriesModel->setName($name);
          $categoriesModel->setColor($color);
          $categoriesModel->save();

          $this->redirect('admin', []); //TODO: Success
      }else{
          $this->redirect('admin', []); //TODO: Error
      }
    }
  }

  private function getCategoryMostUsed($phoenix){
    $repeat = [];

    foreach($phoenix as $phoeni){
      if(!array_key_exists($phoeni->getCategoryId(),$repeat)){
        $repeat[$phoeni->getCategoryId()] = 0;
      }
      $repeat[$phoeni->getCategoryId()]++;
    }

    $categoryMostUsed = max($repeat);
    $categoryModel = new CategoriesModel();
    $categoryModel->get($categoryMostUsed);

    $category = $categoryModel->getName();

    return $category;
  }

  private function getCategoryLessUsed($phoenix){
    $repeat = [];

    foreach($phoenix as $phoeni){
      if(!array_key_exists($phoeni->getCategoryId(),$repeat)){
        $repeat[$phoeni->getCategoryId()] = 0;
      }
      $repeat[$phoeni->getCategoryId()]++;
    }

    $categoryMostUsed = min($repeat);
    $categoryModel = new CategoriesModel();
    $categoryModel->get($categoryMostUsed);

    $category = $categoryModel->getName();

    return $category;
  }

  function getStatistics(){
      $res = [];

      $userModel = new UserModel();
      $users = $userModel->getAll();

      $phoenixModel = new PhoenixModel();
      $phoenix = $phoenixModel->getAll();

      $categoriesModel = new CategoriesModel();
      $categories = $categoriesModel->getAll();

      $res['count-users'] = count ($users);
      $res['count-phoenix'] = count ($phoenix);

      $res['count-categories'] = count($categories);
      $res['mostused-categories'] = $this->getCategoryMostUsed($categories);
      $res['lessused-categories'] = $this->getCategoryLessUsed($categories);

      return $res;
  }
}