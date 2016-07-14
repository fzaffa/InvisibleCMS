<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 04/07/16
 * Time: 22:02
 */

namespace Invisible\Assemblers;


use Fzaffa\System\Config;
use Fzaffa\System\Database;
use Fzaffa\System\IAssembler;
use Fzaffa\System\ILazyAssembler;
use Fzaffa\System\Resolver;

class DatabaseAssembler implements IAssembler, ILazyAssembler
{
    private $resolver;
    public function __construct(Resolver &$resolver)
    {
        $this->resolver = $resolver;
    }

    public function getClass() : string
    {
        return Database::class;
    }

    public function run()
    {
        $database = new Database(
            Config::getInstance()->get('db.host'),
            Config::getInstance()->get('db.database'),
            Config::getInstance()->get('db.username'),
            Config::getInstance()->get('db.password')
        );

        $this->resolver->bind(Database::class, $database);
    }
}