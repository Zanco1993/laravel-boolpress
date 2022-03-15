<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // voglio solo i post dell'utente che è loggato quindi
        // tramite l'interrogazione where, filtro solo l'utente loggato
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // questa funzione ci manda alla pagina del form per aggiungere i dati
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazioni dati inseriti dall'utente
        $data = $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|min:10',
            'category_id' => 'nullable'
        ]);
        // nel model vado a creare la variabile $fillable che eseguirà per noi un'istanza degli
        // elementi presenti nell'array, quindi il nome delle colonne
        $post = new Post();
        $post->fill($data);
        // prima di eseguire il save, creo lo slug
        $slug = Str::slug($post->title);
        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
            $newSlug = $slug . "-" . $counter;
            $counter++;

            $exists = Post::where("slug", $newSlug)->first();

            if (!$exists) {
                $slug = $newSlug;
            }
        }
        $post->slug = $slug;
        // MOLTO IMPORTANTE
        // andiamo a prendere l'ID dell'utente loggato prima del save
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // usande lo $slug, non possiamo usare il findOrFail come si faceva con l'ID
        // $post = Post::where("slug", $slug)->first();

        // in questo caso, preferisco usare l'ID
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view("admin.posts.edit", [
            "post" => $post,
            "categories" => $categories
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validazioni dati inseriti dall'utente
        $data = $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|min:10',
            'category_id' => 'nullable'
        ]);

        $post = Post::findOrFail($id);
        $post->fill($data);



        $slug = Str::slug($post->title);
        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
            $newSlug = $slug . "-" . $counter;
            $counter++;

            $exists = Post::where("slug", $newSlug)->first();

            if (!$exists) {
                $slug = $newSlug;
            }
        }
        $post->slug = $slug;

        $post->update($data);
        $post->save();

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
