<?php

class ActionService {
    public function propose(string $fileName, ExchangeRate $exchangeRate): string {
        $fp = fopen($fileName, "a");
        fwrite($fp, $exchangeRate->getRate());
        fclose($fp);
        return "Added exchange rate: {$exchangeRate->getRate()}";
    }

    public function update(string $fileName, int $number, $status): string {
        $data = file($fileName);
        $exchangeRates = [];

        foreach ($data as $key => $line) {
            if ($key + 1 === $number) {
                $l = explode(' ', $line);
                $lineWithoutStatus = $l[0] . " " . $l[1] . " " . $l[2] . " " . $l[3];
                $line = "$lineWithoutStatus $status\n";
            }
            $exchangeRates[] = $line;
        }

        $fp = fopen($fileName, "w+");
        foreach ($exchangeRates as $line) {
            fwrite($fp, $line);
        }
        fclose($fp);

        return "Exchange rate with number $number $status";
    }

    public function display(string $fileName, string $status) {
        $data = file($fileName);
        foreach ($data as $line) {
            $arrayLine = explode(' ', $line);
            if (trim(end($arrayLine)) === $status) {
                echo $line;
            }
        }
    }

    public function displayAll(string $fileName) {
        foreach (file($fileName) as $line) {
            echo $line;
        }
    }
}
