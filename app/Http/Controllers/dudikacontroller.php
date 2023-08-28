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
            'nama'=>'required',
            'alamat'=>'required',
            'penerbit'=>'required',
            'pengarang'=>'required',
            'pemimpin'=>'required'
           
        ]);
        DB::table('dudikas')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'penerbit'=>$request->penerbit,
            'pengarang'=>$request->pengarang,
            'pemimpin'=>$request->pemimpin
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
        'nama' => 'required',
        'alamat' => 'required',
        'penerbit'=>'required',
        'pengarang'=>'required',
        'pemimpin' => 'required'
        
        
        
    ]);
    //get data dudika by ID
 
    $dudika=dudika::findOrFail($id); 
    $dudika->update([
        
        'nama'=>$request->nama,
        'alamat'=>$request->alamat,
        'penerbit'=>$request->penerbit,
        'pengarang'=>$request->pengarang,
        'pemimpin'=>$request->pemimpin
        
      
       
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
