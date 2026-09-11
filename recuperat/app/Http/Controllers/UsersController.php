<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRol;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Permission;
use Illuminate\Support\Facades\Auth;

class UsersController extends CRUDController
{
    public function __construct(array $attributes = array())
    {
        parent::__construct();
        $this->index_search_fields = array(
            'email',
            'name'
        );
        $this->add_view = 'user.add';
        $this->showAll = true;
        $this->edit_view = 'user.add';
        $this->encryptField = 'password';
        $this->route_path = 'users';
        $this->file_output = 'images/user_images/';
        $this->class_name = '\App\UsersController';
        $this->model_name = '\App\User';
        $this->short_model_name = 'User';

        // $this->file_output = 'images/plans_images/diagnosis/';
        $this->A_validator = [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required'
        ];
        $this->A_validator_update = [
            'name' => 'required|unique:users,name,{{id}}',
            'email' => 'required|unique:users,id,{{id}}',
        ];
        $this->A_validator_messages = [
            'name.required' => 'El campo de nombre es obligatorio',
            'name.unique' => 'Ese nombre ya ha sido registrado',
            'email.required' => 'El campo de email es obligatorio',
            'email.unique' => 'Ese correo ya ha sido registrado',
            'password.required' => 'El campo de contraseña es obligatorio',
        ];
        $this->A_validator_messages_update = [
            'name.required' => 'El campo de nombre es obligatorio',
            'email.required' => 'El campo de email es obligatorio',
        ];
        $this->relationships = [
            'UserRol' => 'rol',
            'Permission' => 'permissions',
            // 'clinic_diagnosis',
            // 'radiologic_diagnosis',
            // 'treatments',
        ];
        $this->file_relationships = [
            'ImageResource' => 'image_resources'
        ];
        $this->keys = [
            'index' => [
                'id' => 'id',
                'name' => 'Nombre',
                'email' => 'Email',
            ],
            'create' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['key' => 'password', 'label' => 'Contraseña', 'type' => 'password'],
                ['key' => 'license', 'label' => 'Cédula', 'type' => 'text'],

                'rol' => ['key' => 'user_rol_id', 'label' => 'Rol', 'type' => 'select', 'options' => UserRol::all()->pluck('name', 'id')->toArray(), 'name' => 'rol'],
                'image_resources' => ['key' => 'image_resources', 'label' => 'Fotografías', 'type' => 'multiple_images'],
            ],
            'edit' => [
                ['key' => 'name', 'label' => 'Nombre', 'type' => 'text'],
                ['key' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['key' => 'reset_password', 'label' => 'Cambiar Contraseña', 'type' => 'password'],
                ['key' => 'license', 'label' => 'Cédula', 'type' => 'text'],
                'rol' => ['key' => 'rol', 'label' => 'Rol', 'type' => 'select', 'options' => UserRol::all()->pluck('name', 'id')->toArray(), 'name' => 'rol'],
                'image_resources' => ['key' => 'image_resources', 'label' => 'Fotografías', 'type' => 'multiple_images'],
            ],
        ];
    }

    public function loginAsUser($id)
    {
        Auth::loginUsingId($id);
        return redirect('/');
    }

    public function update(Request $request, $id = false)
    {
        // dd($request->all());
        if ($request->reset_password) {
            $request->request->add(['password' => bcrypt($request->reset_password)]);
            $request->request->remove('reset_password');
        }
        return parent::update($request, $id);
    }
    public function edit($id, $stop_extend = false)
    {
        $default = array_map(function ($permission) {
            return $permission['name'];
        }, User::find($id)->permissions->toArray());
        $this->extras = [];
        $this->extras['permissions'] = ['key' => 'permissions', 'label' => 'Permisos', 'type' => 'multiple_checkbox', 'options' => Permission::all(), 'default' => $default, 'name' => 'permissions'];
        // $this->keys['edit']['permissions'] = ['key'=>'permissions', 'label'=>'Permisos', 'type'=>'multiple_checkbox', 'options'=>Permission::all()->toArray(), 'default' => $default, 'name'=>'permissions'];
        // dd($this->keys['edit']['permissions']);
        return parent::edit($id, false);
    }
    public function ajax_get_user($string = null)
    {
        $col = User::where("name", "like", "%")->limit(20)->orderBy('name', 'asc')->get();
        if ($string) {
            $col = User::where("name", "like", "%" . $string . "%")->orWhere('email', 'like', '%' . $string . '%')->limit(20)->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($User) {
            return [
                'id' => $User->id,
                'label' => $User->code_plus_name
            ];
        });
        return $col->pluck('name', 'id')->toArray();
    }
    public function ajaxAll()
    {
        return User::all();
    }
    public function ajaxUpdate(Request $request, $id = false)
    {
        $User = User::where('id', $request->id)->first();
        $User->name = $request->name;
        $User->code = $request->code;
        $res = $User->save();
        return json_encode($res);
    }

    public function ajaxDelete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->email = $user->email . $user->id;
        $user->name = $user->name . $user->id;
        $user->save();
        $res = $user->delete();
        return json_encode($res);
    }
}
