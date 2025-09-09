<?php
require 'vendor/autoload.php';
use App\Game;

session_start();
if(!isset($_SESSION['game'])) {
    $_SESSION['game'] = serialize(new Game());
}

$game = unserialize($_SESSION['game']);

if(isset($_GET['col'])) {
    $game->playTurn((int)$_GET['col']);
    $_SESSION['game'] = serialize($game);
}

$grid = $game->getBoard()->getGrid();
$winner = $game->getWinner();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Puissance 4</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        td { width: 60px; height: 60px; text-align: center; vertical-align: middle; font-size: 32px; border: 2px solid #000; }
        .X { color: red; }
        .O { color: yellow; }
        a { text-decoration: none; font-weight: bold; font-size: 20px; }
    </style>
</head>
<body>
<h1>Puissance 4</h1>

<?php if($winner): ?>
    <h2>Le joueur <?= $winner ?> a gagné !</h2>
    <a href="?reset=1">Recommencer</a>
<?php else: ?>
    <h2>Joueur <?= $game->getCurrentPlayer() ?>, à vous de jouer</h2>
<?php endif; ?>

<?php if(isset($_GET['reset'])) { session_destroy(); header('Location: index.php'); } ?>

<table>
<?php foreach($grid as $row): ?>
<tr>
    <?php foreach($row as $cell): ?>
        <td class="<?= $cell ?>"><?= $cell ?? '' ?></td>
    <?php endforeach; ?>
</tr>
<?php endforeach; ?>
</table>

<?php if(!$winner): ?>
<p>Cliquer sur une colonne pour jouer :</p>
<?php for($i=0;$i<7;$i++): ?>
    <a href="?col=<?= $i ?>"><?= $i ?></a>
<?php endfor; ?>
<?php endif; ?>
</body>
</html>
