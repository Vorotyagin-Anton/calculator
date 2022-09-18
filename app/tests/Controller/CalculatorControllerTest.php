<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Calculator');
        $this->assertSelectorTextContains('form', '');

        /* OK */
        $postDataTestArrays = [
            [
                'number1' => 1,
                'number2' => 1,
                'operation' => 'Plus',
                'total' => 2
            ],
            [
                'number1' => 10,
                'number2' => 5,
                'operation' => 'Minus',
                'total' => 5
            ],
            [
                'number1' => 3,
                'number2' => 3,
                'operation' => 'Times',
                'total' => 9
            ],
            [
                'number1' => 12.4,
                'number2' => 4,
                'operation' => 'Divided By',
                'total' => 3.1
            ]
        ];

        $form = $crawler->selectButton('Calculate')->form();
        foreach ($postDataTestArrays as $postData) {
            $form['operation']->select($postData['operation']);
            $form['number1']->setValue($postData['number1']);
            $form['number2']->setValue($postData['number2']);

            $client->submit($form);

            $this->assertStringContainsString(
                "<h1>{$postData['number1']} {$postData['operation']} {$postData['number2']} equals {$postData['total']}</h1>",
                $client->getResponse()->getContent()
            );
        }

        /* FAIL */
        $form['operation']->select('Plus');
        $form['number1']->setValue(123);
        $form['number2']->setValue('asd');

        $client->submit($form);

        $this->assertStringContainsString(
            <<<STRING
                <p style="color: red">'Numeric values are required'</p>
            STRING,
            $client->getResponse()->getContent()
        );
    }
}