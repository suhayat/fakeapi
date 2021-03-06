<?php
namespace App\Helpers;

use DB;
use Auth;
use App\Models\Menu\Menu;

class Navigation {    

    public static function adminMenu()
    {
        if (!Auth::user()->isDeveloper()) {
            $menus = Menu::orderBy('order')->whereIn('id', self::getAllowMenus())->get()->toArray();
        } else {
            $menus = Menu::orderBy('order')->get()->toArray();
        }
        return self::tree($menus);
    }

    static function hasChild($rows, $id) 
    {
        foreach ($rows as $row) {
            if ($row['parent_id'] == $id) {
                return true;
            }
        }
        return false;
    }

    static function tree($rows, $parentId = 0, $level = 1)
    {
        $result = '';
        $i = $level;
        foreach ($rows as $row) {
            if ($row['parent_id'] == $parentId) {
                if (self::hasChild($rows, $row['id'])) {
                    $ii = $i + 1;
                    $result .= '<li class="treeview">';
                    $result .= '<a href="#">';
                    $result .= '<i class="'.$row['icon'].'"></i><span>' . $row['name'] .'</span>';
                    $result .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                    $result .= '<ul class="treeview-menu">';
                    $result .= self::tree($rows, $row['id'], $ii);
                    $result .= '</ul>';
                } else {
                    $result .= '<li><a href="'. self::adminUrl($row['url']) .'"><i class="'.$row['icon'].'"></i>';
                    $result .= '<span>'.$row['name'] . '</span></a></li>';
                }
            }
        }

        $result .= '';
        return $result;
    }

    public static function adminUrl($path = null) 
    {
        return '/'.config('app.admin_page').$path;
    }

    public static function checkPermission($permissionId, $roleId) {
        $permission = DB::table('role_permission')
                        ->where('permission_id', $permissionId)
                        ->where('role_id', $roleId)
                        ->first();
        if ($permission) {
            return true;
        }
        return false;
    }

    static function getParent($row) {
        $arr = $row->id;
        if ($row->parent) {
            $arr .= '|'.self::getParent($row->parent);
        }
        return $arr;
    }

    
    static function getAllowMenus() {
        $arr = [];
        if (!Auth::user()->isDeveloper()) {
            $permissions = Auth::user()->role->permissions;
            foreach ($permissions as $key => $permission) {
                $arr[] = $permission->menu_id;
                if ($permission->menu->parent) {
                    $exps = explode("|", self::getParent($permission->menu->parent));
                    foreach ($exps as $exp) {
                        $arr[] = $exp;
                    }
                }
            }
        }
        return $arr;
    }
    
}