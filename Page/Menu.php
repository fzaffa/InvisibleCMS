<?php
class Menu {
    protected $db;
    public $menuArray;
    public $menuHTML;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=mycms;charset=utf8', 'homestead', 'secret');
    }

    public function getMenu()
    {
        $this->menuArray = $this->db->query('SELECT slug, title FROM pages WHERE inmenu = 1');
        $this->menuArray = $this->menuArray->fetchAll(PDO::FETCH_ASSOC);
        return $this;
    }

    public function menuPresenter()
    {
        $this->menuHTML = "<ul>";
        foreach($this->menuArray as $item){
           $this->menuHTML .= "<li><a href='".$item['slug']."'>".$item['title']."</a></li>";
        }
        $this->menuHTML .= "</ul>";

        return $this->menuHTML;
    }
}