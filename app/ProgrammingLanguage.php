<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    public static function getDropDownList($fieldName, $code=NULL){
        $str = "<option value=''>Select Programming Language</option>";
        // $str = "";
        $lists = self::orderBy($fieldName,'asc')->get();
        if($lists){
            foreach($lists as $list){
                if($code !=NULL && $code == $list->code){
                    $str .= "<option  value='".$list->code."' selected>".$list->$fieldName."</option>";
                }else{
                    $str .= "<option  value='".$list->code."'>".$list->$fieldName."</option>";
                }

            }
        }
        return $str;
    }
}
