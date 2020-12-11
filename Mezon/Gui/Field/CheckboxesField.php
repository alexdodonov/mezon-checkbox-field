<?php
namespace Mezon\Gui\Field;

use Mezon\Functional\Fetcher;
use Mezon\Gui\Field;
use Mezon\Gui\FieldAttributes;

/**
 * Class CheckboxesField
 *
 * @package Field
 * @subpackage CheckboxesField
 * @author Dodonov A.A.
 * @version v.1.0 (2019/09/13)
 * @copyright Copyright (c) 2019, aeon.org
 */

/**
 * Checkboxes field control
 */
class CheckboxesField extends Field
{

    /**
     * Method returns record's title
     *
     * @param array $record
     *            Data source
     * @return string Compiled title
     */
    private function getRecordTitle(array $record): string
    {
        if (Fetcher::getField($record, 'title') !== null) {
            return Fetcher::getField($record, 'title');
        } else {
            return 'id : ' . Fetcher::getField($record, 'id');
        }
    }

    /**
     * List of items
     *
     * @var array
     */
    private $items = [];

    /**
     * Constructor
     *
     * @param array $fieldDescription
     *            Field description
     * @param string $value
     *            Field value
     */
    public function __construct(array $fieldDescription, string $value = '')
    {
        parent::__construct($fieldDescription, $value);

        if (isset($fieldDescription['items'])) {
            $this->items = $fieldDescription['items'];
        } else {
            throw (new \Exception('Field "items" was not found'));
        }
    }

    /**
     * Generating records feld
     *
     * @return string HTML representation of the records field
     */
    public function html(): string
    {
        $content = '';

        foreach ($this->items as $item) {
            $id = Fetcher::getField($item, 'id');

            $content .= '<label>
                <input type="checkbox" class="' . $this->class . '" name="' . $this->getNamePrefix() . $this->name .
                '[]" value="' . $id . '" /> ' . $this->getRecordTitle($item) . '
            </label><br>';
        }

        return $content;
    }
}
