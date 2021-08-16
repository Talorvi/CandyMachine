# Merce recruitment task

## Candy vanding machine

Implement a vending machine using OOP.

### Scenario

- machine accepts only coins with nomination of 2 PLN
- turning the knob in OPEN mode dispenses a candy
- turning the knob in CLOSED mode does nothing
- after dispensing a candy, the machine changes its state to CLOSED state
- when the machine does not have any candies, it does not accept any coins and dispenses them
- machine dispenses all inserted coins when in OPEN state
- service technician can refill the machine

## Implementation

This application is written in pure PHP. For testing purposes I've used the PHPUnit library.  
When running the application, the result is shown in the console. The script returns example uses of the Candy Machine.

### Additional assumptions

Coins have nominations given in <b>gross</b> (2PLN = 200 gross).

The candy machine consists of three parts that a person can interact with.  
First of them is a coin slot. It accepts only one types of coins (2PLN). Different coins will be dispensed.  
Second of them is a knob. When turned if the machine is in open state (a coin is inserted), it dispenses a candy if
possible.  
The last of them is a reset button. When pushed, the machine dispenses a coin if inserted.

A technician can refill the machine with candies.

All scenarios are located in ```CandyMachineTest.php```.

### Requirements

- PHP >=7.4
- composer
- xDebug

### Installation

- clone the repository
- run ```composer install```
- to make sure all the classes are recognized properly run ```composer dump-autoload```

### Project structure

- src:
    - AbstractClass - stores abstract classes
        - ```Item.php``` - represents and item that can be dispensed by a vending machine.
    - Exception - stores all possible exceptions that can be thrown by the program
    - Factory - stores factories used to create new instances of vending machines
        - ```CandyMachineFactory.php```
    - Interfaces - stores all interfaces
    - Model
        - Item - stores all items stored by vending machines
        - Machine - stores all types of vending machines
        - State - stores all states of vending machines
        - Store - stores individual properties of vending machines
        - ```Coin.php``` - class representing money
    - Validator
        - ```CandyMachineValidator.php``` - validates if the machine can dispense a candy
        - ```CoinValidator.php``` - validates if the coin is valid to be used in the machine
        - ```IntArrayValidator.php``` - validates if the given array is an array of integers
- tests
- ```App.php```
- composer.json
- phpunit.xml
- README.md

### Running tests

- on Windows run ```vendor\bin\phpunit```
- on Linux run ```./vendor/bin/phpunit```

You can also run tests with coverage.

### Running the application

- run ```php App.php```