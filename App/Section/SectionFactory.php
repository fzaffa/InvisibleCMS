<?php

namespace Invisible\Section;

class SectionFactory {

    public function createFromArrayData($data)
    {
        $section = new Section();
        foreach($data as $key => $vlaue)
        {
            $section->{$key} = $vlaue;
        }
        return $section;
    }

    public function createEmpty()
    {
        return new Section();
    }

}