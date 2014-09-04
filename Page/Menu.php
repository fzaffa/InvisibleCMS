<?php

class Menu {

    protected $db;
    public $menuArray;
    public $menuHTML;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMenu()
    {
        $this->db->query('SELECT slug, title FROM pages WHERE inmenu = 1');
        $this->menuArray = $this->db->resultSet(PDO::FETCH_ASSOC);

        return $this;
    }

    public function menuPresenter()
    {
        $this->menuHTML = "<ul>";
        foreach ($this->menuArray as $item)
        {
            $this->menuHTML .= "<li><a href='" . $item['slug'] . "'>" . $item['title'] . "</a></li>";
        }
        $this->menuHTML .= "</ul>";

        return $this->menuHTML;
    }
}