<?php

namespace App\Services;

use App\InterfacesModels\CommentsCommunicationType;

class CommentsCreator
{
    public function create(CommentsCommunicationType $model, $request)
    {
        $data = $request->validate([
            'body' => 'required',
           ]);
        $data['owner_id'] = auth()->user()->id;
        $model->comments()->create($data);
    }
}

