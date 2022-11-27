<?php

  class PhoenixModel extends Model implements IModel{

    private $id;
    private $title;
    private $categoryid;
    private $date;
    private $userid;

    public function setId($id){ $this->id = $id; }
    public function setTitle($title){ $this->title = $title; }
    public function setCategoryId($categoryid){ $this->categoryid = $categoryid; }
    public function setDate($date){ $this->date = $date; }
    public function setUserId($userid){ $this->userid = $userid; }

    public function getId(){ return $this->id;}
    public function getTitle(){ return $this->title; }
    public function getCategoryId(){ return $this-> categoryid; }
    public function getDate(){ return $this->date; }
    public function getUserId(){ return $this->userid; }

    public function __construct(){
      parent::__construct();
    }

    public function save(){
      try{
        $query = $this->prepare('INSERT INTO phoenix (title, category_id, date, id_user) VALUES(:title, :category, :d, :user)');
        $query->execute([
          'title' => $this->title,
          'category' => $this->categoryid,
          'user' => $this->userid,
          'd' => $this->date
        ]);
        if($query->rowCount()) return true;
        return false;
      }catch(PDOException $e){
        return false;
      }
    }
    public function getAll(){
      $items = [];
      try{
        $query = $this->query('SELECT * FROM phoenix');

        while($p = $query->fetch(PDO::FETCH_ASSOC)){
          $item = new PhoenixModel();
          $item->from($p);

          array_push($items, $item);
        }

        return $items;

      }catch(PDOException $e){
        return false;
      }
    }
    public function get($id){
      try{
        $query = $this->prepare('SELECT * FROM phoenix WHERE id = :id');
        $query->execute([
          'id' => $id
        ]);
        $phoenix = $query->fetch(PDO::FETCH_ASSOC);
        $this->from($phoenix);

        return $this;

      }catch(PDOException $e){
        return false;
      }
    }
    public function delete($id){
      try{
        $query = $this->prepare('DELETE FROM phoenix WHERE id = :id');
        $query->execute([
          'id' => $id
        ]);
        return true;
      }catch(PDOException $e){
        return false;
      }
    }
    public function update(){
      try{
        $query = $this->prepare('UPDATE phoenix SET title = :title, category_id = :category, date = :d, id_user = user WHERE id = :id');
        $query->execute([
          'title' => $this->title,
          'category' => $this->categoryid,
          'user' => $this->userid,
          'd' => $this->date,
          'id' => $this->id
        ]);
        if($query->rowCount()) return true;
        return false;
      }catch(PDOException $e){
        return false;
      }
    }
    public function from($array){
      $this->id = $array['id'];
      $this->title = $array['title'];
      $this->categoryid = $array['category_id'];
      $this->date = $array['date'];
      $this->userid = $array['id_user'];
    }

    public function getByUserIdAndLimit($userid, $n){
      $items = [];
      try{
        $query = $this->prepare('SELECT * FROM phoenix WHERE id_user = :userid ORDER BY phoenix.date DESC LIMIT 0, :n');
        $query->execute([
          'userid' => $userid,
          'n' => $n
        ]);

        while($p = $query->fetch(PDO::FETCH_ASSOC)){
          $item = new PhoenixModel();
          $item->from($p);

          array_push($items, $item);
        }

        return $items;
      }catch(PDOException $e){
        return [];
      }
    }
  }
?>