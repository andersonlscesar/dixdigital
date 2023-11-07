<?php
return [
    'custom' => [
        'name' => [
            'required' => 'O campo "Nome" é obrigatório'
        ],
        'email' => [
            'required' => 'O campo "E-mail" é obrigatório'
        ],
        'password' => [
            'required' => 'O campo "Senha" é obrigatório',
            'confirmed' => 'As senhas estão diferentes.',
            'min' => 'A senha deve possuir no mínimo :min caracteres.'
        ],
        'agree_terms_and_conditions' => [
            'required' => 'Por favor, aceite os termos e condições do site'
        ],
        'old_password' => [
            'required' => 'Informe sua senha atual.',
            'min' => 'A senha deve possuir no mínimo :min caracteres.'
        ]
    ]
];
