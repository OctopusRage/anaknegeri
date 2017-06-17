<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                 => 'required|string|max:128',
            'subtitle'              => 'required|string|max:191',
            'deadline'              => 'required',
            'address'               => 'required|string|max:191',
            'slug'                  => 'required|string|max:64',
            'detail'                => 'required',
            'feature_img'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail'                => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [            
            'feature_img.required'  => 'Upload gambar utama diperlukan',
            'feature_img.max'       => 'Ukuran file terlalu besar',
            'feature_img.mimes'     => 'Format gambar tidak diijinkan',
            'title.required'        => 'Kolom Judul harus diisi',
            'title.max'             => 'panjang judul maksimal 128 karakter',
            'subtitle.required'     => 'Kolom Sub Judul harus diisi',
            'subtitle.max'          => 'Panjang sub judul maksimal 191 karakter',
            'deadline.required'     => 'Kolom Deadline harus diisi',
            'address.required'      => 'Kolom Alamat harus diisi',
            'address.max'           => 'Panjang alamat maksimal 191 karakter',
            'slug.required'         => 'Kolom alamat unik harus diisi',
            'slug.max'              => 'Panjang alamat unik maksimal 64 karakter',
            'detail.required'       => 'Kolom Detail harus diisi'

        ];
    }
}
