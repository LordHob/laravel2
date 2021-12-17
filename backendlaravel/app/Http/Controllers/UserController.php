<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;

class UserController extends Controller
{
    //
    public function showAllUser()
    {

        try {

            return User::all();
        } catch (QueryException $error) {
            return $error;
        }
    }
    ////////////////Crear Usuarios////////////////
    public function addUsers(Request $request)
    { //sin id y sin fecha

        $email = $request->input('email');
        $userName = $request->input('userName');
        $password = $request->input('password');
        $role = $request->input('role');
        $steamUserName = $request->input('steamUserName');

        try {

            return User::create(
                [
                    'email' => $email,
                    'userName' => $userName,
                    'password' => $password,
                    'role' => $role,
                    'steamUserName' => $steamUserName,
                ]
            );
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];


            return response()->json([
                'error' => $codigoError
            ]);
        }
    }
    ////////////////Modificar Usuarios////////////////
    public function UpdateUsers(Request $request, $id)
    {


        $email = $request->input('email');
        $userName = $request->input('userName');
        $password = $request->input('password');
        $steamUserName = $request->input('steamUserName');

        try {

            $User = User::where('id', '=', $id)
                ->update(
                    [
                        'email' => $email,
                        'userName' => $userName,
                        'password' => $password,
                        'steamUserName' => $steamUserName,
                    ]
                );
            return User::all()
                ->where('id', "=", $id);
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    //Busqueda por la ID de Usuarios //

    public function UsersByID($id)
    {

        try {
            $User = User::all()
                ->where('id', "=", $id);
            return $User;
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }

    //Borrar los Usuarios //
    public function DeleteUsers($id)
    {

        try {
            $arrayUser = User::all()
                ->where('id', '=', $id);

            $User = User::where('id', '=', $id);

            if (count($arrayUser) == 0) {
                return response()->json([
                    "data" => $arrayUser,
                    "message" => "No se ha encontrado el usuario"
                ]);
            } else {
                $User->delete();
                return response()->json([
                    "data" => $arrayUser,
                    "message" => "Usuario borrado correctamente"
                ]);
            }
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
}
