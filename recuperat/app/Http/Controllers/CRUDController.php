<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Storage;

class CRUDController extends Controller
{
    public function __construct(array $attributes = array())
    {
    }
    public function index(Request $request)
    {
        $C_model = [];
        if (empty($request->search_terms) && Auth::user()->id == 2) {
            $C_model = $this->model_name::where('id', '>', 0);
            return view(!empty($this->index_view) ? $this->index_view : 'CRUDViews.index')->with('C_model', $C_model->paginate(20))->
                with('permissions', !empty($this->permissions) ? $this->permissions : [])->
                with('title', !empty($this->title) ? $this->title : null)->
                with('keys_to_show', $this->keys['index'])->
                with('route_path', $this->route_path)->
                with('route_show', !empty($this->route_show) ? $this->route_show : false)->
                with('route_search', $this->route_path . '.index')->
                with('route_create', $this->route_path . '.create')->
                with('route_edit', $this->route_path . '.edit')->
                with('route_update', $this->route_path . '.ajaxUpdate')->
                with('route_delete', $this->route_path . '.ajaxDelete');
            with('search_terms', $request->search_terms)->
                with('hide_header', !empty($this->hide_header) ? $this->hide_header : false)->
                with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : false);

        }

        if (!empty($request->search_terms) && empty($this->showAll)) {
            if (!empty($this->index_search_fields)) {
                $cleanTerms = preg_replace('/[^A-Za-z0-9\-]/', '%', $request->search_terms);
                $C_model = $this->model_name::where($this->index_search_fields[0], 'like', '%' . $cleanTerms . '%');
                unset($this->index_search_fields[0]);
                foreach ($this->index_search_fields as $key => $field) {
                    // if it has keywords, match them too
                    if ($field == 'keywords') {
                        $C_model->orWhereHas('keywords', function ($query) use ($cleanTerms) {
                            $query->where('name', 'like', '%' . $cleanTerms . '%');
                        });
                        continue;
                    }
                    $C_model->orWhere($field, 'like', '%' . $cleanTerms . '%');
                }
            } else {
                $C_model = $this->model_name::where('name', 'like', '%' . $request->search_terms . '%');
            }
        } else if ((!empty($this->showAll) || Auth::user()->getAdminAttribute()) && !$request->session()->get('client_view')) {
            $C_model = $this->model_name::where('id', '>', 0);
        }
        if (!empty($request->user_id)) {
            $C_model = $this->model_name::where('user_id', '!=', null);
        }

