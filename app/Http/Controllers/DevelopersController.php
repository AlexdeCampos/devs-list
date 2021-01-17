<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use App\Models\Developer;


class DevelopersController extends Controller
{

    // Record Search (All records/Filtered)
    public function get($id, $page = 1, $quantity = 10)
    {
        if ($id) {
            $developer = Developer::find($id);

            if ($developer) {
                return \response()->json([
                    'data' => $developer,
                    'message' => "Success!",
                ], Response::HTTP_ACCEPTED);
            }

            return \response()->json([
                'data' =>  (object) [],
                'message' => "Developer not found!",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $quantity = ($quantity) ? (float) $quantity : 10;
        $page = ($page) ? (float) $page : 1;
        $offset = $quantity * ($page - 1);

        $developers = Developer::all()
            ->sortBy(['nome', 'idade'])
            ->skip($offset)
            ->take($quantity);

        $list = [];
        foreach ($developers as $developer) {
            $list[] = $developer;
        }
        $pagination = $this->getPagination($page, $quantity);

        return \response()->json([
            'pagination' => $pagination,
            'data' =>  $list,
            'message' => 'Sucesso!!',
        ], Response::HTTP_ACCEPTED);
    }

    // Record Deletion 
    public function delete($id)
    {
        $developer = Developer::find($id);

        if ($developer) {
            $developer->delete();
            return \response()->json([
                'data' =>  [],
                'message' => "Developer successfully deleted!",
            ], Response::HTTP_ACCEPTED);
        }

        return \response()->json([
            'data' =>  [],
            'message' => "Developer not found!",
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    // Record Inclusion/Editing
    public function set($id = null, $req)
    {
        if (!empty($id)) {
            $developer = Developer::find($id);

            if (!$developer) {
                return \response()->json([
                    'data' =>  (object) [],
                    'message' => 'Developer not found!',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $developer = new Developer();
        }

        $developer->nome = $req["nome"];
        $developer->sexo = $req["sexo"];
        $developer->idade = $req["idade"];
        $developer->hobby = $req["hobby"];
        $developer->datanascimento = $req["datanascimento"];
        $developer->save();

        return \response()->json([
            'data' =>  $developer,
            'message' => 'Sucesso!',
        ], Response::HTTP_ACCEPTED);
    }

    public function getPagination($page, $quantity)
    {
        $count = Developer::count();

        $pages =  ceil($count / $quantity);
        return [
            "page" => $page,
            "quantity" => $quantity,
            "pages" => $pages
        ];
    }
}
