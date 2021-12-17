<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //crear los mensajes
    public function createMessage(Request $request)
    {

        $idUser = $request->input('idUser');
        $idParty = $request->input('idParty');
        $message = $request->input('message');

        try {

            return Message::create(
                [
                    'idUser' => $idUser,
                    'idParty' => $idParty,
                    'message' => $message,

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
    //ver los mensajes por la id
    public function MessagebyID($id)
    {


        try {
            $Message = Message::all()
                ->where('id', "=", $id);
            return $Message;
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    public function deleteMessage($id)
    {

        try {
            $arrayMessage = Message::all()
                ->where('id', '=', $id);

            $Message = Message::where('id', '=', $id);

            if (count($arrayMessage) == 0) {
                return response()->json([
                    "data" => $arrayMessage,
                    "message" => "No se ha encontrado el Mensaje"
                ]);
            } else {
                $Message->delete();
                return response()->json([
                    "data" => $arrayMessage,
                    "message" => "Mensaje borrado correctamente"
                ]);
            }
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    public function showAllMessage()
    {

        try {

            return Message::all();
        } catch (QueryException $error) {
            return $error;
        }
    }
}
