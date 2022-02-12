<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportstudents()
    {
        // $filename = urlencode("students-export-" . date("Y-m-d H:i:s") . ".csv");
        $filename = "students-export-" . date("Y-m-d H:i:s") . ".csv";
        return Excel::download(new StudentExport,  $filename, null, ["ID", "CLASS_ID", "NAMA", "NIS", "JENIS_KELAMIN", "POIN_PELANGGARAN", "POIN_PENGHARGAAN", "USER_ID", "CREATED_AT", "UPDATED_AT"]);

        // return redirect(route('dashboard.index'))->with('success', "Data para siswa telah <strong>berhasil </strong><strong>diexport</strong>!");
    }

    public function exportview()
    {
        return view('dashboard.utills.export', ['title' => 'Thanks for using our service']);
    }

    public function index()
    {
        return view('dashboard.students.index', [
            'title' => 'Semua Data Siswa',
            'students' => Student::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];
        $data_pelanggaran = Pelanggaran::all();
        $data_penghargaan = Penghargaan::all();
        $tipeRule = ['Pelanggaran', 'Penghargaan'];

        return view('dashboard.students.create', [
            'title' => 'Tambahkan Siswa Baru',
            'tingkatan' => $tingkatan,
            'jurusan' => $jurusan,
            'tipe_rule' => $tipeRule,
            'urutan' => $urutan,
            'classes' => Kelas::all(),
        ], compact('data_pelanggaran', 'data_penghargaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required|max:255',
            'nis' => 'required|unique:students',
            'jenis_kelamin' => 'required',
        ];

        $requestData = $request->all();

        // if ($request->pelanggaran_id != null) {
        //     $rules['pelanggaran_id'] = 'required';
        //     $requestData['pelanggaran_id'] = $request->pelanggaran_id;
        // }

        // if ($request->penghargaan_id != null) {
        //     $rules['penghargaan_id'] = 'required';
        //     $requestData['penghargaan_id'] = $request->penghargaan_id;
        // }

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $requestData['class_id'] = $kelas->id;
                $rules['class_id']  = 'required';
            }
        }

        // foreach (RuleData::all() as $rule) {
        //     if ($request->rule_data_id == $rule->id) {
        //         $requestData['point'] = $rule->point;
        //         $rules['point']  = 'required';
        //     }
        // }
        // dd($requestData);
        $request->merge(['class_id' => $requestData['class_id']]);
        $request->merge(['point' => $requestData['point']]);
        // $request->merge(['pelanggaran_id' => $requestData['pelanggaran_id']]);
        // $request->merge(['penghargaan_id' => $requestData['penghargaan_id']]);


        $validatedData = $request->validate($rules);

        Student::create($validatedData);
        // Student::pelanggarans()->attach([$request->pelanggaran_id]);
        // $student = Student::where('id', $request->id)->get();
        // dd(Student::where('id', $request->id)->get());
        // if ($request->pelanggaran_id != null) {
        //     $student->pelanggarans()->attach([$request->pelanggaran_id]);
        // }
        // if ($request->penghargaan_id != null) {
        //     $student->penghargaans()->attach([$request->penghargaan_id]);
        // }


        $title = $validatedData['nama'];

        return redirect(route('students.index'))->with('success', "Data Siswa <strong>$title</strong> berhasil <strong>ditambahkan</strong>!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];
        return view('dashboard.students.edit', [
            'title' => 'Edit Data Siswa',
            'student' => $student,
            'tingkatan' => $tingkatan,
            'jurusan' => $jurusan,
            'urutan' => $urutan,
            'classes' => Kelas::all(),
            // 'rule-data' => RuleData::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $rules = [
            'nama' => 'required|max:255',
            'class_id' => 'required',
            'jenis_kelamin' => 'required',
        ];

        if ($request->nis != $student->nis) {
            $rules['nis'] = 'required|unique:students';
        }
        $requestData = $request->all();
        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $requestData['class_id'] = $kelas->id;
                $rules['class_id']  = 'required';
            }
        }

        $request->merge(['class_id' => $requestData['class_id']]);

        $validatedData = $request->validate($rules);
        Student::where('id', $student->id)->update($validatedData);

        $title = $student->nama;

        return redirect(route('students.index'))->with('success', "Data siswa <strong>$title</strong> telah berhasil <strong>diubah!</strong>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);

        $title = $student->nama;
        return redirect(route('students.index'))->with('success', "Siswa <strong>$title</strong> telah <strong>dihapus!</strong>");
    }
}
