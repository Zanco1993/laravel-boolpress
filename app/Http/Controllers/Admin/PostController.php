<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
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
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
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
        if (key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

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
        $tags = Tag::all();


        return view("admin.posts.edit", [
            "post" => $post,
            "categories" => $categories,
            "tags" => $tags
        ]);
        // passo anche i dati di tags

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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $post = Post::findOrFail($id);

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

        // inserisco questa condizione perchè il valore potrebbe essere nullo
        if (key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

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
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
