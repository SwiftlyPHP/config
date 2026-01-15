<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\IsConfigurableInterface;
use Swiftly\Config\Schema\IsOneOfInterface;
use Swiftly\Config\Schema\Trait\IsOneOf;
use Swiftly\Config\Type;

/**
 * @api
 *
 * @implements IsOneOfInterface<string>
 *
 * @upgrade:php8.1 Mark properties as readonly
 */
final class StringNode extends AbstractNode implements
    IsConfigurableInterface,
    IsOneOfInterface
{
    /** @use IsOneOf<string> */
    use IsOneOf;

    /**
     * @param non-empty-string $key
     */
    public function __construct(string $key)
    {
        parent::__construct($key);

        $this->oneOf(null);
        $this->nullable(false);
        $this->optional(false);
    }

    /**
     * {@inheritDoc}
     */
    public function configure(array $config): void
    {
        if (!empty($config['oneOf']) && Type::isStringArray($config['oneOf'])) {
            $this->oneOf($config['oneOf']);
        }
    }
}
