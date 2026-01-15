<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\IsConfigurableInterface;

/**
 * @api
 */
final class BoolNode extends AbstractNode implements IsConfigurableInterface
{
    /**
     * @param non-empty-string $key
     */
    public function __construct(string $key)
    {
        parent::__construct($key);

        $this->nullable(false);
        $this->optional(false);
    }
}
