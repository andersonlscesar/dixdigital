<?php
return [
    'custom' => [
        'name' => [
            'required' => 'O campo "Nome" é obrigatório'
        ],

        'email' => [
            'required' => 'O campo "E-mail" é obrigatório',
            'unique'    => 'Este e-mail já está em uso'
        ],

        'password' => [
            'required' => 'O campo "Senha" é obrigatório',
            'confirmed' => 'As senhas estão diferentes.',
            'min' => 'A senha deve possuir no mínimo :min caracteres.',
            'different' => 'A nova senha não pode ser igual a senha atual.'
        ],

        'agree_terms_and_conditions' => [
            'required' => 'Por favor, aceite os termos e condições do site'
        ],

        'old_password' => [
            'required' => 'Informe sua senha atual.',
            'min' => 'A senha deve possuir no mínimo :min caracteres.'
        ],

        'title' => [
            'required' => 'Informe o título da notícia.',
            'max'   => 'O título pode conter até :max caracteres'
        ],

        'content' => [
            'required' => 'Informe o conteúdo da notícia'
        ],
        'image' => [
            'uploaded' => 'Arquivo não carregado. Escolha outra imagem.'
        ]

    ]
];
