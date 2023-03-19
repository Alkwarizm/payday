<?php


namespace App\ValueObjects;


class Amount
{
    public function __construct(
        private Money $cents,
        private Money $dollars
    )
    {
    }

    public static function from(int $valueInCents): self
    {
        return new static(
          Money::from($valueInCents),
          Money::from($valueInCents)
        );
    }

    /**
     * @return array{cents: int, dollars: string}
     */
    public function toArray(): array
    {
        return [
            'cents' => $this->cents->toCents(),
            'dollars' => $this->dollars->toDollars()
        ];
    }
}