        if ($C_model) {
            return view(!empty($this->index_view) ? $this->index_view : 'CRUDViews.index')->with('C_model', $C_model->paginate(20))->
                with('permissions', !empty($this->permissions) ? $this->permissions : [])->
                with('title', !empty($this->title) ? $this->title : null)->
                with('keys_to_show', $this->keys['index'])->
                with('route_path', $this->route_path)->
                with('route_show', !empty($this->route_show) ? $this->route_show : false)->
                with('route_search', $this->route_path . '.index')->
                with('route_create', $this->route_path . '.create')->
                with('route_edit', $this->route_path . '.edit')->
                with('route_update', $this->route_path . '.ajaxUpdate')->
                with('route_delete', $this->route_path . '.ajaxDelete');
            with('search_terms', $request->search_terms)->
                with('hide_header', !empty($this->hide_header) ? $this->hide_header : false)->
                with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : false);
        } else {
            return view(!empty($this->index_view) ? $this->index_view : 'CRUDViews.index')->with('C_model', [])->
                with('permissions', !empty($this->permissions) ? $this->permissions : [])->
                with('title', !empty($this->title) ? $this->title : null)->
                with('keys_to_show', $this->keys['index'])->
                with('route_show', !empty($this->route_show) ? $this->route_show : false)->
                with('route_path', $this->route_path)->
                with('route_search', $this->route_path . '.index')->
                with('route_create', $this->route_path . '.create')->
                with('route_edit', $this->route_path . '.edit')->
                with('route_update', $this->route_path . '.ajaxUpdate')->
                with('route_delete', $this->route_path . '.ajaxDelete')->
                with('search_terms', $request->search_terms)->
                with('hide_header', !empty($this->hide_header) ? $this->hide_header : false)->
                with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : false);
        }
    }

    public function create()
    {
        return view(!empty($this->add_view) ? $this->add_view : 'CRUDViews.add')->
            with('permissions', !empty($this->permissions) ? $this->permissions : [])->
            with('title', !empty($this->title) ? $this->title : null)->
            with('form_method', 'post')->
            with('form_url', route($this->route_path . '.store'))->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('default', [])->
            with('keys', $this->keys['create'])->
            with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null)->
            with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null)->
            with('extras', !empty($this->extras) ? $this->extras : null);
    }
    public function edit($id, $stop_extend = false)
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    if (empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                    }
                } else {
                    $collection = $model->$relationship_name;
                    if (!$collection) {
                        unset($this->keys['create'][$relationship_name]['default']);
                        continue;
                    }
                    $this->keys['create'][$relationship_name]['default'] = get_class($collection) == "Illuminate\Database\Eloquent\Collection" ? $model->$relationship_name : collect()->add($model->$relationship_name);
                }
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                } else {
                    $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
                }
            }
        }
        return view(!empty($this->edit_view) ? $this->edit_view : 'CRUDViews.add')->
            with('permissions', !empty($this->permissions) ? $this->permissions : [])->
            with('form_method', 'put')->
            with('route_prefix', $this->route_path)->
            with('form_url', route($this->route_path . '.store'))->
            with('keys', (!empty($this->keys['edit'])) ? $this->keys['edit'] : $this->keys['create'])->
            with('stop_extend', $stop_extend)->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
            with('O_model', $model)->
            with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null)->
            with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null)->
            with('extras', !empty($this->extras) ? $this->extras : null);
    }

    public function show($id)
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    if (empty($this->keys['edit'][$relationship_name]['default'])) {
                        $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                    }
                } else {
                    $collection = $model->$relationship_name;
                    if (!$collection) {
                        unset($this->keys['create'][$relationship_name]['default']);
                        continue;
                    }
                    $this->keys['create'][$relationship_name]['default'] = get_class($collection) == "Illuminate\Database\Eloquent\Collection" ? $model->$relationship_name : collect()->add($model->$relationship_name);
                }
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($this->keys['edit'])) {
                    $this->keys['edit'][$relationship_name]['default'] = $model->$relationship_name;
                } else {
                    $this->keys['create'][$relationship_name]['default'] = $model->$relationship_name;
                }
            }
        }
        return view('CRUDViews.view')->
            with('form_method', 'put')->
            with('route_prefix', $this->route_path)->
            with('form_url', route($this->route_path . '.store'))->
            with('keys', (!empty($this->keys['edit'])) ? $this->keys['edit'] : $this->keys['create'])->
            with('stop_extend', false)->
            with('patient_id', !empty($this->patient_id) ? $this->patient_id : null)->
            with('protocol', $this->class_name == '\App\ProtocoloFisioterapiaController' ? $model : null)->
            with('O_model', $model)->
            with('printTableHeader', !empty($this->printTableHeader) ? $this->printTableHeader : null)->
            with('newVersionRoute', $this->route_path ? $this->route_path . '.new_version' : null);
    }

    public function apiStore(Request $request)
    {
        if (!empty($this->A_validator)) {
            Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        }
        $A_request = $request->all();
        $model = new $this->model_name($A_request);
        $model->save();
        return $model;
    }

    public function store(Request $request)
    {
        if (!empty($this->A_validator)) {
            Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        }
        $A_request = $request->all();
        if (!empty($this->encryptField)) {
            $A_request[$this->encryptField] = bcrypt($A_request[$this->encryptField]);
        }
        if (!empty($this->files)) {
            foreach ($this->files as $fileField) {
                if ($request->$fileField) {
                    $originalFileName = $request->file($fileField)->getClientOriginalName();
                    $tmpFile = $request->file($fileField)->getPathName();
                    $A_request[$fileField] = $originalFileName;
                    Storage::cloud()->put($originalFileName, $request->$fileField->get());
                }
            }
        }
        unset($A_request['_token']);
        unset($A_request['refresh']);
        $A_relationships = [];
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['value'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'normal';
                } else {
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['value'] = [];
                    $A_relationships[$relationship_name]['type'] = 'normal';
                }
                unset($A_request[$relationship_name]);
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['file'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'file';

                } else {
                    $A_relationships[$relationship_name]['type'] = 'file';
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['file'] = [];
                }
                unset($A_request[$relationship_name]);
            }
        }
        $model = new $this->model_name($A_request);
        $extras = $request->input('extras', null);
        if ($extras = $request->input('extras', null)) {
            $model->extras = json_encode($extras);
        }
        if (($id = Auth::id()) && !empty($this->keys['user_id'])) {
            $model->user_id = $id;
        }
        $model->save();
        foreach ($A_relationships as $relationship_name => $relationship) {
            $class = explode('\\', get_class($model->$relationship_name()));
            $rel_model = $class[sizeof($class) - 1];
            if ($relationship['type'] == 'file') {
                foreach ($relationship['file'] as $file) {
                    $S_file_name = time() . uniqid(rand()) . "." . $file->getClientOriginalExtension();
                    $relationship['value']['url'] = $this->file_output . $S_file_name;
                    $res = $file->move(public_path($this->file_output), $S_file_name);
                    $A_model_info['url'] = $this->file_output . $S_file_name;
                    $model_route = $relationship['model'];
                    $model_class = new $model_route($A_model_info);
                    $model->$relationship_name()->save($model_class);
                }

            } else {
                if ($rel_model == "HasMany") {
                    $model->$relationship_name()->delete();
                    $model_route = $relationship['model'];
                    foreach ($relationship['value'] as $inmodel_info) {
                        $model_class = new $model_route($inmodel_info);
                        $model->$relationship_name()->save($model_class);
                    }
                } elseif ('BelongsTo' == $rel_model) {
                    $keyName = $model->$relationship_name()->getForeignKeyName();
                    if (empty($relationship['value'][0]) && !$request->input($keyName)) {
                        $model->$keyName = null;
                    } else {
                        $model->$keyName = empty($relationship['value'][0]) ? null : $relationship['value'][0];
                        if (!$model->$keyName) {
                            $model->$keyName = $request->input($keyName);
                        }
                    }
                    $model->save();
                } else {
                    $model->$relationship_name()->sync($relationship['value']);
                }
            }
        }
        if ($request->input('refresh')) {
            return redirect(route($this->route_path . '.edit', $model->id))->with('success', 'Se ha guardado con exito')
                ->with('stop_extend', true);
        }
        return redirect(route($this->route_path . '.index'))->with('success', 'Se ha guardado con exito');
    }

    public function ajaxGet($string = null)
    {
        $col = $this->model_name::where("name", "like", "%")->limit(20)->orderBy('name', 'asc')->get();
        if ($string) {
            $col = $this->model_name::where("name", "like", "%" . $string . "%")->limit(40)->orderBy('name', 'asc')->get();
        }
        return $col->map(function ($cie10) {
            return [
                'id' => $cie10->id,
                'label' => $cie10->name
            ];
        });
        return $col->pluck('name', 'id')->toArray();
    }

    public function ajaxUpdate(Request $request, $id = false)
    {
        $model = $this->model_name::where('id', $request->id)->first();
        $model->name = $request->name;
        $res = $model->save();
        return json_encode($res);
    }

    public function ajaxDelete(Request $request)
    {
        $model = $this->model_name::where('id', $request->id)->first();
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship) {
                $class = explode('\\', get_class($model->$relationship()));
                $rel_model = $class[sizeof($class) - 1];
                if (strtolower($rel_model) == strtolower("BelongsToMany")) {
                    $model->$relationship()->detach();
                }
            }
        }

        $res = $model->delete();
        return json_encode($res);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model_name::where('id', $id)->first();
        if (!empty($this->defaultFalses)) {
            foreach ($this->defaultFalses as $value) {
                $model->$value = false;
            }
        }
        if ($extras = $request->input('extras', null)) {
            $model->extras = json_encode($extras);
        }
        if (!empty($this->A_validator_update)) {
            $this->A_validator_update = array_map(
                function ($string) use ($model) {
                    $string = str_replace('{{id}}', $model->id, $string);
                    return $string;
                },
                $this->A_validator_update
            );
            Validator::make($request->all(), $this->A_validator_update, $this->A_validator_messages)->validate();
        } elseif (!empty($this->A_validator)) {
            Validator::make($request->all(), $this->A_validator, $this->A_validator_messages)->validate();
        }
        $A_request = $request->all();
        unset($A_request['_token']);
        unset($A_request['refresh']);
        $A_relationships = [];
        if (!empty($this->files)) {
            foreach ($this->files as $fileField) {
                if ($request->$fileField) {
                    $originalFileName = $request->file($fileField)->getClientOriginalName();
                    $tmpFile = $request->file($fileField)->getPathName();
                    $A_request[$fileField] = $originalFileName;
                    Storage::cloud()->put($originalFileName, $request->$fileField->get());
                }
            }
        }
        if (!empty($this->relationships)) {
            foreach ($this->relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['value'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'normal';
                } else {
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['value'] = [];
                    $A_relationships[$relationship_name]['type'] = 'normal';
                }
                unset($A_request[$relationship_name]);
            }
        }
        if (!empty($this->file_relationships)) {
            foreach ($this->file_relationships as $key => $relationship_name) {
                if (!empty($A_request[$relationship_name])) {
                    $A_relationships[$relationship_name]['file'] = $A_request[$relationship_name];
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['type'] = 'file';

                } else {
                    $A_relationships[$relationship_name]['type'] = 'file';
                    $A_relationships[$relationship_name]['model'] = '\App\\' . $key;
                    $A_relationships[$relationship_name]['file'] = [];
                }
                unset($A_request[$relationship_name]);
            }
        }
        if (($id = Auth::id()) && !empty($this->keys['user_id'])) {
            $model->user_id = $id;
        }
        if (!empty($model->is_sealed) && empty($A_request['is_sealed'])) {
            $A_request['is_sealed'] = false;
        }
        $model->update($A_request);
        foreach ($A_relationships as $relationship_name => $relationship) {
            $class = explode('\\', get_class($model->$relationship_name()));
            $rel_model = $class[sizeof($class) - 1];
            if ($relationship['type'] == 'file') {
                ;
                //delete non required images
                $filesToDelete = $model->$relationship_name;
                foreach ($relationship['file'] as $file) {
                    if (is_string($file)) {
                        $filesToDelete = $filesToDelete->where('url', '!=', $file);
                        continue;
                    }
                    $S_file_name = time() . uniqid(rand()) . "." . $file->getClientOriginalExtension();
                    $relationship['value']['url'] = $this->file_output . $S_file_name;
                    $res = $file->move(public_path($this->file_output), $S_file_name);
                    $A_model_info['url'] = $this->file_output . $S_file_name;
                    $model_route = $relationship['model'];
                    $model_class = new $model_route($A_model_info);
                    $model->$relationship_name()->save($model_class);
                }
                foreach ($filesToDelete as $file) {
                    $file->delete();
                }
            } else {
                if ($rel_model == "HasMany") {
                    $model->$relationship_name()->delete();
                    $model_route = $relationship['model'];
                    foreach ($relationship['value'] as $inmodel_info) {
                        $model_class = new $model_route($inmodel_info);
                        $model->$relationship_name()->save($model_class);
                    }
                } elseif ('BelongsTo' == $rel_model) {
                    $keyName = $model->$relationship_name()->getForeignKeyName();
                    if (empty($relationship['value'][0])) {
                        $model->$keyName = null;
                    } else {
                        $model->$keyName = $relationship['value'][0];
                    }
                    $model->save();
                } else {
                    $model->$relationship_name()->sync($relationship['value']);
                }
            }

        }
        if ($request->input('refresh')) {
            return redirect()->route($this->route_path . '.edit_stop_extend', ['id' => $model->id, 'stop_extend' => true]);
            return view('CRUDViews.add')->
                with('form_method', 'put')->
                with('route_prefix', $this->route_path)->
                with('form_url', route($this->route_path . '.store'))->
                with('keys', $this->keys['create'])->
                with('O_model', $model)->
                with('stop_extend', true);
        }
        return redirect(route($this->route_path . '.index'))->with('success', 'Se ha modificado con exito');
    }
}
