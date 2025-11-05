<?php

namespace App\Services;

use App\Repositories\WaitingListRepository;

class WaitingListService
{
    private WaitingListRepository $repository;

    public function __construct(WaitingListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPeopleWaitingList(array $data): array
    {
        $id = $this->repository->insert($data);

        return [
            'success' => true,
            'message' => 'Pessoa adicionada com sucesso',
            'id' => $id,
            'codigo_crianca' => $data['codigo_crianca'],
        ];
    }
}