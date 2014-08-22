<?php
class Section {
    public $id;
    public $title;
    public $body;
    public $page_id;
    protected $db;

    public function __construct($page_id = null)
    {
        $this->db = new PDO('mysql:host=localhost;dbname=mycms;charset=utf8', 'homestead', 'secret');
        $this->page_id = $page_id;
    }
    public function prepareForDisplay()
    {
        unset($this->db, $this->page_id);
    }
    public function save()
    {
        if (!$this->id)
        {
            $this->db->query("INSERT INTO sections (title, body, page_id)
                              VALUES ('$this->title', '$this->body', '".$this->page_id."')");
            return;
        }
        $this->db->query("UPDATE sections
                          SET title = '$this->title', body = '$this->body'
                          WHERE id = '$this->id'");
        return;
    }

    public function delete()
    {
        try {
            $this->db->query("DELETE FROM sections WHERE id = '" . $this->id . "'");
        } catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }

    }
    public function fill($input)
    {
        unset($_POST['submit']);
        $input['inmenu'] = ($input['inmenu'] == '1') ? 1 : 0;
        if(isset($input['id']) && $input['id']=='') unset($input['id']);
        foreach($input as $key => $value)
        {
            $this->{$key} = $value;
        }
        return $this;
    }
}