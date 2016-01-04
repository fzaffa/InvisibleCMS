<?php

namespace Invisible\Section;
use Invisible\Page\Page;
use \Fzaffa\System\Database;

class SectionRepository {

	function __construct()
    {
        $this->db = new Database;
    }

	public function getSectionsForPage(Page $page)
	{
		$this->db->query("SELECT * FROM sections WHERE page_id = :id");
        $this->db->bind(':id', $page->id);
        $result = $this->db->get();

        $outputArray = [];

        foreach ($result as $sectionData)
        {
            $section = $this->hydrate($sectionData);
            $outputArray[$section->title] = $section;
        }
        return $outputArray;
	}

    private function hydrate($data)
    {
        $section = new Section();

        foreach ($data as $key => $value)
        {
            $section->{$key} = $value;
        }

        return $section;
    }
} 