<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\ClassModel;
use App\Models\Internship;
use App\Models\User;
use App\Models\StudentInternship;
use App\Models\UserClass;
use App\Models\UserInternship;


class HRController extends Controller
{
    public function index()
    {
        return view('hr.index', [
            'coordinators' => User::where('role', User::ROLE_COORDINATOR)->get(),
            'companies' => Company::all(),
            'classes' => ClassModel::all(),
            'supervisors' => User::where('role', User::ROLE_SUPERVISOR)->get(),
            'students' => User::where('role', User::ROLE_STUDENT)->get(),
            'internships' => Internship::all(),
        ]);
    }

    public function createCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Empresa criada com sucesso!');
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'company_id' => 'nullable|integer|max:50',
        ]);

        $validated2 = $request->validate([
            'class_id' => 'nullable|integer|max:50',
        ]);

        try {
            $user = User::create(
                $validated
            );
            if($validated['role'] == "student")
                {
                    $validated2['user_id'] = $user->id;
                    UserClass::create($validated2);
                }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back()->with('success', 'Utilizador criado com sucesso!');
    }

    public function createClass(Request $request)
    {
        $validated = $request->validate([
            'course' => 'required|string|max:255',
            'sigla' => 'required|string|max:50|unique:classes,sigla',
            'year' => 'nullable|integer',
        ]);

        $validated2 = $request->validate([
            'user_id' => 'nullable|integer|max:50',
        ]);

        try{
            $class = ClassModel::create($validated);
            $validated2['class_id'] = $class->id;
            UserClass::create($validated2);
            return back()->with('success', 'Turma criada com sucesso!');

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }


    public function createInternship(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_hours_required' => 'required|integer|min:1',
            'min_hours_day' => 'required|integer|min:0',
        ]);

        try {
            Internship::create($validated);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back()->with('success', 'Estágio criado com sucesso!');
    }

    public function createSupervisor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'company_id' => 'required|exists:companies,id',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => User::ROLE_SUPERVISOR,
                'company_id' => $validated['company_id'],
                'first_login' => 1,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back()->with('success', 'Supervisor criado com sucesso!');
    }

    public function createStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'class_id' => 'required|exists:classes,id',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => User::ROLE_STUDENT,
                'class_id' => $validated['class_id'],
                'first_login' => 1,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back()->with('success', 'Aluno criado com sucesso!');
    }

    public function assignUserInternship(Request $request)
    {
        $request->validate([
            'role' => 'required|in:student,supervisor',
            'internship_id' => 'required|exists:internships,id',
        ]);

        $userId = $request->role === 'student'
            ? $request->student_id
            : $request->supervisor_id;

        if (!$userId) {
            return back()->withErrors('Selecione um utilizador.');
        }

        $exists = UserInternship::where('user_id', $userId)
            ->where('internship_id', $request->internship_id)
            ->exists();

        if ($exists) {
            return back()->withErrors('Este utilizador já está atribuído a este estágio.');
        }

        UserInternship::create([
            'user_id' => $userId,
            'internship_id' => $request->internship_id,
        ]);

        return back()->with('success', 'Utilizador atribuído ao estágio com sucesso!');
    }

}
