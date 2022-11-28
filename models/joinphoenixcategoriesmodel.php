<?php

  class JoinPhoenixCategoriesModel extends Model{

    private $phoenixId;
    private $title;
    private $categoryId;
    private $date;
    private $userId;
    private $nameCategory;
    private $color;

    public function __construct()
    {
      parent::__construct();
    }

    public function getAll($userid){
      $items = [];

      try{
        $query = $this->prepare('SELECT phoenix.id as phoenix_id, title, category_id, date, id_user, categories.id, name, color FROM phoenix INNER JOIN categories WHERE phoenix.categories_id = categories.id AND phoenix.id_user = :userid ORDER BY DATE');
        $query->execute([
          'userid' => $userid
        ]);

        while($p = $query->fetch(PDO::FETCH_ASSOC)){
          $item = new JoinPhoenixCategoriesModel();
          $item->from($p);
          array_push($items, $item);
        }

        return $items;

      }catch(PDOException $e){

      }
    }

    public function from($array){
      $this->phoenixId      = $array['phoenix_id'];
      $this->title          = $array['title'];
      $this->categoryId     = $array['category_id'];
      $this->date           = $array['date'];
      $this->userId         = $array['id_user'];
      $this->nameCategory   = $array['name'];
      $this->color          = $array['color'];
    }

    public function toArray(){
      $array = [];
      $array['id']          = $this->phoenixId;
      $array['title']       = $this->title;
      $array['category_id'] = $this->categoryId;
      $array['date']        = $this->date;
      $array['id_user']     = $this->userId;
      $array['name']        = $this->nameCategory;
      $array['color']       = $this->color;

      return $array;
    }



    public function getPhoenixId(){return $this->phoenixId;}
    public function getTitle(){return $this->title;}
    public function getCategoryId(){return $this->categoryId;}
    public function getDate(){return $this->date;}
    public function getUserId(){return $this->userId;}
    public function getNameCategory(){return $this->nameCategory;}
    public function getColor(){return $this->color;}

    public function setPhoenixId($value){$this->phoenixId = $value;}
    public function setTitle($value){$this->title = $value;}
    public function setCategoryId($value){$this->categoryId = $value;}
    public function setDate($value){$this->date = $value;}
    public function setUserId($value){$this->userId = $value;}
    public function setNameCategory($value){$this->nameCategory = $value;}
    public function setColor($value){$this->color = $value;}
  }

?>