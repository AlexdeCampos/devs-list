<?php

namespace Tests\Unit;

use Tests\TestCase;;

use App\Http\Controllers\DevelopersController;

class DeveloperTest extends TestCase
{

    /**
     * @test
     * @dataProvider developerProvider
     */
    public function testManageDeveloper($developer)
    {
        $devController = new DevelopersController();

        //create a new developer and set the returned id
        $setDeveloper = $devController->set(null, $developer);
        $developerData = $setDeveloper->getData();
        $id = $developerData->data->id;
        $developer["id"] = $id;

        $status = $setDeveloper->getStatusCode();
        $this->assertEquals(202, $status, $developerData->message);

        //get the developer by the returned id
        $getDeveloper = $devController->get($id);
        $developerData = $getDeveloper->getData();
        $status = $setDeveloper->getStatusCode();

        $this->assertEquals(202, $status, $developerData->message);
        $this->assertEquals((object)$developer, $developerData->data);

        //edit developer
        $developer = [
            "nome" => "Aline",
            "sexo" => "F",
            "idade" => 25,
            "hobby" => "Esqui",
            "datanascimento" => "1994-07-16"
        ];

        $setDeveloper = $devController->set($id, $developer);
        $developerData = $setDeveloper->getData();
        $developer["id"] = $id;
        $status = $setDeveloper->getStatusCode();
        $this->assertEquals(202, $status, $developerData->message);

        $getDeveloper = $devController->get($id);
        $developerData = $getDeveloper->getData();
        $status = $setDeveloper->getStatusCode();

        $this->assertEquals(202, $status, $developerData->message);
        $this->assertEquals((object)$developer, $developerData->data);

    }

    public function developerProvider()
    {
        return [
            [
                [
                    "nome" => "Alex",
                    "sexo" => "M",
                    "idade" => 21,
                    "hobby" => "Cozinhar",
                    "datanascimento" => "1999-07-16"
                ]
            ],
            [
                [
                    "nome" => "Alex",
                    "sexo" => "M",
                    "idade" => 21,
                    "hobby" => "Tocar guitarra",
                    "datanascimento" => "1999-07-16"
                ]
            ]
        ];
    }
}
