<?php
$app->get('/users', function ($request, $response, $args) {
    $stmt = $this->db->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $response->withJson($users);
});

$app->get('/users/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $response->withJson($user);
});

$app->post('/users', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->execute(['name' => $data['name'], 'email' => $data['email']]);
    return $response->withJson(['id' => $this->db->lastInsertId()]);
});

$app->put('/users/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $data = $request->getParsedBody();
    $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute(['name' => $data['name'], 'email' => $data['email'], 'id' => $id]);
    return $response->withJson(['status' => 'success']);
});

$app->delete('/users/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $response->withJson(['status' => 'success']);
});
