<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class InquiryService
{
    public function getInquiryForm($request)
    {
        $data = [
            'user_id' => Auth::id(),
            'genre_id' => $request->genre,
            'title' => $request->title,
            'content' => $request->content,
        ];

        return $data;
    }
}

?>