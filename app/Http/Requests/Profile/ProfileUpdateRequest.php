<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();

    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'password' => 'nullable|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'display_name' => 'required',
            'slug' => 'required|unique:users,slug,' . Auth::user()->id,
            'date_of_birth' => 'nullable|date',
            'website_url' => 'nullable|url',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getValidRequest($id = 0)
    {
        //dd($this->password);
        return [
            'email' => $this->email,
            //'password' => Hash::make($this->password),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'display_name' => $this->display_name,
            'slug' => $this->createSlug($this->display_name, $id),
            'address' => $this->address,
            'postcode' => $this->postcode,
            'town' => $this->town,
            'country' => $this->country,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'job' => $this->job,
            'date_of_birth' => $this->date_of_birth,
            'facebook_name' => $this->facebook_name,
            'twitter_name' => $this->twitter_name,
            'linkedin_name' => $this->linked_in_name,
            'github_name' => $this->github_name,
            'website_url' => $this->website_url,
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
        return User::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
