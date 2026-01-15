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

use function array_map;
use function count;

/**
 * @api
 *
 * @implements IsOneOfInterface<int>
 *
 * @upgrade:php8.1 Mark properties as readonly
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
    public function configure(array $config): void
    {
        if (!empty($config['oneOf'])
            && Type::isIntOrFloatArray($config['oneOf'])
        ) {
            $this->oneOf(array_map('intval', $config['oneOf']));
        }

        if (isset($config['maximum'])
            && Type::isIntOrFloat($config['maximum'])
        ) {
            $this->maximum((int) $config['maximum']);
        }

        if (isset($config['minimum'])
            && Type::isIntOrFloat($config['minimum'])
        ) {
            $this->minimum((int) $config['minimum']);
        }

        if (isset($config['range'])
            && Type::isIntOrFloatArray($config['range'])
            && count($config['range']) === 2
        ) {
            [$minimum, $maximum] = $config['range'];

            $this->range((int) $minimum, (int) $maximum);
        }
    }
}
