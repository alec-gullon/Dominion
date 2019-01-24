<?php

namespace App\Game\Helpers;

class StringHelper {

    public static function cardAliasFromStub($stub) {
        $parts = explode('-', $stub);

        $alias = '';
        foreach ($parts as $part) {
            $alias .= ucfirst($part);
        }

        return $alias;
    }

    public static function methodFromCardAction($action) {
        $action = explode('/', $action)[1];
        $parts = explode('-', $action);

        $method = '';
        foreach ($parts as $part) {
            $method .= ucfirst($part);
        }

        return lcfirst($method);
    }

    public static function describeCardStack($cardStack) {
        $cardAmounts = [];
        foreach ($cardStack as $card) {
            $name = $card->name();
            if (!isset($cardAmounts[$name])) {
                $cardAmounts[$name] = [
                    'amount' => 0,
                    'card' => $card
                ];
            }
            $cardAmounts[$name]['amount']++;
        }

        $descriptor = '';

        $i = 1;
        foreach ($cardAmounts as $name => $details) {
            $amount = $details['amount'];
            $card = $details['card'];
            if ($amount === 1) {
                $descriptor .= ' ' . $card->nameWithArticlePrefix();
            } else {
                $descriptor  .= ' ' . config('dominion.number-mappings')[$amount] . ' ' . $card->pluralFormOfName();
            }

            if ($i === count($cardAmounts) - 1) {
                $descriptor .= ' and';
            } else if ($i < count($cardAmounts) - 1) {
                $descriptor .= ',';
            }

            $i++;
        }
        return $descriptor;
    }

}