<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller

{
    //CREAR Game//
    public function createGame(Request $request)
    {

        $name = $request->input('name');
        $company = $request->input('company');
        $description = $request->input('description');


        try {

            return Game::create(
                [
                    'name' => $name,
                    'company' => $company,
                    'description' => $description,

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
    //BUSCAR Games//
    public function showGameByID($id)
    {


        try {
            $Game = Game::all()
                ->where('id', "=", $id);
            return $Game;
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }

    //VER TODOS LOS Games//
    public function showAllGame()
    {

        try {

            return Game::all();
        } catch (QueryException $error) {
            return $error;
        }
    }

    //ACTUALIZAR Games//
    public function updateGame(Request $request, $id)
    {

        $name = $request->input('name');
        $company = $request->input('company');
        $description = $request->input('description');


        try {

            $Game = Game::where('id', '=', $id)
                ->update(
                    [
                        'name' => $name,
                        'company' => $company,
                        'description' => $description,

                    ]
                );
            return Game::all()
                ->where('id', "=", $id);
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }


    //BORRAR Games//
    public function deleteGame($id)
    {

        try {
            $arrayGame = Game::all()
                ->where('id', '=', $id);

            $Game = Game::where('id', '=', $id);

            if (count($arrayGame) == 0) {
                return response()->json([
                    "data" => $arrayGame,
                    "message" => "No se ha encontrado el Game"
                ]);
            } else {
                $Game->delete();
                return response()->json([
                    "data" => $arrayGame,
                    "message" => "Game borrado correctamente"
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
