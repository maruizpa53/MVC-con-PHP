<?php
  require_once 'model/phoenixmodel.php';
  require_once 'model/categoriesmodel.php';

  class Phoenix extends SessionController{

    private $user;

    function __construct()
    {
      parent::__construct();

      $this->user = $this->getUserSessionData();
    }

    function render(){
      $this->view->render('phoenix/index', [
        'user' => $this->user
      ]);
    }

    function newPhoenix(){
      if(!$this->existPOST(['title', 'category', 'date'])){
        $this->redirect('dashboard', []); //TODO: ERROR
      }

      if($this->user == NULL){
        $this->redirect('dashboard', []); //TODO: ERROR
        return;
      }

      $phoenix = new PhoenixModel;

      $phoenix->setTitle($this->getPost('title'));
      $phoenix->setCategoryId($this->getPost('category'));
      $phoenix->setDate($this->getPost('date'));
      $phoenix->setUserId($this->user->getId());

      $phoenix->save();
      $this->redirect('dashboard', []); //TODO: Success
    }

    function create(){
      $categories = new CategoriesModel();
      $this->view->render('phoenix/create', [
        'categories'=> $categories->getAll,
        'user' => $this->user
      ]);
    }

    function getCategoriesId(){
      $joinModel = new JoinPhoenixCategoriesModel();
      $categories = $joinModel->getAll($this->user->getId());
      $res = [];

      foreach($categories as $cat){
          array_push($res, $cat->getCategoryId());
      }
      $res = array_values(array_unique($res));

      return $res;
    }

    private function getDateList(){
      $months = [];
      $res = [];
      $joinModel = new JoinPhoenixCategoriesModel();
      $phoenix = $joinModel->getAll($this->user->getId());

      foreach($phoenix as $phoeni){
          array_push($months, substr($phoeni->getDate(), 0, 7));
      }
      $months = array_values(array_unique($months));

      if(count($months) > 3){
        array_push($res, array_pop($months));
        array_push($res, array_pop($months));
        array_push($res, array_pop($months));
      }

      return $res;
    }

    function getCategoryList(){
      $res = [];
      $joinModel = new JoinPhoenixCategoriesModel();
      $phoenix = $joinModel->getAll($this->user->getId());

      foreach ($phoenix as $phoeni){
        array_push($res, $phoeni->getNameCategory());
      }
      $res = array_values(array_unique($res));

      return $res;
    }

    function getCategoryColorList(){
      $res = [];
      $joinModel = new JoinPhoenixCategoriesModel();
      $phoenix = $joinModel->getAll($this->user->getId());
      
      foreach ($phoenix as $phoeni){
        array_push($res, $phoeni->getNameColor());
      }
      $res = array_unique($res);
      $res = array_values(array_unique($res));

      return $res;
    }

    function getHistoryJSON(){
      header('Content-Type: application/json');
      $res = [];
      $joinModel = new JoinPhoenixCategoriesModel();
      $phoenix = $joinModel->getAll($this->user->getId());

      foreach ($phoenix as $phoeni){
        array_push($res, $phoeni->toArray());
      }

      echo json_encode($res);
    }

    function delete($params){
      if($params == NULL){
        $this->redirect('phoenix', []); //TODO: Error
      }
      $id = $params[0];
      $res = $this->model->delete($id);

      if($res){
        $this->redirect('phoenix', []); //TODO: Success
      }else{
        $this->redirect('phoenix', []); //TODO: Error
      }
    }

        /*/ Estructura con diferentes funciónes 

    function getPhoenixJSON(){
      header('Content-Type: application/json');

      $res = [];
      $categoryIds = $this->getCategoriesId();
      $categoryNames = $this->getCategoryList();
      $categoryColors = $this->getCategoryColorList();

      array_unshift($categoryNames, 'mes');
      array_unshift($categoryColors, 'categories');

      $months = $this->getDateList();

      for($i = 0; $i < count($months); $i++){
        $item = array($months[$i]);
        for($j = 0; $j < count($categoryIds); $j++){
          $total = $this->getTotalByMonthAndCategory($months[$i], $categoryIds[$j]);
          array_push($item, $total);
        }
        array_push($res, $item);
      }
      array_unshift($res, $categoryNames);
      array_unshift($res, $categoryColors);

      echo json_encode($res);
    } /Min: 30:00*/ 
  }
?>