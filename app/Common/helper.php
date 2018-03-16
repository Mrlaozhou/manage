<?php



if( !function_exists('Trees') )
{
    /**
     * @ 递归 树形结构
     * @param $object
     * @param string $pid
     * @param int $level
     * @return array
     */
    function Trees($object,$pid='',$level=1)
    {
        $trees = [];
        foreach ( $object as $item )
        {
            if ( $item->pid != $pid )   continue;
            $item->level    =   $level;
            $item->son      =   Trees($object,$item->uuid,$level+1);
            $trees[]        =   $item;
        }
        return $trees;
    }
}


if( !function_exists('Sorts') )
{
    /**
     * @ 递归 排序结构
     * @param $object
     * @param bool $isClear
     * @param string $pid
     * @param int $level
     * @return array
     */
    function Sorts( $object, $isClear=false, $pid="", $level=1 )
    {
        static $sorts = [];
        if ($isClear)   $sorts=[];
        foreach ( $object as $key => $item )
        {
            if ( $item->pid != $pid )   continue;
            $item->level    =   $level;
            $sorts[]        =   $item;
            unset($object[$key]);
            Sorts( $object, $isClear=false, $item->uuid,$level+1 );
        }
        return $sorts;
    }
}

if( !function_exists('dump_sql') )
{
    function dump_sql($exec)
    {
        DB::enableQueryLog();

        $exec();

        dump(DB::getQueryLog());
    }
}