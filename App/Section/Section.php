<?php namespace Invisible\Section;

use Fzaffa\System\Database;

class Section {

    public $id;
    public $title;
    public $body;
    public $page_id;
    //protected $db;

    public function __construct($page_id = null)
    {
        //$this->db = new Database;
        $this->page_id = $page_id;
    }

    public function prepareForDisplay()
    {
        unset(/*$this->db, */$this->page_id);
    }



    public function fill($input)
    {
        if (isset($input['id']) && $input['id'] == '') unset($input['id']);
        foreach ($input as $key => $value)
        {
            $this->{$key} = $value;
        }

        return $this;
    }
}