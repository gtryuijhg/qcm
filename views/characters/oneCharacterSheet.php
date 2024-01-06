<?php ob_start(); ?>

<section class="row">
	<section class="col-md-6">
		<h2>Infos :</h2>
				<p>Character : <?= $parameters['character']; ?></p>
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
				<p>Level : <?= htmlspecialchars($stat['level']); ?></p>
				<p>Health : <?= htmlspecialchars($stat['health']); ?></p>
				<p>Max Health : <?= htmlspecialchars($stat['max_health']); ?></p>
				<p>Energy : <?= htmlspecialchars($stat['energy']); ?></p>
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
				<p>Weapon : <?= htmlspecialchars($stuff['weapon']); ?></p>
				<p>Armor : <?= htmlspecialchars($stuff['armor']); ?></p>
				<p>Backpack Slots : <?= htmlspecialchars($stuff['backpack_slots']); ?></p>
			<?php			
				}
			?>
	</section>	
</section>

<p><a href="/jdr/get-all-characters">Return at character's list</a></p>

<?php	

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);