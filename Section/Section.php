<?php
class Section {
    public $id;
    public $title;
    public $body;
    public $page_id;
    protected $db;

    public function __construct($page_id = null)
    {
        $this->db = new Database;
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
                              VALUES (:title, :body, :page_id)");
            $this->db->bind(':title', $this->title);
            $this->db->bind(':body', $this->body  );
            $this->db->bind(':page_id', $this->page_id);
            $this->db->execute();
            return;
        }
        $this->db->query("UPDATE sections
                          SET title = :title, body = :body
                          WHERE id = :id");
        $this->db->bind(':title', $this->title);
        $this->db->bind(':body', $this->body  );
        $this->db->bind(':id', $this->id);
        $this->db->execute();
        return;
    }

    public function delete()
    {
        $this->db->query("DELETE FROM sections WHERE id = :id");
        $this->db->bind(':id', $this->id);
    }
    public function fill($input)
    {
        if(isset($input['id']) && $input['id']=='') unset($input['id']);
        foreach($input as $key => $value)
        {
            $this->{$key} = $value;
        }
        return $this;
    }
}