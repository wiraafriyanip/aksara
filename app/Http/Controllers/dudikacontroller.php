<?php

namespace App\Http\Controllers;

use App\Models\dudika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Alert;

class dudikaController extends Controller
{
    //
    public function index()
    {
        $dudikas=dudika::all();
        return view ('dudika.index',compact('dudikas')) ;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'pemimpin'=>'required',
            'nama'=>'required',
            'jabatan'=>'required',
            'umur'=>'required',
            'alamat'=>'required'
           
        ]);
        DB::table('dudikas')->insert([
            'pemimpin'=>$request->nama,
            'nama'=>$request->alamat,
            'jabatan'=>$request->jabatan,
            'umur'=>$request->umur,
            'alamat'=>$request->pemimpin
        ]);
        if(DB::table('dudikas')){
            return redirect()->route('dudika.index')->with(['success'=>'Data berhasil disimpan']);
        }else{
            return redirect()->route('dudika.index')->with(['error'=>'Data gagal disimpan']);
        }
    }
    public function edit($id)
    {
        $dudika=dudika::find($id);
        return view('dudika.edit', compact('dudika'));
    }
    public function update(Request $request, $id)
    {
    $this->validate($request, [
        'pemimpin'=>'required',
            'nama'=>'required',
            'jabatan'=>'required',
            'umur'=>'required',
            'alamat'=>'required'
        
        
        
    ]);
    //get data dudika by ID
 
    $dudika=dudika::findOrFail($id); 
    $dudika->update([
        
        'pemimpin'=>$request->nama,
        'nama'=>$request->alamat,
        'jabatan'=>$request->jabatan,
        'umur'=>$request->umur,
        'alamat'=>$request->pemimpin
        
      
       
    ]); 
    Alert::success('Success', 'data berhasil diedit');
    if($dudika){
    //redirect dengan pesan sukses
    return redirect()->route('dudika.index')->with(['success'=>'Data berhasil 
    disimpan']);
    }else{
        return redirect()->route('dudika.index')->with(['error'=>'Data gagal disimpan']);
    }
    }
    public function destroy($id)
    {
        $dudika = dudika::findOrFail($id);

        $dudika->delete();
        Alert::success('Success', 'data berhasil dihapus');
        if($dudika){
            //redirect dengan pesan sukses
            return redirect()->route('dudika.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('dudika.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
