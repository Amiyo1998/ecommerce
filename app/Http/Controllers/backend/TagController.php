<?php

namespace App\Http\Controllers\backend;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $data['title'] = __("Tag");
        $data['tags'] = Tag::paginate(5);
        return view('backend.pages.tags.index', $data);
    }
    public function create()
    {
        $data['title'] = __("Tag/Create");
        return view('backend.pages.tags.create', $data);
    }
    public function store(TagRequest $request)
    {
        $tag =Tag::create([
            'name' =>$request->get('name'),
        ]);
        if(empty($tag))
        {
            return redirect()->back();
        }
        return redirect()->route('tags.index')->with('message', 'Tag created successfull!!');
    }
    public function show($id)
    {
        //
    }
    public function edit(Tag $tag)
    {
        $data['title'] = __("Tag/Edit");
        $data['tag'] = $tag;
        return view('backend.pages.tags.edit', $data);
    }
    public function update(TagRequest $request, Tag $tag)
    {
        $params = $request->only(['name']);
        if($tag->update($params))
        {
            return redirect()->route('tags.index')->with('message', 'Tag edited successfull!!');
        }
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('message', 'Tag deleted successfull!!');
    }
}
