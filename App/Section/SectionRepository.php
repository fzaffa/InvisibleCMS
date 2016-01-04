<?php

namespace Invisible\Section;
use Invisible\Page\Page;
use \Fzaffa\System\Database;

class SectionRepository {

	function __construct()
    {
        $this->db = new Database;
        $this->sectionFactory = new SectionFactory;
    }

	public function getSectionsForPage(Page $page)
	{
		$this->db->query("SELECT * FROM sections WHERE page_id = :id");
        $this->db->bind(':id', $page->id);
        $result = $this->db->get();

        return $this->aggregateInArray($result);
	}


    public function getAll()
    {
        $this->db->query("SELECT * FROM sections");
        $result = $this->db->get();

        return $this->aggregateInArray($result);

    }
    public function save(Section $section)
    {
        if ( ! $section->id)
        {
            $this->db->query("INSERT INTO sections (title, body, page_id)
                              VALUES (:title, :body, :page_id)");
            $this->db->bind(':title', $section->title);
            $this->db->bind(':body', $section->body);
            $this->db->bind(':page_id', $section->page_id);
            $this->db->execute();

            return;
        }
        $this->db->query("UPDATE sections
                          SET title = :title, body = :body
                          WHERE id = :id");
        $this->db->bind(':title', $section->title);
        $this->db->bind(':body', $section->body);
        $this->db->bind(':id', $section->id);
        $this->db->execute();

        return;
    }

    public function delete(Section $section)
    {
        $this->db->query("DELETE FROM sections WHERE id = :id");
        $this->db->bind(':id', $section->id);
    }


    public function createSection($data)
    {
        return $this->sectionFactory->createFromArrayData($data);
    }
    /**
     * @param $result
     * @return array
     */
    private function aggregateInArray($result)
    {
        $outputArray = [];

        foreach ($result as $sectionData)
        {
            $section = $this->sectionFactory->createFromArrayData($sectionData);
            $outputArray[$section->title] = $section;
        }

        return $outputArray;
    }
} 