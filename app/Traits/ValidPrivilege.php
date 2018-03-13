<?php
namespace App\Traits;
use DB;

trait ValidPrivilege
{

    protected function privileges()
    {
        return DB::table('privilege')->select('uuid','name','pid')->where('status','<>','-7')
//            ->where('is_back','1')
            ->get()->toArray();
    }

    protected function showSlideBar()
    {
        return DB::table('privilege')
            ->where('status','1')
            ->where('is_back','1')
            ->get()->toArray();
    }
}