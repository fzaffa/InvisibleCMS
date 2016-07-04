<?php

namespace Invisible\Page;

use \Fzaffa\System\Database;
use Invisible\Section\SectionRepository;


class PageRepository {

    function __construct(Database $db, SectionRepository $sectionRepository, PageFactory $pageFactory)
    {
        $this->db = $db;
        $this->page = new Page;
        $this->sectionRepo = $sectionRepository;
        $this->pageFactory = $pageFactory;
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

        if ( ! empty($this->sections))
        {
            foreach ($this->page->sections as $section)
            {
                if ( ! isset($section->_destroy))
                {
                    $this->sectionRepo->save($section);
                }
                else
                {
                    $this->sectionRepo->delete($section);
                }
            }
        }

        return;
    }

    public function all()
    {
        $this->db->query('SELECT * FROM pages');

        return $this->db->getModel(Page::class);
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
        $this->db->query("SELECT COUNT(id) FROM pages WHERE slug = :slug");
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
    public function getPageBySlugWithSections($slug)
    {
        $this->db->query("SELECT * FROM pages WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        $page = $this->db->getModel(Page::class);
        //would like to refactor it
        $page->sections = $this->sectionRepo->getSectionsForPage($page);

        return $page;
    }

    public function getAllPagesInMenu()
    {
        $this->db->query("SELECT * FROM pages WHERE inmenu = true");

        return $this->db->getModel(Page::class);
    }

    public function first()
    {
        $this->db->query('SELECT * FROM pages ORDER BY id DESC limit 1');
        return $this->db->getModel('Invisible\\Page\\Page');
    }

    public function create($input)
    {

        $page = $this->pageFactory->createPageFromArrayData($input);

        //add page to database and retrieve it to get the ID to be assigned to every section
        $this->save($page);
        $page = $this->first();
        foreach ($page->sections as $section)
        {
            $section->page_id = $page->id;

            $this->sectionRepo->save($section);
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