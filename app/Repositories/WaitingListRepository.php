<?php

namespace App\Repositories;

use PDO;

class WaitingListRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $data): int
    {
        $sql = "INSERT INTO esc_lista_espera 
                    (nome_mae, nome_pai, data_nascimento, id_unidade_escolar, ano_letivo ,id_turma, status, codigo_crianca) 
                VALUES 
                    (:nome_mae, :nome_pai, :data_nascimento, :id_unidade_escolar, :ano_letivo, :id_turma, :status, :codigo_crianca)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                ':nome_mae' => $data['nome_mae'],
                ':nome_pai' => $data['nome_pai'],
                ':data_nascimento' => $data['data_nascimento'],
                ':id_unidade_escolar' => $data['id_unidade_escolar'],
                ':ano_letivo'=> $data['ano_letivo'],
                ':id_turma' => $data['id_turma'],
                ':status' => $data['status'],
                ':codigo_crianca' => $data['codigo_crianca']
            ]);

            return (int)$this->pdo->lastInsertId();

        } catch (\PDOException $e) {
            throw new \RuntimeException('Error insert in waiting list : ' . $e->getMessage());
        }
    }
}