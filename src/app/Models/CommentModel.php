<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';

    protected $allowedFields = [
        'email','text','reply_id','created_at'
    ];

    protected $validationRules = [
        'email' => 'required|valid_email',
        'text' => 'required',
        'created_at' => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'The email field is required.',
            'valid_email' => 'The email address isn`t acceptable.'
        ],
        'text' => [
            'required' => 'The comment field is required.',
        ],
        'created_at' => [
            'required' => 'The datetime field is required.'
        ]
    ];
}
