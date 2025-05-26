<?php

function registerUser($request) {
    if (!checkUserEmail($request->email)) {
        return json_encode(['success' => false, 'message' => 'Email invalide !']);
    }

    if (getUserByEmail($request->email)) {
        return json_encode(['success' => false, 'message' => 'L\'email est déjà utilisé !']);
    }

    $password = password_hash($request->password, PASSWORD_DEFAULT);

    $result = createUser($request->Name, $request->email, $password);

    if ($result) {
        return json_encode(['success' => true, 'message' => 'Utilisateur créé avec succès !']);
    } else {
        return json_encode(['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur !']);
    }
}
?>