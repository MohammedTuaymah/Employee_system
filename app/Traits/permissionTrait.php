<?php
namespace App\Traits;

trait permissionTrait{
    public function hasPermission(){

        // If user can't add
        //for department
        if(!isset(auth()->user()->role->permission['name']['department']['can-add']) && \Route::is('departments.create')){
            return abort(401);
        }
        if(!isset(auth()->user()->role->permission['name']['department']['can-list']) && \Route::is('departments.index')){
            return abort(401);
        }
        //for User
        if(!isset(auth()->user()->role->permission['name']['user']['can-add']) && \Route::is('users.create')){
            return abort(401);
        }
        if(!isset(auth()->user()->role->permission['name']['user']['can-list']) && \Route::is('users.index')){
            return abort(401);
        }
        //for Role
        if(!isset(auth()->user()->role->permission['name']['role']['can-add']) && \Route::is('roles.create')){
            return abort(401);
        }
        if(!isset(auth()->user()->role->permission['name']['role']['can-list']) && \Route::is('roles.index')){
            return abort(401);
        }
        //for Permission
        if(!isset(auth()->user()->role->permission['name']['permission']['can-add']) && \Route::is('permissions.create')){
            return abort(401);
        }
        if(!isset(auth()->user()->role->permission['name']['permission']['can-list']) && \Route::is('permissions.index')){
            return abort(401);
        }

        //Approve-reject staff leave
        if(!isset(auth()->user()->role->permission['name']['leave']['can-list']) && \Route::is('leaves.index')){
            return abort(401);
        }

        //Notice
        if(!isset(auth()->user()->role->permission['name']['notice']['can-add']) && \Route::is('notices.create')){
            return abort(401);
        }
        if(!isset(auth()->user()->role->permission['name']['notice']['can-list']) && \Route::is('notices.index')){
            return abort(401);
        }

        //Mail
        if(!isset(auth()->user()->role->permission['name']['mail']['can-add']) && \Route::is('mails.create')){
            return abort(401);
        }

    }
}