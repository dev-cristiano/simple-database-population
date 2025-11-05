<?php
declare(strict_types = 1);

require_once '../vendor/autoload.php';

use App\Core\Connection;
use App\Repositories\WaitingListRepository;
use App\Services\WaitingListService;
use Dotenv\Dotenv;

// Carrega as variáveis de ambiente
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Instâncio a conexão com o banco
$connection = new Connection();
$pdo = $connection->connecting();

// Instâncio a Factory para utilizar as Fakes da biblioteca
$faker = Faker\Factory::create('pt_BR');

// Instâncio o Repository e o Service
$waitingRepo = new WaitingListRepository($pdo);
$waitingServ = new WaitingListService($waitingRepo);

for ($i = 1; $i < 51; $i++) {

    $data = [
        'nome_mae' => $faker->name('female'),
        'nome_pai' => $faker->name('male'),
        'data_nascimento' => $faker->date('Y-m-d'),
        'id_unidade_escolar' => 9,
        'ano_letivo' => 2019,
        'id_turma' => 92,
        'status' => 1,
        'codigo_crianca' => 'EDU-' .date('Ymd'). '-' . $i,
    ];

    $result = $waitingServ->createPeopleWaitingList($data);

    echo "Registro {$i} inserido com ID {$result['id']} e código {$result['codigo_crianca']}" . PHP_EOL;
}
