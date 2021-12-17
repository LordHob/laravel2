<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Party;

class PartyController extends Controller

{
    //
    public function newparty(Request $request)
    {


        $name = $request->input('name');
        $idUser = $request->input('idUser');
        $idGame = $request->input('idGame');

        try {

            return Party::create(
                [
                    'name' => $name,
                    'idUser' => $idUser,
                    'idGame' => $idGame,
                ]
            );
        } catch (QueryException $error) {
            echo "error";
            $codigoError = $error->errorInfo[1];

            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    public function showpartyByID($id)
    {


        try {
            $Party = Party::all()
                ->where('id', "=", $id);
            return $Party;
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    public function showAllparty()
    {

        try {

            return Party::all();
        } catch (QueryException $error) {
            return $error;
        }
    }

    public function Deleteparty($id)
    {

        try {
            $arrayParty = Party::all()
                ->where('id', '=', $id);

            $Party = Party::where('id', '=', $id);

            if (count($arrayParty) == 0) {
                return response()->json([
                    "data" => $arrayParty,
                    "message" => "No se ha encontrado el Party"
                ]);
            } else {
                $Party->delete();
                return response()->json([
                    "data" => $arrayParty,
                    "message" => "Party borrado correctamente"
                ]);
            }
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    public function Updateteparty(Request $request, $id)
    {

        $name = $request->input('name');
        $idUser = $request->input('idUser');
        $idGame = $request->input('idGame');

        try {

            $Party = Party::where('id', '=', $id)
                ->update(
                    [
                        'name' => $name,
                        'idUser' => $idUser,
                        'idGame' => $idGame,

                    ]
                );
            return Party::all()
                ->where('id', "=", $id);
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
}
