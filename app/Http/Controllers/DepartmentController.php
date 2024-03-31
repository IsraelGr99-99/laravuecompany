<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
//Importamos INERTIA
use Inertia\Inertia;
class DepartmentController extends Controller
{
    /**
     * Funcion para madar a llamr todos los registros y visualizarlos
     */
    public function index()
    {
        //Obtenemos todos los registros de la base de datos y los guardamos en la variable $departments
        $departments = Department::all();
        /*Retornamos mediante INERTIA a la carpeta de departementos con la ruta indicada
        * A esta vista le enviamos como parametro prompos
        'departments es la carpeta donde se buscara el archivo'
        */
        return Inertia::render('Departments/Index',['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Como la funcion de crear se hace desde otra vista solo retornamos la vista
        return Inertia::render('Departments/Create');
    }

    /**
     * Funcion guardar
     */
    public function store(Request $request)
    {
        //Validamos que los campos contengan las caracteristicas necesarias
        $request->validate(['name' => 'required|max:100']);
        //Creamos un nuevo departamento con lo que tenemos en el input
        $departments = new Department($request->input());
        //Una vez creado guardamos la informacion
        $departments->save();
        //Retornamos a la vista de departments
        return redirect('departmets');

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Funcion de Editar departamentos
     */
    public function edit(Department $department)
    {
        //Le pasamos los parametros a la vista de editar con la informacion de ese department
        return Inertia::render('Departments/Edit',['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //Validamos que el campo a actualizar tenga las validaciones necesarias
        $request->validate(['name' => 'required|max:100']);
        //Actualizamos con las informacion de request
        $department->update($request->all());
        //Una vez actualizado retornamos hacia la vista de departments
        return redirect('departments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //Elimamos el departamento y nos retornamos a la vista de departments
        $department->delete();
        return redirect('departments');
    }
}
