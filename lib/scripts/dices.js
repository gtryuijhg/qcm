'use strict';

function rollDice()
{
	let diceNumber = document.getElementById("diceNumber").value;

	let diceScore = 'Dice of ' + diceNumber + ' : score = ' + Math.floor(Math.random() * diceNumber + 1);
	document.getElementById("diceScore").innerHTML = diceScore;
}

function installEventHandler(selector, type, eventHandler)
{
    let domObject;

    domObject = document.querySelector(selector);

    domObject.addEventListener(type, eventHandler);
}

document.addEventListener('DOMContentLoaded', function()
{
	installEventHandler('#diceRoll', 'click', rollDice);
});