<?php
require_once 'Section.php';
class Page {
    public $id;
    public $inmenu;
    public $title;
    public $body;
    public $template;
    public $sections = array();
    protected $db;
    function __construct()
    {
        $this->db = new Database;
    }

    public function fill(array $input)
    {

        if($input['id']=='') unset($input['id']);
        unset($input['sections']);
        foreach($input as $key => $value)
        {
            $this->{$key} = $value;
        }
        return $this;

    }

    public function save()
    {
        if (!$this->id)
        {
            $this->db->query("INSERT INTO pages (title, body, template, inmenu)
                              VALUES (':title', ':body', ':template', ':inmenu')");

            $this->db->bind(':title', $this->title);
            $this->db->bind(':body', $this->body);
            $this->db->bind(':template', $this->template);
            $this->db->bind(':inmenu', $this->inmenu);
            return;
        }
        $this->db->query("UPDATE pages
                          SET title = :title, body = :body, template = :template, inmenu = :inmenu
                          WHERE id = :id");

        $this->db->bind(':id', $this->id);
        $this->db->bind(':title', $this->title);
        $this->db->bind(':body', $this->body);
        $this->db->bind(':template', $this->template);
        $this->db->bind(':inmenu', $this->inmenu);

        if(!empty($this->sections))
        {
            foreach ($this->sections as $section)
            {
                if(!isset($section->_destroy))
                {
                    $section->save();
                } else {
                    $section->delete();
                }
            }
        }
        return;
    }

    public static function all()
    {
        $instance = new self;
        $instance->db->query('SELECT * FROM pages');
        $results = $instance->db->resultSet();
        $arr = array();
        foreach($results as $result)
        {
            $obj = new Page;
            $instance->castToObject($result, $obj);
            unset($obj->db);
            array_push($arr, $obj);
        }
        return $arr;
    }

    public function fillSections($input)
    {
        $sectionsarray = array();
        foreach($input as $section)
        {
            $sectionobj = new Section($this->id);
            $sectionobj->fill($section);
            array_push($sectionsarray, $sectionobj);
        }
        $this->sections = $sectionsarray;;
        return $this;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function hasPage($slug)
    {
        $this->db->query("SELECT COUNT(*) FROM pages WHERE title = :slug");
        $this->db->bind(':slug', $slug);
        $result = $this->db->getNumber();
        if($result>0) return true;
        return false;
    }

    /**
     * @param $slug
     * @return Page
     */
    public function getPageBySlug($slug)
    {
        $this->db->query("SELECT * FROM pages WHERE title = :slug");
        $this->db->bind(':slug', $slug);
        $result = $this->db->resultSet();
        return $this->castToObject($result[0]);

    }

    /**
     * @param array $data
     * @param null $obj
     * @return Page
     */
    private function castToObject(array $data, $obj = null)
    {
        $obj = ($obj) ? $obj : $this;
        foreach($data as $key => $value)
        {
            $obj->{$key} = $value;
        }

        return $obj;
    }

    /**
     * @return Page
     */
    public function getSections()
    {
        $this->db->query("SELECT * FROM sections WHERE page_id = :page_id");
        $this->db->bind(':page_id', $this->id);
        $result = $this->db->resultSet();
        $this->castSectionsToObject($result);
        return $this;
    }

    /**
     * @param array $sections
     * @return Page
     */
    private function castSectionsToObject(array $sections)
    {
        $arr = array();
        foreach ($sections as $section)
        {
            $obj = new Section;
            foreach($section as $key => $value)
            {
                $obj->{$key} = $value;
            }
            $obj->prepareForDisplay();
            $arr[$obj->title]  = $obj;
        }
        $this->sections = $arr;
        return $this;
    }

    /**
     * @param $title
     * @return bool
     */
    private function hasSection($title)
    {
        if(isset($this->sections[$title])) return true;
        return false;
    }

    /**
     * @param $title
     * @return string
     */
    public function displaySection($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->body : "Section ".$title." not found";
    }

    /**
     * @param $title
     * @return string
     */
    public function displaySectionTitle($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->title : "Section ".$title." not found";
    }
}
