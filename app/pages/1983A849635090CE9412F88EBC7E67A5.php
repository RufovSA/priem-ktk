<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('.well-known/pki-validation/1983A849635090CE9412F88EBC7E67A5.txt', function () {
	header('Content-Type: text/plain');
	?>
979FC232AE7956963B139BDDCC4374EF74E327ADB90F469F6A3E3E74F3EA792F
comodoca.com
53a6efc817f7b0c
	<?php
	exit();
});
