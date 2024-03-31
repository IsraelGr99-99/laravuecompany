<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
//Importamos INERTIA
use Inertia\Inertia;
//Indicamos que usaremos DB
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * Funcion de obtener info
     */
    public function index()
    {
        //Hacemos una consulta multitabla
        $employees = Employee::select('employees.id', 'employees.name', 'email', 'phone', 'department_id', 'departments.name as department')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->paginate(10);

        //Lo siguiente es obtener todos los departmentos
        $departments = Department::all();
        //Ya que tenemos la informacion de las tablas retirnamos a la vista de employees con los parametros
        return Inertia::render('Employees/Index', ['employees' => $employees, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     * Funcion Guardar
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * Funcion Guardar
     */
    public function store(Request $request)
    {
        //Validamos la informacion
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|max:80',
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric',
        ]);
        //Creamos un nuevo empleado con la info con la informacion del request
        $employee = new Employee($request->input());
        //Guaramos al empleado 
        $employee->save();
        //Retornamos hacia la ruta
        return redirect('employees');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //Validamos la informacion
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|max:80',
            'phone' => 'required|max:15',
            'department_id' => 'required|numeric',
        ]);
        //Una vez validada la informacion procedemos a actualizarla
        $employee->update($request->input());
        //Retornamos hacia la ruta
        return redirect('employees');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('employees');
    }

    public function EmployeeByDepartment()
    {
        $data = Employee::select(DB::raw('count(employees.id) as count, departments.name'))
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->groupBy('departments.name')->get();
        //Retornamos la informacion hacia una vista con los prompts obtenidos
        return Inertia::render('Employees/Graphic', ['data' => $data]);
    }

    public function reports()
    {
        //Hacemos una consulta multitabla
        $employees = Employee::select('employees.id', 'employees.name', 'email', 'phone', 'department_id', 'departments.name as department')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->get();

        //Lo siguiente es obtener todos los departmentos
        $departments = Department::all();

        return Inertia::render('Employees/Reports', ['employees' => $employees, 'departments'=>$departments]);
    }
}
