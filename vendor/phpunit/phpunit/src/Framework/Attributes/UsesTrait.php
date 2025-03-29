<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Attributes;

use Attribute;

/**
 * @immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class UsesTrait
{
    /**
     * @var trait-string
     */
    private string $traitName;

    /**
     * @param trait-string $traitName
     */
    public function __construct(string $traitName)
    {
        $this->traitName = $traitName;
    }

    /**
     * @return trait-string
     */
    public function traitName(): string
    {
        return $this->traitName;
    }
}
