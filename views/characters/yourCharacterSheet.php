<?php ob_start(); ?>

<section class="row">
	<section class="col-md-6">
		<h2>Infos :</h2>
			<?php 
				foreach ($parameters['characterInfos'] as $info) {
			?>
				<p>Class : <?= htmlspecialchars($info['class']); ?></p>
				<p>Particularity : <?= htmlspecialchars($info['particularity']); ?></p>
			<?php	
				}	
			?>

	</section>
	
	<section class="col-md-6">
		<h2>Stats :</h2>
			<?php 
				foreach ($parameters['characterStats'] as $stat) {
			?>
				<p>Level : <?= htmlspecialchars($stat['level']); ?> <a href="/jdr/level-up">Level Up</a></p>
				<p>Health : <?= htmlspecialchars($stat['health']); ?> <a href="/jdr/increase-character-health">Increase</a> <a href="/jdr/reduce-character-health">Reduce</a></p>
				<p>Max Health : <?= htmlspecialchars($stat['max_health']); ?></p>
				<p>Energy : <?= htmlspecialchars($stat['energy']); ?> <a href="/jdr/increase-character-energy">Increase</a> <a href="/jdr/reduce-character-energy">Reduce</a></p>
				<p>Max Energy : <?= htmlspecialchars($stat['max_energy']); ?></p>
			<?php		
				}	
			?>
	</section>	
</section>

<section class="row">
	<section class="col-md-6">
		<h2>Abilities :</h2>
			<?php 
				foreach ($parameters['characterAbilities'] as $ability) {
			?>
				<p>Physics : <?= htmlspecialchars($ability['physics']); ?></p>
				<p>Social : <?= htmlspecialchars($ability['social']); ?></p>
				<p>Mental : <?= htmlspecialchars($ability['mental']); ?></p>

				<p>Physics ability : <?= htmlspecialchars($ability['physics_ability']); ?></p>
				<p>Social ability : <?= htmlspecialchars($ability['social_ability']); ?></p>
				<p>Mental ability : <?= htmlspecialchars($ability['mental_ability']); ?></p>
			<?php			
				}	
			?>
	</section>

	<section class="col-md-6">
		<h2>Stuff :</h2>
			<?php 
				foreach ($parameters['characterStuff'] as $stuff) {
			?>
				<p>Weapon : <?= htmlspecialchars($stuff['weapon']); ?> <a href="/jdr/update-character-weapon">Update</a></p>
				<p>Armor : <?= htmlspecialchars($stuff['armor']); ?> <a href="/jdr/update-character-armor">Update</a></p>
				<p>Backpack Slots : <?= htmlspecialchars($stuff['backpack_slots']); ?> <a href="/jdr/update-character-backpack">Update</a></p>
			<?php			
				}
			?>
	</section>	
</section>


<h2>Roll the dice :</h2>

<div>
	<label for="diceNumber">Dice number :</label>
	<input type="number" name="diceNumber" id="diceNumber">
</div>

<div>
	<button id="diceRoll">Roll the dice</button>
	<span id="diceScore"></span>
</div>

<p><a href="/jdr/characters-home">Return at character's home</a></p>

<?php	

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);