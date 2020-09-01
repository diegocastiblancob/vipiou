<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
class imageController extends Controller
{
    /*
     * subir una imagen al servidor
     * return: nombre de la imagen subida
     */
    public function upload(Request $request) {
        //recoger datos por post
        $image = $request->file('file0');
        //validacion de la imagen
        $validate = \Validator::make($request->all(), [
                    'file0' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        //subir y guardar imagen
        if (!$image || $validate->fails()) {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Imagen NO subida',
                'fails' => $validate->errors()
            );
        } else {
            $image_name = time() . $image->getClientOriginalName();
            \Storage::disk('images')->put($image_name, \File::get($image));
            $data = array(
                'code' => 200,
                'status' => 'success',
                'logo' => $image_name
            );
        }
        return response()->json($data, $data['code']);
    }
    /*
     * consultar una imagen en concreto
     * return: imagen
     */
    public function getImage($fileName) {
        $isset = \Storage::disk('images')->exists($fileName);
        if ($isset) {
            $file = \Storage::disk('images')->get($fileName);
            return new Response($file, 200);
        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Imagen NO encontrada'
            );
            return response()->json($data, $data['code']);
        }
    }
}
