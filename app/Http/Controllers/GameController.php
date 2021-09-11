<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;
use App\Http\Resources\GameResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Support\Facades\Cache;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GameModel = app(Game::class);

        $GamesResource =  new GameResource($GameModel->with('category')->paginate('10'));

        return view('games.index', ['games' => $GamesResource]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryModel = app(Category::class);

        Cache::forget('category');

        $categoriesResource = Cache::remember('category', (60*5), function () use($categoryModel) {
            return CategoryResource::collection($categoryModel->all());
        });
        return view('games.create', ['categories' => $categoriesResource]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        $data = $request->validated();

        $GameModel = app(Game::class);

        $Game = $GameModel->create($data);

        if($Game){
            return redirect()->route('games.index')->with('success', 'Jogo cadastrado com sucesso!');
        }
        else{
            return redirect()->route('games.index')->with('warning', 'Erro ao cadastrar o Jogo!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $GameModel = app(Game::class);
        $categoryModel = app(Category::class);
        $Game = $GameModel->with('category')->find($id);
        $categoriesResource = Cache::remember('category', (60*5), function () use($categoryModel) {
            return CategoryResource::collection($categoryModel->all());
        });
        $GameResource =  new GameResource($Game);
        return view('games.edit', compact('GameResource','categoriesResource'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, $id)
    {
        $data = $request->validated();
        $GameModel = app(Game::class);
        $Game = $GameModel->find($id)->update($data);

        if($Game){
            return redirect()->route('games.index')->with('success', 'Jogo Atualizado com sucesso!');
        }
        else{
            return redirect()->route('games.index')->with('warning', 'Erro ao Atualizar o Jogo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *qew
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $GameModel = app(Game::class);
        $Game = $GameModel->find($id)->delete();

        return redirect()->route('games.index')->with('warning', 'Jogo deletado com sucesso!');
    }
}
