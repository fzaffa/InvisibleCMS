<?php

namespace Invisible\Page;

use Invisible\Section\SectionFactory;

class PageFactory {


    private $sectionFactory;

    public function __construct()
    {
        $this->sectionFactory = new SectionFactory();
    }
    public function createPageFromArrayData($data)
    {
        $page = new Page;
        if ($data['id'] == '') unset($data['id']);
        foreach ($data as $key => $value)
        {
            if(!is_array($value))
            {
                $page->{$key} = $value;
            }
        }
        $sections = [];
        foreach($data['sections'] as $section)
        {
            $section = $this->sectionFactory->createFromArrayData($section);
            $sections[$section->title] = $section;

        }
        $page->sections = $sections;
        $page->slug = $this->sanitizeTitleForSlug($page->title);
        return $page;

    }

    /**
     * @return string
     */
    private function sanitizeTitleForSlug($title)
    {
        return preg_replace('/[^a-zA-Z0-9]+/', '-', $title);
    }
}