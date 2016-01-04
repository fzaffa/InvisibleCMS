<?php namespace Invisible\Page;

use \Fzaffa\System\Database;
use Invisible\Section\SectionRepository;


class PageRepository {

    function __construct()
    {
        $this->db = new Database;
        $this->page = new Page;
        $this->sectionRepo = new SectionRepository;
    }

    public function fill(array $input)
    {

        if ($input['id'] == '') unset($input['id']);
        unset($input['sections']);
        foreach ($input as $key => $value)
        {
            $this->page->{$key} = $value;
        }
        $this->page->slug = strtolower(str_replace(' ', '-', $this->page->title));

        return $this->page;

    }

    public function save()
    {
        if ( ! $this->page->id)
        {
            $this->db->query("INSERT INTO pages (title, body, template, inmenu, slug)
                              VALUES (:title, :body, :template, :inmenu, :slug)");

        }
        else
        {
            $this->db->query("UPDATE pages
                          SET title = :title, body = :body, template = :template, inmenu = :inmenu, slug = :slug
                          WHERE id = :id");

            $this->db->bind(':id', $this->page->id);
        }
        $this->db->bind(':title', $this->page->title);
        $this->db->bind(':body', $this->page->body);
        $this->db->bind(':template', $this->page->template);
        $this->db->bind(':inmenu', $this->page->inmenu);
        $this->db->bind(':slug', $this->page->slug);

        $this->db->execute();

        /*        if ( ! empty($this->sections))
                {
                    foreach ($this->page->sections as $section)
                    {
                        if ( ! isset($section->_destroy))
                        {
                            $section->save();
                        }
                        else
                        {
                            $section->delete();
                        }
                    }
                }*/

        return;
    }

    public function all()
    {
        $this->db->query('SELECT * FROM pages');

        return $this->db->getModel('Invisible\\Page\\Page');
    }

    /*   public function fillSections($input)
       {
           $sectionsarray = [];
           foreach ($input as $section)
           {
               $sectionobj = new Section($this->id);
               $sectionobj->fill($section);
               array_push($sectionsarray, $sectionobj);
           }
           $this->sections = $sectionsarray;;

           return $this;
       }*/

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

        if ($result > 0) return true;

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
        $this->page = $this->db->getModel('Invisible\\Page\\Page');

        $this->page->sections = $this->sectionRepo->getSectionsForPage($this->page);

        return $this->page;
    }
public function first()
{
    $this->db->query('SELECT * FROM pages ORDER BY id DESC limit 1');
    return $this->page = $this->db->getModel('Invisible\\Page\\Page');
}
    public function create($input)
    {
        $sections = [];
        foreach ($input['sections'] as $section)
        {
            $sections[] = $this->sectionRepo->create($section);
        }

        $this->fill($input);
        $this->save();
        $this->first();
        foreach ($sections as $section)
        {
            $section->page_id = $this->page->id;
            $section->save();
        }

    }

    /**
     * Loads Sections in object Page
     * @return Page
     */
    /*    public function getSections()
        {
            $this->db->query("SELECT * FROM sections WHERE page_id = :page_id");
            $this->db->bind(':page_id', $this->page->id);
            $result = $this->db->get();
            $this->castSectionsToObject($result);

            return $this;
        }*/

    /**
     * Take an array and castes it to Section objects, then return Page
     * @param array $sections
     * @return Page
     */
    /*    private function castSectionsToObject(array $sections)
        {
            $arr = [];
            foreach ($sections as $section)
            {
                $obj = new Section;
                foreach ($section as $key => $value)
                {
                    $obj->{$key} = $value;
                }
                $obj->prepareForDisplay();
                $arr[$obj->title] = $obj;
            }
            $this->page->sections = $arr;

            return $this;
        }*/

}