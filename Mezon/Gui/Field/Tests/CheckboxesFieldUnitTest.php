<?php
namespace Mezon\Gui\Field\Tests;

class CheckboxesFieldUnitTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Method returns mock object of the custom field
     *
     * @return object mock object of the custom field
     */
    protected function getFieldMock(array $items = [
        [
            'id' => 1
        ]
    ]): object
    {
        $mock = $this->getMockBuilder(\Mezon\Gui\Field\CheckboxesField::class)
            ->setConstructorArgs(
            [
                [
                    'name' => 'name',
                    'required' => 1,
                    'disabled' => 1,
                    'custom' => 1,
                    'name-prefix' => 'prefix',
                    'batch' => 1,
                    'toggler' => 'toggler-name',
                    'toggle-value' => 3,
                    'bind-field' => 'id',
                    'session-id' => 'sid',
                    'remote-source' => 'http://ya.ru',
                    'type' => 'int',
                    'class' => 'cls',
                    'items' => [
                        [
                            'id' => 111,
                            'title' => 'title1'
                        ],
                        [
                            'id' => 222,
                            'title' => 'title2'
                        ]
                    ]
                ],
                ''
            ])
            ->setMethods([
            'getExternalRecords'
        ])
            ->getMock();

        $mock->method('getExternalRecords')->willReturn($items);

        return $mock;
    }

    /**
     * Testing constructor
     */
    public function testConstructor()
    {
        // setup
        $field = $this->getFieldMock();

        // test body
        $content = $field->html();

        // assertions
        $this->assertStringContainsString('type="checkbox"', $content);
        $this->assertStringContainsString('class="cls"', $content);
        $this->assertStringContainsString('111', $content);
        $this->assertStringContainsString('222', $content);
        $this->assertStringContainsString('title1', $content);
        $this->assertStringContainsString('title2', $content);
    }
}
