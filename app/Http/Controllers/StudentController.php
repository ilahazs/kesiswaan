<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Student;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];
        $data_pelanggaran = Pelanggaran::all();
        $data_penghargaan = Penghargaan::all();
        $tipeRule = ['Pelanggaran', 'Penghargaan'];

        return view('dashboard.students.index', [
            'title' => 'Semua Data Siswa',
            'students' => Student::orderBy('updated_at', 'desc')->get(),
            'tingkatan' => $tingkatan,
            'jurusan' => $jurusan,
            'tipe_rule' => $tipeRule,
            'urutan' => $urutan,
            'classes' => Kelas::all(),
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
        $rules = [
            'nama' => 'required|max:255',
            'nis' => 'required|min:8|unique:students',
            'tingkatan_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'urutan_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'notelp' => 'min:8|'
        ];

        $requestData = $request->all();

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $requestData['class_id'] = $kelas->id;
                $rules['class_id']  = 'required';
            }
        }

        $request->merge(['class_id' => $requestData['class_id']]);
        $request->merge(['point' => $requestData['point']]);

        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return redirect(route('students.index'))->withErrors($validator);
        }

        // 3 Tahap
        $validated = $validator->validate();

        $student = Student::create($validated);

        User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'gender' => $request->jenis_kelamin,
            'role' => 'siswa',
            'email' => "$request->nis@gmail.com",
            'password' => Hash::make($request->nis)
        ]);

        $user = User::where('username', $request->nis)->get()[0]->id;
        $student->user_id = $user;
        $student->save();



        $title = $request['nama'];

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
        $title = $student->nama;
        Student::destroy($student->id);

        return redirect(route('students.index'))->with('success', "Siswa <strong>$title</strong> telah berhasil <strong>dihapus!</strong>");
    }
}
