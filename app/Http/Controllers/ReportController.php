<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function searchByProvince(Request $request)
    {
        $provinceId = $request->input('search');

        if (!$provinceId) {
            return response()->json(['error' => 'Provinsi tidak dipilih'], 400);
        }

        $reports = Report::whereRaw('JSON_UNQUOTE(JSON_EXTRACT(province, "$.id")) = ?', [$provinceId])->get();

        if ($reports->isEmpty()) {
            return response()->json(['error' => 'Tidak ada laporan ditemukan untuk provinsi ini'], 404);
        }

        return response()->json($reports);
    }

    // public function vote(Request $request)
    // {
    //     $report = Report::find($request->id);
    
    //     if (!$report) {
    //         return response()->json(['error' => 'Laporan tidak ditemukan'], 404);
    //     }
    
    //     // Tambahkan voting (contoh: increment jumlah vote)
    //     $report->voting = $report->voting + 1;
    //     $report->save();
    
    //     return response()->json([
    //         'success' => true,
    //         'voting' => $report->voting,
    //         'message' => 'Voting berhasil!'
    //     ]);
    // }


    public function monitoring() 
    {
        return view('Monitoring.monitoring');
    }

    public function index()
    {
        $reports = Report::all();
        return view('Report.article')->with('reports', $reports);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Report.article_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'type' => 'required',
            'province' => 'required|json',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'image' => 'required|image',
        ]);

        // $file = $request->file('image');
        // $filePath = $file->storeAs('uploads', time() . '_' . $file->getClientOriginalName(), 'public');
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        }
        // $imgPath = $file->storeAs('uploads', time() . '_' . $file->storage(), 'public');

        $process = Report::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'type' => $request->type,
            'province' => $request->province, // Ensure province is stored as a JSON string
            'regency' => $request->regency,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'image' => $imagePath,
            'statement' => 1,
        ]);

        if ($process) {
            return redirect()->route('report.create')->with('success', 'Berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('failed', "Gagal ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
        public function show(string $id)
        {
            $report = Report::findOrFail($id);
            $report->increment('viewers'); // Tambahkan view
        
            $comments = $report->comments()->with('user')->get(); // Relasi user dimuat
        
            return view('Comment.comment', compact('report', 'comments'));
        }      
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
