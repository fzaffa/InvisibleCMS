<?php namespace Fzaffa\System;

class Config {

    private $path;

    private $items = [];

    public function __construct($path)
    {
        $this->setPath($path);
    }

    public function get($name)
    {
        list($file, $key) = $this->parseName($name);
        $this->includeIfNotCached($file);
        $item = $this->parseItemToReturn($file, $key);

        return $item;
    }


    /**
     * @param $file
     * @throws \Exception
     */
    private function includeIfNotCached($file)
    {
        if ( ! array_key_exists($file, $this->items))
        {
            if ( ! file_exists($fileName = $this->path . $file . '.php'))
            {
                throw new \Exception("Config file [$fileName] not found");
            }

            $arr = include $fileName;
            $this->items[$file] = $arr;
        }
    }

    /**
     * @param $name
     * @return array
     */
    private function parseName($name)
    {
        if (strpos($name, '.'))
        {
            list($file, $key) = explode('.', $name);

            return [$file, $key];
        }

        return [$name, null];
    }

    /**
     * @param $key
     * @param $file
     * @return mixed
     */
    private function parseItemToReturn($file, $key)
    {
        if ($key)
        {
            return isset($this->items[$file][$key]) ? $this->items[$file][$key] : null;
        }

        return $this->items[$file];
    }

    public static function getInstance($path = null)
    {
        static $inst = null;
        if ($inst === null)
        {
            if ( ! $path)
            {
                throw new \Exception("Path to Config files not provided.");
            }
            $inst = new Config($path);
        }

        return $inst;
    }

    private function setPath($path)
    {
        if (substr($path, - 1, 1) != '/')
        {
            $path .= '/';
        }

        $this->path = $path;
    }
} 