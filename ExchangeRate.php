<?php

class ExchangeRate {
    private $toAmount;
    private $fromAmount;
    private $toCurrency;
    private $fromCurrency;
    private $status;

    public function __construct(
        $fromCurrency,
        $toCurrency,
        $fromAmount,
        $toAmount,
        $status = 'proposed'
    ) {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->fromAmount = $fromAmount;
        $this->toAmount = $toAmount;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getFromCurrency(): string {
        return trim($this->fromCurrency);
    }

    /**
     * @return string
     */
    public function getToCurrency(): string {
        return trim($this->toCurrency);
    }

    /**
     * @return string
     */
    public function getFromAmount(): string {
        return trim($this->fromAmount);
    }

    /**
     * @return string
     */
    public function getToAmount(): string {
        return trim($this->toAmount);
    }

    /**
     * @return mixed|string
     */
    public function getStatus() {
        return $this->status;
    }

    public function getRate() {
        return $this->getFromCurrency() . " " . $this->getToCurrency() . " " . $this->getFromAmount() . " " . $this->getToAmount() . " " . $this->getStatus() . "\n";
    }
}
