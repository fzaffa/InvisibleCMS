<?php
class Page {
    public $id;
    public $inmenu;
    public $title;
    public $body;
    public $template;
    public $slug;
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
        $this->slug = strtolower(str_replace(' ', '-', $this->title));
        return $this;

    }

    public function save()
    {
        if (!$this->id)
        {
            $this->db->query("INSERT INTO pages (title, body, template, inmenu, slug)
                              VALUES (:title, :body, :template, :inmenu, :slug)");

            $this->db->bind(':title', $this->title);
            $this->db->bind(':body', $this->body);
            $this->db->bind(':template', $this->template);
            $this->db->bind(':inmenu', $this->inmenu);
            $this->db->bind(':slug', $this->slug);
            $this->db->execute();
            return;
        }
        $this->db->query("UPDATE pages
                          SET title = :title, body = :body, template = :template, inmenu = :inmenu, slug = :slug
                          WHERE id = :id");

        $this->db->bind(':id', $this->id);
        $this->db->bind(':title', $this->title);
        $this->db->bind(':body', $this->body);
        $this->db->bind(':template', $this->template);
        $this->db->bind(':inmenu', $this->inmenu);
        $this->db->bind(':slug', $this->slug);
        $this->db->execute();

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
     * Check if page exist in database
     * @param $slug
     * @return bool
     */
    public function hasPage($slug)
    {
        $this->db->query("SELECT COUNT(*) FROM pages WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        $result = $this->db->getNumber();

        if($result>0) return true;
        return false;
    }

    /**
     * Retrive from database a Page object from slug
     * @param $slug
     * @return Page
     */
    public function getPageBySlug($slug)
    {
        $this->db->query("SELECT * FROM pages WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        $result = $this->db->resultSet();
        return $this->castToObject($result[0]);

    }

    /**
     * Cast the result of a query to a Page instance
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
     * Loads Sections in object Page
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
     * Take an array and castes it to Section objects, then return Page
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
     * Check if section exists.
     * @param $title
     * @return bool
     */
    private function hasSection($title)
    {
        if(isset($this->sections[$title])) return true;
        return false;
    }

    /**
     * Return the section body if section exists.
     * @param $title
     * @return string
     */
    public function displaySection($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->body : "Section ".$title." not found";
    }

    /**
     * Return the section title if section exists.
     * @param $title
     * @return string
     */
    public function displaySectionTitle($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->title : "Section ".$title." not found";
    }
}
