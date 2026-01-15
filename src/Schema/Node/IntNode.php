<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Node;

use Swiftly\Config\Schema\AbstractNode;
use Swiftly\Config\Schema\HasRangeInterface;
use Swiftly\Config\Schema\IsConfigurableInterface;
use Swiftly\Config\Schema\IsOneOfInterface;
use Swiftly\Config\Schema\Trait\HasMaximum;
use Swiftly\Config\Schema\Trait\HasMinimum;
use Swiftly\Config\Schema\Trait\IsOneOf;
use Swiftly\Config\Type;

use function is_int;

/**
 * @api
 *
 * @implements IsOneOfInterface<int>
 */
final class IntNode extends AbstractNode implements
    HasRangeInterface,
    IsConfigurableInterface,
    IsOneOfInterface
{
    use HasMaximum;
    use HasMinimum;
    /** @use IsOneOf<int> */
    use IsOneOf;

    /**
     * @param non-empty-string $key
     */
    public function __construct(string $key)
    {
        parent::__construct($key);

        $this->oneOf(null);
        $this->maximum(null);
        $this->minimum(null);
        $this->nullable(false);
        $this->optional(false);
    }

    /**
     * {@inheritDoc}
     */
    public function range(int|float $minimum, int|float $maximum): static
    {
        $this->maximum((int) $maximum);
        $this->minimum((int) $minimum);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configure(array $config): static
    {
        parent::configure($config);

        if (!empty($config['oneOf']) && Type::isIntArray($config['oneOf'])) {
            $this->oneOf($config['oneOf']);
        }

        if (isset($config['maximum']) && is_int($config['maximum'])) {
            $this->maximum($config['maximum']);
        }

        if (isset($config['minimum']) && is_int($config['minimum'])) {
            $this->minimum($config['minimum']);
        }

        if (isset($config['range'][0], $config['range'][1])
            && is_int($config['range'][0])
            && is_int($config['range'][1])
        ) {
            $this->range($config['range'][0], $config['range'][1]);
        }

        return $this;
    }
}
