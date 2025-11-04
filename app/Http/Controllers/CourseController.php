<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Home: últimos 12 para el slider
    public function home()
    {
        $cursos = Course::latest()->take(12)->get();
        return view('home', compact('cursos'));
    }

    // Listado general (opcional)
    public function index()
    {
        $courses = Course::latest()->paginate(12);
        return view('courses.index', compact('courses'));
    }

    // Form crear (opcional)
    public function create()
    {
        return view('courses.create');
    }

    // Guardar (opcional)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required','string','max:255'],
            'level'    => ['nullable','string','max:50'],
            'lessons'  => ['nullable','integer','min:0'],
            'progress' => ['nullable','integer','between:0,100'],
            'cover'    => ['nullable','string','max:255'],
        ]);

        $course = Course::create($data);   // requiere $fillable en el modelo
        return redirect()->route('home');
    }
}