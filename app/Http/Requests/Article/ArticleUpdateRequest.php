<?php

namespace App\Http\Requests\Article;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Input;
use App\Models\Article;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('superadministrator|administrator|user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', Rule::unique('articles', 'title')->ignore($this->title, 'title')],
            'slug' => ['required', Rule::unique('articles', 'slug')->ignore($this->slug, 'slug')],
            'category' => 'required|numeric',
            'author_id' => 'required|numeric',
            'content' => 'required',
        ];

    }

    public function getValidRequest($id = 0)
    {
        return [
            'author_id' => $this->input('author_id'),
            'category_id' => $this->input('category'),
            'slug' => $this->createSlug($this->input('title'), $id),
            'title' => $this->input('title'),
            'subtitle' => $this->input('subtitle'),
            'content' => $this->input('content'),
            'article_image' => $this->input('article_image'),
            'meta_keywords' => $this->input('meta_keywords'),
            'meta_description' => $this->input('meta_description'),
            'is_published' => $this->input('is_published') ?? false,
            'published_at' => $this->input('published_at'),
        ];
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Article::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

}
