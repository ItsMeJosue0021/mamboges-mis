<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchivedStudents;
use App\Models\ArchivedFaculties;

class ArchiveController extends Controller
{
    public function index() {

        $archivedStudents = ArchivedStudents::all();

        $archivedFaculties = ArchivedFaculties::all();

        return view('archive.index', [
            'students' => $archivedStudents,
            'faculties' => $archivedFaculties
        ]);
    }
}
