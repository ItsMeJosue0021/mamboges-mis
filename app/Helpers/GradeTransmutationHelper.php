<?php

function transmutate($grade)
{
    if ($grade == 100 ) {
        return $grade;
    } elseif ($grade >= 98.40 && $grade <= 99.99) {
        return 99;
    } elseif ($grade >= 96.80 && $grade <= 98.39) {
        return 98;
    } elseif ($grade >= 95.20 && $grade <= 96.79) {
        return 97;
    } elseif ($grade >= 93.60 && $grade <= 95.19) {
        return 96;
    } elseif ($grade >= 92.00 && $grade <= 93.59) {
        return 95;
    } elseif ($grade >= 90.40 && $grade <= 91.99) {
        return 94;
    } elseif ($grade >= 88.80 && $grade <= 90.39) {
        return 93;
    } elseif ($grade >= 87.20 && $grade <= 88.79) {
        return 92;
    } elseif ($grade >= 85.60 && $grade <= 87.19) {
        return 91;
    } elseif ($grade >= 84.00 && $grade <= 85.59) {
        return 90;
    } elseif ($grade >= 82.40 && $grade <= 83.99) {
        return 89;
    } elseif ($grade >= 80.80 && $grade <= 82.39) {
        return 88;
    } elseif ($grade >= 79.20 && $grade <= 80.79) {
        return 87;
    } elseif ($grade >= 77.60 && $grade <= 79.19) {
        return 86;
    } elseif ($grade >= 76.00 && $grade <= 77.59) {
        return 85;
    } elseif ($grade >= 74.40 && $grade <= 75.99) {
        return 84;
    } elseif ($grade >= 72.80 && $grade <= 74.39) {
        return 83;
    } elseif ($grade >= 71.20 && $grade <= 72.79) {
        return 82;
    } elseif ($grade >= 69.60 && $grade <= 71.19) {
        return 81;
    } elseif ($grade >= 68.00 && $grade <= 69.59) {
        return 80;
    } elseif ($grade >= 66.40 && $grade <= 67.99) {
        return 79;
    } elseif ($grade >= 64.80 && $grade <= 66.39) {
        return 78;
    } elseif ($grade >= 63.20 && $grade <= 64.79) {
        return 77;
    } elseif ($grade >= 61.60 && $grade <= 63.19) {
        return 76;
    } elseif ($grade >= 60.00 && $grade <= 61.59) {
        return 75;
    } elseif ($grade >= 56.00 && $grade <= 59.99) {
        return 74;
    } elseif ($grade >= 52.00 && $grade <= 55.99) {
        return 73;
    } elseif ($grade >= 48.00 && $grade <= 51.99) {
        return 72;
    } elseif ($grade >= 44.00 && $grade <= 47.99) {
        return 71;
    } elseif ($grade >= 40.00 && $grade <= 43.99) {
        return 70;
    } elseif ($grade >= 36.00 && $grade <= 39.99) {
        return 69;
    } elseif ($grade >= 32.00 && $grade <= 35.99) {
        return 68;
    } elseif ($grade >= 28.00 && $grade <= 31.99) {
        return 67;
    } elseif ($grade >= 24.00 && $grade <= 27.99) {
        return 66;
    } elseif ($grade >= 20.00 && $grade <= 23.99) {
        return 65;
    } elseif ($grade >= 16.00 && $grade <= 19.99) {
        return 64;
    } elseif ($grade >= 12.00 && $grade <= 15.99) {
        return 63;
    } elseif ($grade >= 8.00 && $grade <= 11.99) {
        return 62;
    } elseif ($grade >= 4.00 && $grade <= 7.99) {
        return 61;
    } elseif ($grade >= 0.00 && $grade <= 3.99) {
        return 60;
    } elseif ($grade == 0.00) {
        return 0;
    } else {
        return 0;
    }
}
