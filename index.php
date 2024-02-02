<?php

include('ExchangeRate.php');
include('ActionService.php');

function run() {
    $input = fopen('php://stdin', 'rb');
    echo "Enter filename ";
    $fileName = trim(fgets($input));

    if (file_exists($fileName)) {
        echo "Enter action ";
        $action = trim(fgets($input));
        $actionService = new ActionService();
        switch ($action) {
            case 'propose':
                echo "Enter from_currency ";
                $fromCurrency = trim(fgets($input));
                echo "Enter to_currency ";
                $toCurrency = trim(fgets($input));
                echo "Enter from_amount ";
                $fromAmount = trim(fgets($input));
                echo "Enter to_amount ";
                $toAmount = trim(fgets($input));
                echo $actionService->propose('data.txt', new ExchangeRate(
                    $fromCurrency,
                    $toCurrency,
                    $fromAmount,
                    $toAmount
                ));
                break;
            case 'reject':
                echo "Enter exchange rate number ";
                $number = trim(fgets($input));
                echo $actionService->update($fileName, $number, 'rejected');
                break;
            case 'approve':
                echo "Enter exchange rate number ";
                $number = trim(fgets($input));
                echo $actionService->update($fileName, $number, 'approved');
                break;
            case 'proposes':
                $actionService->display($fileName, 'proposed');
                break;
            case 'display':
                $actionService->display($fileName, 'approved');
                break;
            case 'display_all':
                $actionService->displayAll($fileName);
                break;
            default:
                echo "Incorrect action $action";
                break;
        }

        fclose($input);
    } else {
        echo "There is no file $fileName";
    }

}

run();