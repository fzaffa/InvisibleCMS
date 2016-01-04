<?php namespace Invisible\Page;

use \Fzaffa\System\Database;
use Invisible\Section\Section;

class Page {

    public $id;
    public $inmenu;
    public $title;
    public $body;
    public $template;
    public $slug;
    public $sections = [];

    /**
     * Check if section exists.
     * @param $title
     * @return bool
     */
    private function hasSection($title)
    {
        if (isset($this->sections[$title])) return true;

        return false;
    }

    /**
     * Return the section body if section exists.
     * @param $title
     * @return string
     */
    public function displaySection($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->body : "Section " . $title . " not found";
    }

    /**
     * Return the section title if section exists.
     * @param $title
     * @return string
     */
    public function displaySectionTitle($title)
    {
        return ($this->hasSection($title)) ? $this->sections[$title]->title : "Section " . $title . " not found";
    }
}
